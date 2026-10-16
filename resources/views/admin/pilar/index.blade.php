@extends('layouts.admin')

@section('title', 'Manajemen Pilar Layanan')
@section('page_title', 'Manajemen Pilar Layanan')
@section('breadcrumb', 'Pilar Layanan')

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
                <input type="text" data-kt-filter="search" class="form-control form-control-solid w-250px ps-12" placeholder="Cari pilar..." />
            </div>
        </div>
        <div class="card-toolbar">
            <button type="button" class="btn btn-primary" onclick="openCreateModal()">
                <i class="ki-duotone ki-plus fs-2 me-1"></i>
                Tambah Pilar
            </button>
        </div>
    </div>
    <!--end::Card header-->

    <!--begin::Card body-->
    <div class="card-body pt-0">
        <div class="table-responsive">
            <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_table_pilar">
                <thead>
                    <tr class="text-start text-gray-500 fw-bold fs-7 text-uppercase gs-0">
                        <th class="w-10px pe-2">#</th>
                        <th>Nama Pilar</th>
                        <th>Keterangan / Definisi</th>
                        <th>Dibuat Pada</th>
                        <th class="text-end min-w-100px">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-gray-600 fw-semibold">
                    @forelse($pillars as $index => $pillar)
                    <tr id="row-{{ $pillar->uuid }}">
                        <td>{{ $index + 1 }}</td>
                        <td class="text-gray-900 fw-bold fs-6">
                            <span class="badge badge-light-primary fs-7 me-2">
                                <i class="ki-duotone ki-category text-primary me-1 fs-5"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span></i>
                                {{ $pillar->namaPilar }}
                            </span>
                        </td>
                        <td>
                            <span class="text-gray-700">{{ $pillar->keterangan ?: '-' }}</span>
                        </td>
                        <td>{{ $pillar->created_at ? $pillar->created_at->format('d M Y, H:i') : '-' }}</td>
                        <td class="text-end">
                            <button type="button" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1" onclick="openEditModal('{{ $pillar->uuid }}')" title="Edit">
                                <i class="ki-duotone ki-pencil fs-3"><span class="path1"></span><span class="path2"></span></i>
                            </button>
                            <button type="button" class="btn btn-icon btn-bg-light btn-active-color-danger btn-sm" onclick="confirmDelete('{{ $pillar->uuid }}', '{{ addslashes($pillar->namaPilar) }}')" title="Hapus">
                                <i class="ki-duotone ki-trash fs-3"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span></i>
                            </button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-10 text-muted">Belum ada pilar layanan.</td>
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
<!--begin::Modal Form Pilar-->
<div class="modal fade" id="modal_pilar" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-600px">
        <div class="modal-content">
            <div class="modal-header" id="kt_modal_pilar_header">
                <h2 class="fw-bold" id="modal_pilar_title">Tambah Pilar Layanan</h2>
                <div class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal">
                    <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                </div>
            </div>

            <form id="form_pilar" class="form">
                <div class="modal-body py-10 px-lg-17">
                    <input type="hidden" id="pilar_uuid" name="uuid" value="">

                    <!-- Nama Pilar -->
                    <div class="fv-row mb-7">
                        <label class="required fs-6 fw-semibold mb-2">Nama Pilar Layanan</label>
                        <input type="text" class="form-control form-control-solid" placeholder="Contoh: Infrastruktur Jaringan, IoT & Security" name="namaPilar" id="namaPilar" required />
                    </div>

                    <!-- Keterangan -->
                    <div class="fv-row mb-7">
                        <label class="fs-6 fw-semibold mb-2">Keterangan / Deskripsi Pilar</label>
                        <textarea class="form-control form-control-solid" rows="4" placeholder="Jelaskan fokus utama pilar layanan ini..." name="keterangan" id="keterangan"></textarea>
                    </div>
                </div>

                <div class="modal-footer flex-center">
                    <button type="button" class="btn btn-light me-3" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary" id="btn_submit_pilar">
                        <span class="indicator-label">Simpan</span>
                        <span class="indicator-progress">Memproses... <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<!--end::Modal Form Pilar-->
@endsection

@push('scripts')
<script>
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    const pilarModalEl = document.getElementById('modal_pilar');
    const pilarModal = new bootstrap.Modal(pilarModalEl);
    const formPilar = document.getElementById('form_pilar');
    const btnSubmit = document.getElementById('btn_submit_pilar');

    // Filter Search
    const searchInput = document.querySelector('[data-kt-filter="search"]');
    if (searchInput) {
        searchInput.addEventListener('keyup', function(e) {
            const query = e.target.value.toLowerCase();
            document.querySelectorAll('#kt_table_pilar tbody tr').forEach(row => {
                const text = row.innerText.toLowerCase();
                row.style.display = text.includes(query) ? '' : 'none';
            });
        });
    }

    function openCreateModal() {
        formPilar.reset();
        document.getElementById('pilar_uuid').value = '';
        document.getElementById('modal_pilar_title').textContent = 'Tambah Pilar Layanan';
        pilarModal.show();
    }

    async function openEditModal(uuid) {
        formPilar.reset();
        document.getElementById('pilar_uuid').value = uuid;
        document.getElementById('modal_pilar_title').textContent = 'Edit Pilar Layanan';

        try {
            const response = await fetch(`{{ url('admin/pilar') }}/${uuid}`, {
                headers: { 'Accept': 'application/json' }
            });
            const result = await response.json();
            if (result.success && result.data) {
                const p = result.data;
                document.getElementById('namaPilar').value = p.namaPilar || '';
                document.getElementById('keterangan').value = p.keterangan || '';
                pilarModal.show();
            } else {
                Swal.fire('Error', 'Gagal memuat data pilar', 'error');
            }
        } catch (error) {
            Swal.fire('Error', 'Terjadi kesalahan sistem', 'error');
        }
    }

    formPilar.addEventListener('submit', async function(e) {
        e.preventDefault();
        btnSubmit.setAttribute('data-kt-indicator', 'on');
        btnSubmit.disabled = true;

        const uuid = document.getElementById('pilar_uuid').value;
        const isEdit = Boolean(uuid);
        const url = isEdit ? `{{ url('admin/pilar') }}/${uuid}` : `{{ route('admin.pilar.store') }}`;
        const method = isEdit ? 'PUT' : 'POST';

        const payload = {
            namaPilar: document.getElementById('namaPilar').value,
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
                pilarModal.hide();
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
            title: 'Hapus Pilar Layanan?',
            html: `Apakah Anda yakin ingin menghapus pilar <b>"${name}"</b>?`,
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
                    const response = await fetch(`{{ url('admin/pilar') }}/${uuid}`, {
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
                        Swal.fire('Gagal', result.message || 'Gagal menghapus pilar', 'error');
                    }
                } catch (e) {
                    Swal.fire('Error', 'Kesalahan jaringan', 'error');
                }
            }
        });
    }
</script>
@endpush
