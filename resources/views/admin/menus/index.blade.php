@extends('layouts.admin')

@section('title', 'Manajemen Menu & Akses')
@section('page_title', 'Manajemen Menu & Akses')
@section('breadcrumb', 'Menu & Akses')

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
                <input type="text" data-kt-filter="search" class="form-control form-control-solid w-250px ps-12" placeholder="Cari menu..." />
            </div>
        </div>
        <div class="card-toolbar">
            <button type="button" class="btn btn-primary" onclick="openCreateModal()">
                <i class="ki-duotone ki-plus fs-2 me-1"></i>
                Tambah Menu
            </button>
        </div>
    </div>
    <!--end::Card header-->

    <!--begin::Card body-->
    <div class="card-body pt-0">
        <div class="table-responsive">
            <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_table_menus">
                <thead>
                    <tr class="text-start text-gray-500 fw-bold fs-7 text-uppercase gs-0">
                        <th class="w-10px pe-2">#</th>
                        <th>Nama Menu</th>
                        <th>URL</th>
                        <th>Icon</th>
                        <th>Akses Role</th>
                        <th>Urutan</th>
                        <th class="text-end min-w-100px">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-gray-600 fw-semibold">
                    @forelse($menus as $index => $menu)
                    <tr id="row-{{ $menu->uuid }}">
                        <td>{{ $index + 1 }}</td>
                        <td class="text-gray-900 fw-bold">
                            <i class="{{ $menu->icon ?: 'ki-duotone ki-element-11' }} text-primary me-2 fs-5"></i>
                            {{ $menu->namaMenu }}
                        </td>
                        <td><code>{{ $menu->url ?: '#' }}</code></td>
                        <td><span class="badge badge-light">{{ $menu->icon ?: 'default' }}</span></td>
                        <td>
                            @if(is_array($menu->akses) && count($menu->akses) > 0)
                                @foreach($menu->akses as $role)
                                    <span class="badge badge-light-primary me-1">{{ $role }}</span>
                                @endforeach
                            @else
                                <span class="badge badge-light-dark">Semua Role</span>
                            @endif
                        </td>
                        <td>{{ $menu->urutan ?? 0 }}</td>
                        <td class="text-end">
                            <button type="button" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1" onclick="openEditModal('{{ $menu->uuid }}')" title="Edit">
                                <i class="ki-duotone ki-pencil fs-3"><span class="path1"></span><span class="path2"></span></i>
                            </button>
                            <button type="button" class="btn btn-icon btn-bg-light btn-active-color-danger btn-sm" onclick="confirmDelete('{{ $menu->uuid }}', '{{ addslashes($menu->namaMenu) }}')" title="Hapus">
                                <i class="ki-duotone ki-trash fs-3"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span></i>
                            </button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center py-10 text-muted">Belum ada menu yang didaftarkan.</td>
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
<!--begin::Modal Form Menu-->
<div class="modal fade" id="modal_menu" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <div class="modal-content">
            <div class="modal-header" id="kt_modal_menu_header">
                <h2 class="fw-bold" id="modal_menu_title">Tambah Menu &amp; Akses</h2>
                <div class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal">
                    <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                </div>
            </div>

            <form id="form_menu" class="form">
                <div class="modal-body py-10 px-lg-17">
                    <input type="hidden" id="menu_uuid" name="uuid" value="">

                    <!-- Nama Menu -->
                    <div class="fv-row mb-7">
                        <label class="required fs-6 fw-semibold mb-2">Nama Menu</label>
                        <input type="text" class="form-control form-control-solid" placeholder="Contoh: Manajemen Layanan" name="namaMenu" id="namaMenu" required />
                    </div>

                    <!-- URL / Route -->
                    <div class="fv-row mb-7">
                        <label class="fs-6 fw-semibold mb-2">URL / Path</label>
                        <input type="text" class="form-control form-control-solid" placeholder="Contoh: /admin/layanan" name="url" id="url" />
                    </div>

                    <!-- Icon Class -->
                    <div class="fv-row mb-7">
                        <label class="fs-6 fw-semibold mb-2">Class Icon (Keenicons / FontAwesome)</label>
                        <input type="text" class="form-control form-control-solid" placeholder="Contoh: ki-duotone ki-abstract-26" name="icon" id="icon" />
                    </div>

                    <!-- Urutan -->
                    <div class="fv-row mb-7">
                        <label class="fs-6 fw-semibold mb-2">Urutan Tampilan</label>
                        <input type="number" class="form-control form-control-solid" placeholder="1" name="urutan" id="urutan" value="1" />
                    </div>

                    <!-- Akses Role -->
                    <div class="fv-row mb-7">
                        <label class="fs-6 fw-semibold mb-2">Hak Akses Role</label>
                        <div class="d-flex flex-wrap gap-4 mt-2">
                            @foreach($roles as $role)
                            <label class="form-check form-check-custom form-check-solid">
                                <input class="form-check-input role-checkbox" type="checkbox" name="akses[]" value="{{ $role->namaRole }}" id="role_{{ $role->id }}" />
                                <span class="form-check-label text-gray-800 fw-semibold">{{ $role->namaRole }}</span>
                            </label>
                            @endforeach
                        </div>
                        <div class="form-text text-muted">Pilih role mana saja yang diizinkan mengakses menu ini. Kosongkan jika untuk semua role.</div>
                    </div>
                </div>

                <div class="modal-footer flex-center">
                    <button type="button" class="btn btn-light me-3" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary" id="btn_submit_menu">
                        <span class="indicator-label">Simpan</span>
                        <span class="indicator-progress">Memproses... <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<!--end::Modal Form Menu-->
@endsection

@push('scripts')
<script>
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    const menuModalEl = document.getElementById('modal_menu');
    const menuModal = new bootstrap.Modal(menuModalEl);
    const formMenu = document.getElementById('form_menu');
    const btnSubmit = document.getElementById('btn_submit_menu');

    // Filter Search in Table
    const searchInput = document.querySelector('[data-kt-filter="search"]');
    if (searchInput) {
        searchInput.addEventListener('keyup', function(e) {
            const query = e.target.value.toLowerCase();
            document.querySelectorAll('#kt_table_menus tbody tr').forEach(row => {
                const text = row.innerText.toLowerCase();
                row.style.display = text.includes(query) ? '' : 'none';
            });
        });
    }

    function openCreateModal() {
        formMenu.reset();
        document.getElementById('menu_uuid').value = '';
        document.getElementById('modal_menu_title').textContent = 'Tambah Menu & Akses';
        document.querySelectorAll('.role-checkbox').forEach(cb => cb.checked = false);
        menuModal.show();
    }

    async function openEditModal(uuid) {
        formMenu.reset();
        document.getElementById('menu_uuid').value = uuid;
        document.getElementById('modal_menu_title').textContent = 'Edit Menu & Akses';
        document.querySelectorAll('.role-checkbox').forEach(cb => cb.checked = false);

        try {
            const response = await fetch(`{{ url('admin/menus') }}/${uuid}`, {
                headers: { 'Accept': 'application/json' }
            });
            const result = await response.json();
            if (result.success && result.data) {
                const m = result.data;
                document.getElementById('namaMenu').value = m.namaMenu || '';
                document.getElementById('url').value = m.url || '';
                document.getElementById('icon').value = m.icon || '';
                document.getElementById('urutan').value = m.urutan || 1;

                if (Array.isArray(m.akses)) {
                    document.querySelectorAll('.role-checkbox').forEach(cb => {
                        if (m.akses.includes(cb.value)) {
                            cb.checked = true;
                        }
                    });
                }
                menuModal.show();
            } else {
                Swal.fire('Error', 'Gagal memuat data menu', 'error');
            }
        } catch (error) {
            Swal.fire('Error', 'Terjadi kesalahan sistem', 'error');
        }
    }

    formMenu.addEventListener('submit', async function(e) {
        e.preventDefault();
        btnSubmit.setAttribute('data-kt-indicator', 'on');
        btnSubmit.disabled = true;

        const uuid = document.getElementById('menu_uuid').value;
        const isEdit = Boolean(uuid);
        const url = isEdit ? `{{ url('admin/menus') }}/${uuid}` : `{{ route('admin.menus.store') }}`;
        const method = isEdit ? 'PUT' : 'POST';

        const checkedRoles = [];
        document.querySelectorAll('.role-checkbox:checked').forEach(cb => checkedRoles.push(cb.value));

        const payload = {
            namaMenu: document.getElementById('namaMenu').value,
            url: document.getElementById('url').value,
            icon: document.getElementById('icon').value,
            urutan: parseInt(document.getElementById('urutan').value) || 0,
            akses: checkedRoles
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
                menuModal.hide();
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: result.message,
                    timer: 1500,
                    showConfirmButton: false
                }).then(() => location.reload());
            } else {
                const errors = result.errors ? Object.values(result.errors).flat().join('<br>') : (result.message || 'Gagal menyimpan data');
                Swal.fire('Validasi Gagal', errors, 'warning');
            }
        } catch (err) {
            Swal.fire('Error', 'Terjadi kesalahan koneksi', 'error');
        } finally {
            btnSubmit.removeAttribute('data-kt-indicator');
            btnSubmit.disabled = false;
        }
    });

    function confirmDelete(uuid, name) {
        Swal.fire({
            title: 'Hapus Menu?',
            html: `Apakah Anda yakin ingin menghapus menu <b>"${name}"</b>? Tindakan ini tidak dapat dibatalkan.`,
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
                    const response = await fetch(`{{ url('admin/menus') }}/${uuid}`, {
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
                        Swal.fire('Gagal', result.message || 'Tidak dapat menghapus', 'error');
                    }
                } catch (e) {
                    Swal.fire('Error', 'Kesalahan jaringan', 'error');
                }
            }
        });
    }
</script>
@endpush
