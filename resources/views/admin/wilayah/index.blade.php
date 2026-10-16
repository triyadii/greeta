@extends('layouts.admin')

@section('title', 'Manajemen Wilayah Operasional')
@section('page_title', 'Wilayah Operasional')
@section('breadcrumb', 'Wilayah Operasional')

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
                <input type="text" data-kt-filter="search" class="form-control form-control-solid w-250px ps-12" placeholder="Cari wilayah..." />
            </div>
        </div>
        <div class="card-toolbar">
            <button type="button" class="btn btn-primary" onclick="openCreateModal()">
                <i class="ki-duotone ki-plus fs-2 me-1"></i>
                Tambah Wilayah
            </button>
        </div>
    </div>
    <!--end::Card header-->

    <!--begin::Card body-->
    <div class="card-body pt-0">
        <div class="table-responsive">
            <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_table_wilayah">
                <thead>
                    <tr class="text-start text-gray-500 fw-bold fs-7 text-uppercase gs-0">
                        <th class="w-10px pe-2">#</th>
                        <th>Nama Wilayah</th>
                        <th>Keterangan / Coverage</th>
                        <th>Tanggal Ditambahkan</th>
                        <th class="text-end min-w-100px">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-gray-600 fw-semibold">
                    @forelse($areas as $index => $area)
                    <tr id="row-{{ $area->uuid }}">
                        <td>{{ $index + 1 }}</td>
                        <td class="text-gray-900 fw-bold fs-6">
                            <i class="ki-duotone ki-geolocation text-primary me-2 fs-4"><span class="path1"></span><span class="path2"></span></i>
                            {{ $area->namaWilayah }}
                        </td>
                        <td>
                            <span class="text-gray-700">{{ $area->keterangan ?: '-' }}</span>
                        </td>
                        <td>{{ $area->created_at ? $area->created_at->format('d M Y, H:i') : '-' }}</td>
                        <td class="text-end">
                            <button type="button" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1" onclick="openEditModal('{{ $area->uuid }}')" title="Edit">
                                <i class="ki-duotone ki-pencil fs-3"><span class="path1"></span><span class="path2"></span></i>
                            </button>
                            <button type="button" class="btn btn-icon btn-bg-light btn-active-color-danger btn-sm" onclick="confirmDelete('{{ $area->uuid }}', '{{ addslashes($area->namaWilayah) }}')" title="Hapus">
                                <i class="ki-duotone ki-trash fs-3"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span></i>
                            </button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-10 text-muted">Belum ada wilayah operasional yang didaftarkan.</td>
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
<!--begin::Modal Form Wilayah-->
<div class="modal fade" id="modal_wilayah" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-600px">
        <div class="modal-content">
            <div class="modal-header" id="kt_modal_wilayah_header">
                <h2 class="fw-bold" id="modal_wilayah_title">Tambah Wilayah Operasional</h2>
                <div class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal">
                    <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                </div>
            </div>

            <form id="form_wilayah" class="form">
                <div class="modal-body py-10 px-lg-17">
                    <input type="hidden" id="wilayah_uuid" name="uuid" value="">

                    <!-- Nama Wilayah -->
                    <div class="fv-row mb-7">
                        <label class="required fs-6 fw-semibold mb-2">Nama Wilayah</label>
                        <input type="text" class="form-control form-control-solid" placeholder="Contoh: Jabodetabek, Jawa Barat, Bali" name="namaWilayah" id="namaWilayah" required />
                    </div>

                    <!-- Keterangan -->
                    <div class="fv-row mb-7">
                        <label class="fs-6 fw-semibold mb-2">Keterangan / Jangkauan Layanan</label>
                        <textarea class="form-control form-control-solid" rows="4" placeholder="Deskripsikan jangkauan layanan teknis, kantor perwakilan, atau catatan operasional..." name="keterangan" id="keterangan"></textarea>
                    </div>
                </div>

                <div class="modal-footer flex-center">
                    <button type="button" class="btn btn-light me-3" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary" id="btn_submit_wilayah">
                        <span class="indicator-label">Simpan</span>
                        <span class="indicator-progress">Memproses... <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<!--end::Modal Form Wilayah-->
@endsection

@push('scripts')
<script>
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    const wilayahModalEl = document.getElementById('modal_wilayah');
    const wilayahModal = new bootstrap.Modal(wilayahModalEl);
    const formWilayah = document.getElementById('form_wilayah');
    const btnSubmit = document.getElementById('btn_submit_wilayah');

    // Filter Search
    const searchInput = document.querySelector('[data-kt-filter="search"]');
    if (searchInput) {
        searchInput.addEventListener('keyup', function(e) {
            const query = e.target.value.toLowerCase();
            document.querySelectorAll('#kt_table_wilayah tbody tr').forEach(row => {
                const text = row.innerText.toLowerCase();
                row.style.display = text.includes(query) ? '' : 'none';
            });
        });
    }

    function openCreateModal() {
        formWilayah.reset();
        document.getElementById('wilayah_uuid').value = '';
        document.getElementById('modal_wilayah_title').textContent = 'Tambah Wilayah Operasional';
        wilayahModal.show();
    }

    async function openEditModal(uuid) {
        formWilayah.reset();
        document.getElementById('wilayah_uuid').value = uuid;
        document.getElementById('modal_wilayah_title').textContent = 'Edit Wilayah Operasional';

        try {
            const response = await fetch(`{{ url('admin/wilayah') }}/${uuid}`, {
                headers: { 'Accept': 'application/json' }
            });
            const result = await response.json();
            if (result.success && result.data) {
                const w = result.data;
                document.getElementById('namaWilayah').value = w.namaWilayah || '';
                document.getElementById('keterangan').value = w.keterangan || '';
                wilayahModal.show();
            } else {
                Swal.fire('Error', 'Gagal memuat data wilayah', 'error');
            }
        } catch (error) {
            Swal.fire('Error', 'Terjadi kesalahan sistem', 'error');
        }
    }

    formWilayah.addEventListener('submit', async function(e) {
        e.preventDefault();
        btnSubmit.setAttribute('data-kt-indicator', 'on');
        btnSubmit.disabled = true;

        const uuid = document.getElementById('wilayah_uuid').value;
        const isEdit = Boolean(uuid);
        const url = isEdit ? `{{ url('admin/wilayah') }}/${uuid}` : `{{ route('admin.wilayah.store') }}`;
        const method = isEdit ? 'PUT' : 'POST';

        const payload = {
            namaWilayah: document.getElementById('namaWilayah').value,
            keterangan: document.getElementById('keterangan').value,
        };

        try {
            const response = await fetch(url, {
                method: method,
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                },
                body: JSON.stringify(payload)
            });

            const result = await response.json();
            if (response.ok && result.success) {
                wilayahModal.hide();
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
            title: 'Hapus Wilayah?',
            html: `Apakah Anda yakin ingin menghapus wilayah <b>"${name}"</b>?`,
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
                    const response = await fetch(`{{ url('admin/wilayah') }}/${uuid}`, {
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
                        Swal.fire('Gagal', result.message || 'Gagal menghapus wilayah', 'error');
                    }
                } catch (e) {
                    Swal.fire('Error', 'Kesalahan jaringan', 'error');
                }
            }
        });
    }
</script>
@endpush
