@extends('layouts.admin')

@section('title', 'Manajemen Visi & Misi')
@section('page_title', 'Manajemen Visi & Misi')
@section('breadcrumb', 'Visi & Misi')

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
                <input type="text" data-kt-filter="search" class="form-control form-control-solid w-250px ps-12" placeholder="Cari visi/misi..." />
            </div>
        </div>
        <div class="card-toolbar">
            <button type="button" class="btn btn-primary" onclick="openCreateModal()">
                <i class="ki-duotone ki-plus fs-2 me-1"></i>
                Tambah Visi &amp; Misi
            </button>
        </div>
    </div>
    <!--end::Card header-->

    <!--begin::Card body-->
    <div class="card-body pt-0">
        <div class="table-responsive">
            <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_table_visi_misi">
                <thead>
                    <tr class="text-start text-gray-500 fw-bold fs-7 text-uppercase gs-0">
                        <th class="w-10px pe-2">#</th>
                        <th class="min-w-200px">Visi</th>
                        <th class="min-w-300px">Misi</th>
                        <th>Tanggal Dibuat</th>
                        <th class="text-end min-w-100px">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-gray-600 fw-semibold">
                    @forelse($visionMissions as $index => $item)
                    <tr id="row-{{ $item->uuid }}">
                        <td>{{ $index + 1 }}</td>
                        <td class="text-gray-900 fw-bold">
                            {{ Str::limit($item->visi, 120) }}
                        </td>
                        <td>
                            <div class="text-gray-700 fs-7" style="white-space: pre-line;">{{ Str::limit($item->misi, 180) }}</div>
                        </td>
                        <td>{{ $item->created_at ? $item->created_at->format('d M Y, H:i') : '-' }}</td>
                        <td class="text-end">
                            <button type="button" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1" onclick="openEditModal('{{ $item->uuid }}')" title="Edit">
                                <i class="ki-duotone ki-pencil fs-3"><span class="path1"></span><span class="path2"></span></i>
                            </button>
                            <button type="button" class="btn btn-icon btn-bg-light btn-active-color-danger btn-sm" onclick="confirmDelete('{{ $item->uuid }}')" title="Hapus">
                                <i class="ki-duotone ki-trash fs-3"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span></i>
                            </button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-10 text-muted">Belum ada data visi dan misi.</td>
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
<!--begin::Modal Form Visi Misi-->
<div class="modal fade" id="modal_visi_misi" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-700px">
        <div class="modal-content">
            <div class="modal-header" id="kt_modal_visi_misi_header">
                <h2 class="fw-bold" id="modal_visi_misi_title">Tambah Visi &amp; Misi</h2>
                <div class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal">
                    <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                </div>
            </div>

            <form id="form_visi_misi" class="form">
                <div class="modal-body py-10 px-lg-17">
                    <input type="hidden" id="item_uuid" name="uuid" value="">

                    <!-- Visi -->
                    <div class="fv-row mb-7">
                        <label class="required fs-6 fw-semibold mb-2">Visi Perusahaan</label>
                        <textarea class="form-control form-control-solid" rows="3" name="visi" id="visi" placeholder="Tuliskan pernyataan visi perusahaan..." required></textarea>
                    </div>

                    <!-- Misi -->
                    <div class="fv-row mb-7">
                        <label class="required fs-6 fw-semibold mb-2">Misi Perusahaan</label>
                        <textarea class="form-control form-control-solid" rows="6" name="misi" id="misi" placeholder="Tuliskan butir-butir misi perusahaan..." required></textarea>
                        <div class="form-text text-muted">Gunakan baris baru atau penomoran untuk poin-poin misi.</div>
                    </div>
                </div>

                <div class="modal-footer flex-center">
                    <button type="button" class="btn btn-light me-3" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary" id="btn_submit_visi_misi">
                        <span class="indicator-label">Simpan</span>
                        <span class="indicator-progress">Memproses... <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<!--end::Modal Form Visi Misi-->
@endsection

@push('scripts')
<script>
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    const vmModalEl = document.getElementById('modal_visi_misi');
    const vmModal = new bootstrap.Modal(vmModalEl);
    const formVM = document.getElementById('form_visi_misi');
    const btnSubmitVM = document.getElementById('btn_submit_visi_misi');

    // Filter Search
    const searchInput = document.querySelector('[data-kt-filter="search"]');
    if (searchInput) {
        searchInput.addEventListener('keyup', function(e) {
            const query = e.target.value.toLowerCase();
            document.querySelectorAll('#kt_table_visi_misi tbody tr').forEach(row => {
                const text = row.innerText.toLowerCase();
                row.style.display = text.includes(query) ? '' : 'none';
            });
        });
    }

    function openCreateModal() {
        formVM.reset();
        document.getElementById('item_uuid').value = '';
        document.getElementById('modal_visi_misi_title').textContent = 'Tambah Visi & Misi';
        vmModal.show();
    }

    async function openEditModal(uuid) {
        formVM.reset();
        document.getElementById('item_uuid').value = uuid;
        document.getElementById('modal_visi_misi_title').textContent = 'Edit Visi & Misi';

        try {
            const response = await fetch(`{{ url('admin/visi-misi') }}/${uuid}`, {
                headers: { 'Accept': 'application/json' }
            });
            const result = await response.json();
            if (result.success && result.data) {
                document.getElementById('visi').value = result.data.visi || '';
                document.getElementById('misi').value = result.data.misi || '';
                vmModal.show();
            } else {
                Swal.fire('Error', 'Gagal memuat data visi misi', 'error');
            }
        } catch (error) {
            Swal.fire('Error', 'Terjadi kesalahan sistem', 'error');
        }
    }

    formVM.addEventListener('submit', async function(e) {
        e.preventDefault();
        btnSubmitVM.setAttribute('data-kt-indicator', 'on');
        btnSubmitVM.disabled = true;

        const uuid = document.getElementById('item_uuid').value;
        const isEdit = Boolean(uuid);
        const url = isEdit ? `{{ url('admin/visi-misi') }}/${uuid}` : `{{ route('admin.visi-misi.store') }}`;
        const method = isEdit ? 'PUT' : 'POST';

        const payload = {
            visi: document.getElementById('visi').value,
            misi: document.getElementById('misi').value,
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
                vmModal.hide();
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
            Swal.fire('Error', 'Terjadi kesalahan jaringan', 'error');
        } finally {
            btnSubmitVM.removeAttribute('data-kt-indicator');
            btnSubmitVM.disabled = false;
        }
    });

    function confirmDelete(uuid) {
        Swal.fire({
            title: 'Hapus Visi & Misi?',
            text: 'Data visi dan misi ini akan dihapus dari sistem.',
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
                    const response = await fetch(`{{ url('admin/visi-misi') }}/${uuid}`, {
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
                        Swal.fire('Gagal', result.message || 'Gagal menghapus data', 'error');
                    }
                } catch (e) {
                    Swal.fire('Error', 'Kesalahan jaringan', 'error');
                }
            }
        });
    }
</script>
@endpush
