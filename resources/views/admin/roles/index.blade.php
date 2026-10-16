@extends('layouts.admin')

@section('title', 'Manajemen Role Akses')
@section('page_title', 'Manajemen Role Akses')
@section('breadcrumb', 'Role Akses')

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
                <input type="text" data-kt-filter="search" class="form-control form-control-solid w-250px ps-12" placeholder="Cari role..." />
            </div>
        </div>
        <div class="card-toolbar">
            <button type="button" class="btn btn-primary" onclick="openCreateModal()">
                <i class="ki-duotone ki-plus fs-2 me-1"></i>
                Tambah Role
            </button>
        </div>
    </div>
    <!--end::Card header-->

    <!--begin::Card body-->
    <div class="card-body pt-0">
        <div class="table-responsive">
            <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_table_roles">
                <thead>
                    <tr class="text-start text-gray-500 fw-bold fs-7 text-uppercase gs-0">
                        <th class="w-10px pe-2">#</th>
                        <th>Nama Role</th>
                        <th>Jumlah Pengguna</th>
                        <th>Dibuat Pada</th>
                        <th class="text-end min-w-100px">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-gray-600 fw-semibold">
                    @forelse($roles as $index => $role)
                    <tr id="row-{{ $role->uuid }}">
                        <td>{{ $index + 1 }}</td>
                        <td class="text-gray-900 fw-bold fs-6">
                            <span class="badge badge-light-primary fs-7 me-2">
                                <i class="ki-duotone ki-shield-tick text-primary me-1 fs-5"></i>
                                {{ $role->namaRole }}
                            </span>
                        </td>
                        <td>
                            <span class="badge badge-light-info fw-bold">{{ $role->users_count ?? 0 }} User</span>
                        </td>
                        <td>{{ $role->created_at ? $role->created_at->format('d M Y, H:i') : '-' }}</td>
                        <td class="text-end">
                            <button type="button" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1" onclick="openEditModal('{{ $role->uuid }}')" title="Edit">
                                <i class="ki-duotone ki-pencil fs-3"><span class="path1"></span><span class="path2"></span></i>
                            </button>
                            <button type="button" class="btn btn-icon btn-bg-light btn-active-color-danger btn-sm" onclick="confirmDelete('{{ $role->uuid }}', '{{ addslashes($role->namaRole) }}')" title="Hapus">
                                <i class="ki-duotone ki-trash fs-3"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span></i>
                            </button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-10 text-muted">Belum ada role akses yang didaftarkan.</td>
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
<!--begin::Modal Form Role-->
<div class="modal fade" id="modal_role" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-500px">
        <div class="modal-content">
            <div class="modal-header" id="kt_modal_role_header">
                <h2 class="fw-bold" id="modal_role_title">Tambah Role Akses</h2>
                <div class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal">
                    <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                </div>
            </div>

            <form id="form_role" class="form">
                <div class="modal-body py-10 px-lg-17">
                    <input type="hidden" id="role_uuid" name="uuid" value="">

                    <!-- Nama Role -->
                    <div class="fv-row mb-7">
                        <label class="required fs-6 fw-semibold mb-2">Nama Role</label>
                        <input type="text" class="form-control form-control-solid" placeholder="Contoh: Superadmin, Manager, Editor" name="namaRole" id="namaRole" required />
                        <div class="form-text text-muted">Nama role harus unik dan mewakili tingkat akses.</div>
                    </div>
                </div>

                <div class="modal-footer flex-center">
                    <button type="button" class="btn btn-light me-3" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary" id="btn_submit_role">
                        <span class="indicator-label">Simpan</span>
                        <span class="indicator-progress">Memproses... <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<!--end::Modal Form Role-->
@endsection

@push('scripts')
<script>
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    const roleModalEl = document.getElementById('modal_role');
    const roleModal = new bootstrap.Modal(roleModalEl);
    const formRole = document.getElementById('form_role');
    const btnSubmitRole = document.getElementById('btn_submit_role');

    // Filter Search in Table
    const searchInput = document.querySelector('[data-kt-filter="search"]');
    if (searchInput) {
        searchInput.addEventListener('keyup', function(e) {
            const query = e.target.value.toLowerCase();
            document.querySelectorAll('#kt_table_roles tbody tr').forEach(row => {
                const text = row.innerText.toLowerCase();
                row.style.display = text.includes(query) ? '' : 'none';
            });
        });
    }

    function openCreateModal() {
        formRole.reset();
        document.getElementById('role_uuid').value = '';
        document.getElementById('modal_role_title').textContent = 'Tambah Role Akses';
        roleModal.show();
    }

    async function openEditModal(uuid) {
        formRole.reset();
        document.getElementById('role_uuid').value = uuid;
        document.getElementById('modal_role_title').textContent = 'Edit Role Akses';

        try {
            const response = await fetch(`{{ url('admin/roles') }}/${uuid}`, {
                headers: { 'Accept': 'application/json' }
            });
            const result = await response.json();
            if (result.success && result.data) {
                document.getElementById('namaRole').value = result.data.namaRole || '';
                roleModal.show();
            } else {
                Swal.fire('Error', 'Gagal memuat data role', 'error');
            }
        } catch (error) {
            Swal.fire('Error', 'Terjadi kesalahan sistem', 'error');
        }
    }

    formRole.addEventListener('submit', async function(e) {
        e.preventDefault();
        btnSubmitRole.setAttribute('data-kt-indicator', 'on');
        btnSubmitRole.disabled = true;

        const uuid = document.getElementById('role_uuid').value;
        const isEdit = Boolean(uuid);
        const url = isEdit ? `{{ url('admin/roles') }}/${uuid}` : `{{ route('admin.roles.store') }}`;
        const method = isEdit ? 'PUT' : 'POST';

        const payload = {
            namaRole: document.getElementById('namaRole').value
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
                roleModal.hide();
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: result.message,
                    timer: 1500,
                    showConfirmButton: false
                }).then(() => location.reload());
            } else {
                const errors = result.errors ? Object.values(result.errors).flat().join('<br>') : (result.message || 'Gagal menyimpan data');
                Swal.fire('Peringatan', errors, 'warning');
            }
        } catch (err) {
            Swal.fire('Error', 'Terjadi kesalahan koneksi', 'error');
        } finally {
            btnSubmitRole.removeAttribute('data-kt-indicator');
            btnSubmitRole.disabled = false;
        }
    });

    function confirmDelete(uuid, name) {
        Swal.fire({
            title: 'Hapus Role?',
            html: `Apakah Anda yakin ingin menghapus role <b>"${name}"</b>?`,
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
                    const response = await fetch(`{{ url('admin/roles') }}/${uuid}`, {
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
                        Swal.fire('Gagal', result.message || 'Role tidak dapat dihapus', 'error');
                    }
                } catch (e) {
                    Swal.fire('Error', 'Kesalahan jaringan', 'error');
                }
            }
        });
    }
</script>
@endpush
