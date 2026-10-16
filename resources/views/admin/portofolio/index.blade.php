@extends('layouts.admin')

@section('title', 'Manajemen Portofolio')
@section('page_title', 'Manajemen Portofolio')
@section('breadcrumb', 'Portofolio')

@section('content')
<div class="card card-flush shadow-sm">
    <!--begin::Card header-->
    <div class="card-header align-items-center py-5 gap-2 gap-md-5">
        <div class="card-title">
            <div class="d-flex align-items-center position-relative my-1">
                <i class="ki-duotone ki-magnifier fs-3 position-absolute ms-4">
                    <span class="path1"></span>
                    <span class="path2"></span>
                </i>
                <input type="text" data-kt-filter="search" class="form-control form-control-solid w-250px ps-12" placeholder="Cari nama project..." />
            </div>
        </div>
        <div class="card-toolbar">
            <button type="button" class="btn btn-primary" onclick="openCreateModal()">
                <i class="ki-duotone ki-plus fs-2 me-1"></i>
                Tambah Portofolio
            </button>
        </div>
    </div>
    <!--end::Card header-->

    <!--begin::Card body-->
    <div class="card-body pt-0">
        <div class="table-responsive">
            <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_table_portofolio">
                <thead>
                    <tr class="text-start text-gray-500 fw-bold fs-7 text-uppercase gs-0">
                        <th class="w-10px pe-2">#</th>
                        <th>Foto / Gambar (Maks 3)</th>
                        <th>Nama Project</th>
                        <th>Keterangan</th>
                        <th>Tanggal</th>
                        <th class="text-end min-w-100px">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-gray-600 fw-semibold">
                    @forelse($portfolios as $index => $port)
                    <tr id="row-{{ $port->uuid }}">
                        <td>{{ $index + 1 }}</td>
                        <td>
                            <div class="d-flex align-items-center gap-2">
                                @if(is_array($port->gambar) && count($port->gambar) > 0)
                                    @foreach($port->gambar as $img)
                                        <div class="symbol symbol-50px symbol-2by3">
                                            <img src="{{ asset('storage/' . $img) }}" alt="{{ $port->namaProject }}" class="object-fit-cover rounded" onerror="this.src='https://placehold.co/100x70?text=No+Image'" />
                                        </div>
                                    @endforeach
                                @else
                                    <span class="badge badge-light-secondary">Tanpa Gambar</span>
                                @endif
                            </div>
                        </td>
                        <td class="text-gray-900 fw-bold fs-6">
                            {{ $port->namaProject }}
                        </td>
                        <td>
                            <span class="text-gray-700 fs-7">{{ Str::limit($port->keterangan, 100) ?: '-' }}</span>
                        </td>
                        <td>{{ $port->created_at ? $port->created_at->format('d M Y') : '-' }}</td>
                        <td class="text-end">
                            <button type="button" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1" onclick="openEditModal('{{ $port->uuid }}')" title="Edit">
                                <i class="ki-duotone ki-pencil fs-3"><span class="path1"></span><span class="path2"></span></i>
                            </button>
                            <button type="button" class="btn btn-icon btn-bg-light btn-active-color-danger btn-sm" onclick="confirmDelete('{{ $port->uuid }}', '{{ addslashes($port->namaProject) }}')" title="Hapus">
                                <i class="ki-duotone ki-trash fs-3"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span></i>
                            </button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-10 text-muted">Belum ada portofolio proyek.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <!--end::Card body-->
</div>
@endsection

@section('modals')
<!--begin::Modal Form Portofolio-->
<div class="modal fade" id="modal_portofolio" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-700px">
        <div class="modal-content">
            <div class="modal-header" id="kt_modal_portofolio_header">
                <h2 class="fw-bold" id="modal_portofolio_title">Tambah Portofolio</h2>
                <div class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal">
                    <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                </div>
            </div>

            <form id="form_portofolio" class="form" enctype="multipart/form-data">
                <div class="modal-body py-10 px-lg-17 scroll-y" style="max-height: 70vh;">
                    <input type="hidden" id="portofolio_uuid" name="uuid" value="">

                    <!-- Nama Project -->
                    <div class="fv-row mb-7">
                        <label class="required fs-6 fw-semibold mb-2">Nama Project</label>
                        <input type="text" class="form-control form-control-solid" placeholder="Contoh: Implementasi Smart CCTV & IoT Fiber" name="namaProject" id="namaProject" required />
                    </div>

                    <!-- Keterangan -->
                    <div class="fv-row mb-7">
                        <label class="fs-6 fw-semibold mb-2">Keterangan / Ruang Lingkup Proyek</label>
                        <textarea class="form-control form-control-solid" rows="4" placeholder="Jelaskan ringkasan proyek, solusi teknologi yang diaplikasikan, serta hasil integrasi..." name="keterangan" id="keterangan"></textarea>
                    </div>

                    <!-- Upload Gambar (Maksimal 3) -->
                    <div class="fv-row mb-7">
                        <label class="fs-6 fw-semibold mb-2">Unggah Gambar Dokumentasi (Maksimal 3)</label>
                        <input type="file" class="form-control form-control-solid" id="input_gambar" name="gambar[]" multiple accept="image/jpeg,image/png,image/jpg,image/webp" />
                        <div class="form-text text-muted">Format: JPG, PNG, WEBP. Maks 2MB per file. Jumlah gambar maksimal 3 file.</div>
                    </div>

                    <!-- Existing Images Container (for Edit mode) -->
                    <div id="existing_images_section" class="mb-5 d-none">
                        <label class="fs-7 fw-bold text-gray-700 mb-2 d-block">Gambar Tersimpan Saat Ini:</label>
                        <div id="existing_images_container" class="d-flex flex-wrap gap-3"></div>
                    </div>
                </div>

                <div class="modal-footer flex-center">
                    <button type="button" class="btn btn-light me-3" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary" id="btn_submit_portofolio">
                        <span class="indicator-label">Simpan</span>
                        <span class="indicator-progress">Mengunggah... <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<!--end::Modal Form Portofolio-->
@endsection

@push('scripts')
<script>
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    const portofolioModalEl = document.getElementById('modal_portofolio');
    const portofolioModal = new bootstrap.Modal(portofolioModalEl);
    const formPortofolio = document.getElementById('form_portofolio');
    const btnSubmit = document.getElementById('btn_submit_portofolio');

    let retainedImages = [];

    // Filter Search
    const searchInput = document.querySelector('[data-kt-filter="search"]');
    if (searchInput) {
        searchInput.addEventListener('keyup', function(e) {
            const query = e.target.value.toLowerCase();
            document.querySelectorAll('#kt_table_portofolio tbody tr').forEach(row => {
                const text = row.innerText.toLowerCase();
                row.style.display = text.includes(query) ? '' : 'none';
            });
        });
    }

    function openCreateModal() {
        formPortofolio.reset();
        document.getElementById('portofolio_uuid').value = '';
        document.getElementById('modal_portofolio_title').textContent = 'Tambah Portofolio Proyek';
        document.getElementById('existing_images_section').classList.add('d-none');
        document.getElementById('existing_images_container').innerHTML = '';
        retainedImages = [];
        portofolioModal.show();
    }

    async function openEditModal(uuid) {
        formPortofolio.reset();
        document.getElementById('portofolio_uuid').value = uuid;
        document.getElementById('modal_portofolio_title').textContent = 'Edit Portofolio Proyek';
        document.getElementById('existing_images_section').classList.add('d-none');
        document.getElementById('existing_images_container').innerHTML = '';
        retainedImages = [];

        try {
            const response = await fetch(`{{ url('admin/portofolio') }}/${uuid}`, {
                headers: { 'Accept': 'application/json' }
            });
            const result = await response.json();
            if (result.success && result.data) {
                const p = result.data;
                document.getElementById('namaProject').value = p.namaProject || '';
                document.getElementById('keterangan').value = p.keterangan || '';

                if (Array.isArray(p.gambar) && p.gambar.length > 0) {
                    retainedImages = [...p.gambar];
                    renderExistingImages();
                }
                portofolioModal.show();
            } else {
                Swal.fire('Error', 'Gagal memuat portofolio', 'error');
            }
        } catch (error) {
            Swal.fire('Error', 'Terjadi kesalahan sistem', 'error');
        }
    }

    function renderExistingImages() {
        const container = document.getElementById('existing_images_container');
        container.innerHTML = '';
        if (retainedImages.length === 0) {
            document.getElementById('existing_images_section').classList.add('d-none');
            return;
        }

        document.getElementById('existing_images_section').classList.remove('d-none');
        retainedImages.forEach((img, idx) => {
            const wrap = document.createElement('div');
            wrap.className = 'position-relative border rounded p-1';
            wrap.innerHTML = `
                <img src="{{ asset('storage') }}/${img}" class="rounded w-100px h-75px object-fit-cover" />
                <button type="button" class="btn btn-icon btn-danger btn-circle w-20px h-20px position-absolute top-0 end-0 m-1" onclick="removeRetainedImage(${idx})">
                    <i class="ki-duotone ki-cross fs-4"><span class="path1"></span><span class="path2"></span></i>
                </button>
            `;
            container.appendChild(wrap);
        });
    }

    function removeRetainedImage(index) {
        retainedImages.splice(index, 1);
        renderExistingImages();
    }

    formPortofolio.addEventListener('submit', async function(e) {
        e.preventDefault();

        const inputFiles = document.getElementById('input_gambar').files;
        if (retainedImages.length + inputFiles.length > 3) {
            Swal.fire('Batas Gambar Terlampaui', 'Total gambar (tersimpan + baru) maksimal 3 gambar.', 'warning');
            return;
        }

        btnSubmit.setAttribute('data-kt-indicator', 'on');
        btnSubmit.disabled = true;

        const uuid = document.getElementById('portofolio_uuid').value;
        const isEdit = Boolean(uuid);
        const url = isEdit ? `{{ url('admin/portofolio') }}/${uuid}` : `{{ route('admin.portofolio.store') }}`;

        const formData = new FormData();
        formData.append('namaProject', document.getElementById('namaProject').value);
        formData.append('keterangan', document.getElementById('keterangan').value);

        for (let i = 0; i < inputFiles.length; i++) {
            formData.append('gambar[]', inputFiles[i]);
        }

        if (isEdit) {
            retainedImages.forEach(img => {
                formData.append('retained_images[]', img);
            });
        }

        try {
            const response = await fetch(url, {
                method: 'POST',
                headers: {
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                },
                body: formData
            });

            const result = await response.json();
            if (response.ok && result.success) {
                portofolioModal.hide();
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: result.message,
                    timer: 1500,
                    showConfirmButton: false
                }).then(() => location.reload());
            } else {
                const errors = result.errors ? Object.values(result.errors).flat().join('<br>') : (result.message || 'Gagal menyimpan');
                Swal.fire('Peringatan', errors, 'warning');
            }
        } catch (err) {
            Swal.fire('Error', 'Kesalahan jaringan', 'error');
        } finally {
            btnSubmit.removeAttribute('data-kt-indicator');
            btnSubmit.disabled = false;
        }
    });

    function confirmDelete(uuid, name) {
        Swal.fire({
            title: 'Hapus Portofolio?',
            html: `Apakah Anda yakin ingin menghapus portofolio <b>"${name}"</b> beserta file gambarnya?`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya, Hapus',
            cancelButtonText: 'Batal',
            customClass: {
                confirmButton: 'btn btn-danger',
                cancelButton: 'btn btn-secondary'
            }
        }).then(async (res) => {
            if (res.isConfirmed) {
                try {
                    const response = await fetch(`{{ url('admin/portofolio') }}/${uuid}`, {
                        method: 'DELETE',
                        headers: {
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': csrfToken
                        }
                    });
                    const result = await response.json();
                    if (response.ok && result.success) {
                        Swal.fire('Terhapus!', result.message, 'success').then(() => {
                            const row = document.getElementById(`row-${uuid}`);
                            if (row) row.remove();
                        });
                    } else {
                        Swal.fire('Gagal', result.message || 'Gagal menghapus portofolio', 'error');
                    }
                } catch (e) {
                    Swal.fire('Error', 'Kesalahan jaringan', 'error');
                }
            }
        });
    }
</script>
@endpush
