@extends('layouts.admin')

@section('title', 'Manajemen Berita')
@section('page_title', 'Manajemen Berita')
@section('breadcrumb', 'Berita')

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
                <input type="text" data-kt-filter="search" class="form-control form-control-solid w-250px ps-12" placeholder="Cari judul berita..." />
            </div>
        </div>
        <div class="card-toolbar">
            <button type="button" class="btn btn-primary" onclick="openCreateModal()">
                <i class="ki-duotone ki-plus fs-2 me-1"></i>
                Tambah Berita
            </button>
        </div>
    </div>
    <!--end::Card header-->

    <!--begin::Card body-->
    <div class="card-body pt-0">
        <div class="table-responsive">
            <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_table_berita">
                <thead>
                    <tr class="text-start text-gray-500 fw-bold fs-7 text-uppercase gs-0">
                        <th class="w-10px pe-2">#</th>
                        <th>Foto / Gambar (Maks 3)</th>
                        <th class="min-w-200px">Judul Berita</th>
                        <th>Ringkasan Konten</th>
                        <th>Tanggal Publikasi</th>
                        <th class="text-end min-w-100px">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-gray-600 fw-semibold">
                    @forelse($news as $index => $item)
                    <tr id="row-{{ $item->uuid }}">
                        <td>{{ $index + 1 }}</td>
                        <td>
                            <div class="d-flex align-items-center gap-2">
                                @if(is_array($item->gambar) && count($item->gambar) > 0)
                                    @foreach($item->gambar as $img)
                                        <div class="symbol symbol-50px symbol-2by3">
                                            <img src="{{ asset('storage/' . $img) }}" alt="{{ $item->judul }}" class="object-fit-cover rounded" onerror="this.src='https://placehold.co/100x70?text=No+Image'" />
                                        </div>
                                    @endforeach
                                @else
                                    <span class="badge badge-light-secondary">Tanpa Gambar</span>
                                @endif
                            </div>
                        </td>
                        <td class="text-gray-900 fw-bold fs-6">
                            {{ $item->judul }}
                            <div class="text-muted fs-8 font-monospace">{{ $item->slug }}</div>
                        </td>
                        <td>
                            <span class="text-gray-700 fs-7">{{ Str::limit(strip_tags($item->keterangan), 90) ?: '-' }}</span>
                        </td>
                        <td>{{ $item->created_at ? $item->created_at->format('d M Y, H:i') : '-' }}</td>
                        <td class="text-end">
                            <button type="button" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1" onclick="openEditModal('{{ $item->uuid }}')" title="Edit">
                                <i class="ki-duotone ki-pencil fs-3"><span class="path1"></span><span class="path2"></span></i>
                            </button>
                            <button type="button" class="btn btn-icon btn-bg-light btn-active-color-danger btn-sm" onclick="confirmDelete('{{ $item->uuid }}', '{{ addslashes($item->judul) }}')" title="Hapus">
                                <i class="ki-duotone ki-trash fs-3"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span></i>
                            </button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-10 text-muted">Belum ada berita yang diterbitkan.</td>
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
<!--begin::Modal Form Berita-->
<div class="modal fade" id="modal_berita" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-750px">
        <div class="modal-content">
            <div class="modal-header" id="kt_modal_berita_header">
                <h2 class="fw-bold" id="modal_berita_title">Tambah Berita</h2>
                <div class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal">
                    <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                </div>
            </div>

            <form id="form_berita" class="form" enctype="multipart/form-data">
                <div class="modal-body py-10 px-lg-17 scroll-y" style="max-height: 70vh;">
                    <input type="hidden" id="berita_uuid" name="uuid" value="">

                    <!-- Judul -->
                    <div class="fv-row mb-7">
                        <label class="required fs-6 fw-semibold mb-2">Judul Berita / Publikasi</label>
                        <input type="text" class="form-control form-control-solid" placeholder="Contoh: Gretta Solution Resmikan Jaringan Fiber Optic Baru" name="judul" id="judul" required />
                    </div>

                    <!-- Keterangan -->
                    <div class="fv-row mb-7">
                        <label class="fs-6 fw-semibold mb-2">Isi Berita / Keterangan</label>
                        <textarea class="form-control form-control-solid" rows="6" placeholder="Tuliskan isi berita, liputan kegiatan, atau siaran pers..." name="keterangan" id="keterangan"></textarea>
                    </div>

                    <!-- Upload Gambar (Maks 3) -->
                    <div class="fv-row mb-7">
                        <label class="fs-6 fw-semibold mb-2">Unggah Foto Berita (Maksimal 3 File)</label>
                        <input type="file" class="form-control form-control-solid" id="input_gambar_berita" name="gambar[]" multiple accept="image/jpeg,image/png,image/jpg,image/webp" />
                        <div class="form-text text-muted">Format yang didukung: JPG, PNG, WEBP. Maks 2MB per gambar.</div>
                    </div>

                    <!-- Existing Images Container (Edit mode) -->
                    <div id="existing_news_images_section" class="mb-5 d-none">
                        <label class="fs-7 fw-bold text-gray-700 mb-2 d-block">Foto Tersimpan Saat Ini:</label>
                        <div id="existing_news_images_container" class="d-flex flex-wrap gap-3"></div>
                    </div>
                </div>

                <div class="modal-footer flex-center">
                    <button type="button" class="btn btn-light me-3" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary" id="btn_submit_berita">
                        <span class="indicator-label">Simpan Berita</span>
                        <span class="indicator-progress">Memproses... <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<!--end::Modal Form Berita-->
@endsection

@push('scripts')
<script>
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    const beritaModalEl = document.getElementById('modal_berita');
    const beritaModal = new bootstrap.Modal(beritaModalEl);
    const formBerita = document.getElementById('form_berita');
    const btnSubmit = document.getElementById('btn_submit_berita');

    let retainedNewsImages = [];

    // Filter Search
    const searchInput = document.querySelector('[data-kt-filter="search"]');
    if (searchInput) {
        searchInput.addEventListener('keyup', function(e) {
            const query = e.target.value.toLowerCase();
            document.querySelectorAll('#kt_table_berita tbody tr').forEach(row => {
                const text = row.innerText.toLowerCase();
                row.style.display = text.includes(query) ? '' : 'none';
            });
        });
    }

    function openCreateModal() {
        formBerita.reset();
        document.getElementById('berita_uuid').value = '';
        document.getElementById('modal_berita_title').textContent = 'Tambah Berita';
        document.getElementById('existing_news_images_section').classList.add('d-none');
        document.getElementById('existing_news_images_container').innerHTML = '';
        retainedNewsImages = [];
        beritaModal.show();
    }

    async function openEditModal(uuid) {
        formBerita.reset();
        document.getElementById('berita_uuid').value = uuid;
        document.getElementById('modal_berita_title').textContent = 'Edit Berita';
        document.getElementById('existing_news_images_section').classList.add('d-none');
        document.getElementById('existing_news_images_container').innerHTML = '';
        retainedNewsImages = [];

        try {
            const response = await fetch(`{{ url('admin/berita') }}/${uuid}`, {
                headers: { 'Accept': 'application/json' }
            });
            const result = await response.json();
            if (result.success && result.data) {
                const b = result.data;
                document.getElementById('judul').value = b.judul || '';
                document.getElementById('keterangan').value = b.keterangan || '';

                if (Array.isArray(b.gambar) && b.gambar.length > 0) {
                    retainedNewsImages = [...b.gambar];
                    renderExistingNewsImages();
                }
                beritaModal.show();
            } else {
                Swal.fire('Error', 'Gagal memuat berita', 'error');
            }
        } catch (error) {
            Swal.fire('Error', 'Terjadi kesalahan sistem', 'error');
        }
    }

    function renderExistingNewsImages() {
        const container = document.getElementById('existing_news_images_container');
        container.innerHTML = '';
        if (retainedNewsImages.length === 0) {
            document.getElementById('existing_news_images_section').classList.add('d-none');
            return;
        }

        document.getElementById('existing_news_images_section').classList.remove('d-none');
        retainedNewsImages.forEach((img, idx) => {
            const wrap = document.createElement('div');
            wrap.className = 'position-relative border rounded p-1';
            wrap.innerHTML = `
                <img src="{{ asset('storage') }}/${img}" class="rounded w-100px h-75px object-fit-cover" />
                <button type="button" class="btn btn-icon btn-danger btn-circle w-20px h-20px position-absolute top-0 end-0 m-1" onclick="removeRetainedNewsImage(${idx})">
                    <i class="ki-duotone ki-cross fs-4"><span class="path1"></span><span class="path2"></span></i>
                </button>
            `;
            container.appendChild(wrap);
        });
    }

    function removeRetainedNewsImage(index) {
        retainedNewsImages.splice(index, 1);
        renderExistingNewsImages();
    }

    formBerita.addEventListener('submit', async function(e) {
        e.preventDefault();

        const inputFiles = document.getElementById('input_gambar_berita').files;
        if (retainedNewsImages.length + inputFiles.length > 3) {
            Swal.fire('Batas Gambar', 'Maksimal hanya dapat menyimpan 3 gambar untuk satu berita.', 'warning');
            return;
        }

        btnSubmit.setAttribute('data-kt-indicator', 'on');
        btnSubmit.disabled = true;

        const uuid = document.getElementById('berita_uuid').value;
        const isEdit = Boolean(uuid);
        const url = isEdit ? `{{ url('admin/berita') }}/${uuid}` : `{{ route('admin.berita.store') }}`;

        const formData = new FormData();
        formData.append('judul', document.getElementById('judul').value);
        formData.append('keterangan', document.getElementById('keterangan').value);

        for (let i = 0; i < inputFiles.length; i++) {
            formData.append('gambar[]', inputFiles[i]);
        }

        if (isEdit) {
            retainedNewsImages.forEach(img => {
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
                beritaModal.hide();
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

    function confirmDelete(uuid, judul) {
        Swal.fire({
            title: 'Hapus Berita?',
            html: `Apakah Anda yakin ingin menghapus berita <b>"${judul}"</b>?`,
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
                    const response = await fetch(`{{ url('admin/berita') }}/${uuid}`, {
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
                        Swal.fire('Gagal', result.message || 'Gagal menghapus berita', 'error');
                    }
                } catch (e) {
                    Swal.fire('Error', 'Kesalahan jaringan', 'error');
                }
            }
        });
    }
</script>
@endpush
