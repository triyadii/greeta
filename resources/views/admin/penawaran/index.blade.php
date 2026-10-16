@extends('layouts.admin')

@section('title', 'Manajemen Penawaran')
@section('page_title', 'Manajemen Penawaran')
@section('breadcrumb', 'Penawaran')

@section('content')
<!--begin::Stat Summary-->
<div class="row g-5 g-xl-10 mb-5">
    <div class="col-sm-6 col-xl-3">
        <div class="card bg-light-primary card-flush bgi-no-repeat bgi-size-contain bgi-position-x-end h-md-100">
            <div class="card-body">
                <span class="fs-2hx fw-bold text-gray-900 me-2">{{ $quotations->count() }}</span>
                <span class="fs-4 fw-semibold text-gray-600">Total Penawaran</span>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="card bg-light-warning card-flush bgi-no-repeat bgi-size-contain bgi-position-x-end h-md-100">
            <div class="card-body">
                <span class="fs-2hx fw-bold text-warning me-2">{{ $quotations->where('status', 'baru')->count() }}</span>
                <span class="fs-4 fw-semibold text-gray-600">Perlu Diproses</span>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="card bg-light-info card-flush bgi-no-repeat bgi-size-contain bgi-position-x-end h-md-100">
            <div class="card-body">
                <span class="fs-2hx fw-bold text-info me-2">{{ $quotations->where('status', 'diproses')->count() }}</span>
                <span class="fs-4 fw-semibold text-gray-600">Sedang Diproses</span>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="card bg-light-success card-flush bgi-no-repeat bgi-size-contain bgi-position-x-end h-md-100">
            <div class="card-body">
                <span class="fs-2hx fw-bold text-success me-2">{{ $quotations->where('status', 'selesai')->count() }}</span>
                <span class="fs-4 fw-semibold text-gray-600">Selesai / Terhubung</span>
            </div>
        </div>
    </div>
</div>
<!--end::Stat Summary-->

<div class="card card-flush shadow-sm">
    <!--begin::Card header-->
    <div class="card-header align-items-center py-5 gap-2 gap-md-5">
        <div class="card-title">
            <div class="d-flex align-items-center position-relative my-1">
                <i class="ki-duotone ki-magnifier fs-3 position-absolute ms-4">
                    <span class="path1"></span>
                    <span class="path2"></span>
                </i>
                <input type="text" data-kt-filter="search" class="form-control form-control-solid w-250px ps-12" placeholder="Cari PIC / Perusahaan..." />
            </div>
        </div>
        <div class="card-toolbar">
            <button type="button" class="btn btn-primary" onclick="openCreateModal()">
                <i class="ki-duotone ki-plus fs-2 me-1"></i>
                Tambah Penawaran
            </button>
        </div>
    </div>
    <!--end::Card header-->

    <!--begin::Card body-->
    <div class="card-body pt-0">
        <div class="table-responsive">
            <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_table_penawaran">
                <thead>
                    <tr class="text-start text-gray-500 fw-bold fs-7 text-uppercase gs-0">
                        <th class="w-10px pe-2">#</th>
                        <th>Nama PIC &amp; Perusahaan</th>
                        <th>Kontak</th>
                        <th>Jenis Kebutuhan</th>
                        <th>Status</th>
                        <th>Tanggal Masuk</th>
                        <th class="text-end min-w-100px">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-gray-600 fw-semibold">
                    @forelse($quotations as $index => $q)
                    <tr id="row-{{ $q->uuid }}">
                        <td>{{ $index + 1 }}</td>
                        <td>
                            <div class="text-gray-900 fw-bold fs-6">{{ $q->namaPIC }}</div>
                            <div class="text-muted fs-7">{{ $q->namaPerusahaan }}</div>
                        </td>
                        <td>
                            <div><i class="ki-duotone ki-phone text-success fs-7 me-1"></i> {{ $q->nomorTelepon }}</div>
                            @if($q->email)
                            <div><i class="ki-duotone ki-sms text-primary fs-7 me-1"></i> {{ $q->email }}</div>
                            @endif
                        </td>
                        <td>
                            <span class="badge badge-light-dark">{{ $q->jenisKebutuhan ?? 'Umum' }}</span>
                        </td>
                        <td>
                            @if($q->status === 'baru')
                                <span class="badge badge-light-warning">Baru</span>
                            @elseif($q->status === 'diproses')
                                <span class="badge badge-light-info">Diproses</span>
                            @else
                                <span class="badge badge-light-success">Selesai</span>
                            @endif
                        </td>
                        <td>{{ $q->created_at ? $q->created_at->format('d M Y, H:i') : '-' }}</td>
                        <td class="text-end">
                            <button type="button" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1" onclick="openEditModal('{{ $q->uuid }}')" title="Edit / Detail">
                                <i class="ki-duotone ki-pencil fs-3"><span class="path1"></span><span class="path2"></span></i>
                            </button>
                            <button type="button" class="btn btn-icon btn-bg-light btn-active-color-danger btn-sm" onclick="confirmDelete('{{ $q->uuid }}', '{{ addslashes($q->namaPIC) }}')" title="Hapus">
                                <i class="ki-duotone ki-trash fs-3"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span></i>
                            </button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center py-10 text-muted">Belum ada data penawaran masuk.</td>
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
<!--begin::Modal Form Penawaran-->
<div class="modal fade" id="modal_penawaran" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-700px">
        <div class="modal-content">
            <div class="modal-header" id="kt_modal_penawaran_header">
                <h2 class="fw-bold" id="modal_penawaran_title">Tambah Data Penawaran</h2>
                <div class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal">
                    <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                </div>
            </div>

            <form id="form_penawaran" class="form">
                <div class="modal-body py-10 px-lg-17 scroll-y" style="max-height: 70vh;">
                    <input type="hidden" id="penawaran_uuid" name="uuid" value="">

                    <div class="row g-5 mb-7">
                        <div class="col-md-6">
                            <label class="required fs-6 fw-semibold mb-2">Nama PIC</label>
                            <input type="text" class="form-control form-control-solid" name="namaPIC" id="namaPIC" placeholder="Nama Lengkap Penanggung Jawab" required />
                        </div>
                        <div class="col-md-6">
                            <label class="required fs-6 fw-semibold mb-2">Nama Perusahaan / Institusi</label>
                            <input type="text" class="form-control form-control-solid" name="namaPerusahaan" id="namaPerusahaan" placeholder="PT / Instansi" required />
                        </div>
                    </div>

                    <div class="row g-5 mb-7">
                        <div class="col-md-6">
                            <label class="required fs-6 fw-semibold mb-2">Nomor Telepon (WhatsApp)</label>
                            <input type="text" class="form-control form-control-solid" name="nomorTelepon" id="nomorTelepon" placeholder="08xxxxxxxx" required />
                        </div>
                        <div class="col-md-6">
                            <label class="fs-6 fw-semibold mb-2">Email</label>
                            <input type="email" class="form-control form-control-solid" name="email" id="email" placeholder="pic@perusahaan.com" />
                        </div>
                    </div>

                    <div class="row g-5 mb-7">
                        <div class="col-md-6">
                            <label class="fs-6 fw-semibold mb-2">Jenis Kebutuhan</label>
                            <input type="text" class="form-control form-control-solid" name="jenisKebutuhan" id="jenisKebutuhan" placeholder="Misal: CCTV & Security System" />
                        </div>
                        <div class="col-md-6">
                            <label class="required fs-6 fw-semibold mb-2">Status Penawaran</label>
                            <select class="form-select form-select-solid" name="status" id="status" required>
                                <option value="baru">Baru</option>
                                <option value="diproses">Sedang Diproses</option>
                                <option value="selesai">Selesai</option>
                            </select>
                        </div>
                    </div>

                    <!-- Deskripsi -->
                    <div class="fv-row mb-7">
                        <label class="fs-6 fw-semibold mb-2">Deskripsi Kebutuhan</label>
                        <textarea class="form-control form-control-solid" rows="4" name="deskripsi" id="deskripsi" placeholder="Rincian proyek atau kebutuhan spesifik..."></textarea>
                    </div>
                </div>

                <div class="modal-footer flex-center">
                    <button type="button" class="btn btn-light me-3" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary" id="btn_submit_penawaran">
                        <span class="indicator-label">Simpan</span>
                        <span class="indicator-progress">Memproses... <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<!--end::Modal Form Penawaran-->
@endsection

@push('scripts')
<script>
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    const penawaranModalEl = document.getElementById('modal_penawaran');
    const penawaranModal = new bootstrap.Modal(penawaranModalEl);
    const formPenawaran = document.getElementById('form_penawaran');
    const btnSubmit = document.getElementById('btn_submit_penawaran');

    // Filter Search
    const searchInput = document.querySelector('[data-kt-filter="search"]');
    if (searchInput) {
        searchInput.addEventListener('keyup', function(e) {
            const query = e.target.value.toLowerCase();
            document.querySelectorAll('#kt_table_penawaran tbody tr').forEach(row => {
                const text = row.innerText.toLowerCase();
                row.style.display = text.includes(query) ? '' : 'none';
            });
        });
    }

    function openCreateModal() {
        formPenawaran.reset();
        document.getElementById('penawaran_uuid').value = '';
        document.getElementById('modal_penawaran_title').textContent = 'Tambah Data Penawaran';
        document.getElementById('status').value = 'baru';
        penawaranModal.show();
    }

    async function openEditModal(uuid) {
        formPenawaran.reset();
        document.getElementById('penawaran_uuid').value = uuid;
        document.getElementById('modal_penawaran_title').textContent = 'Edit Data Penawaran';

        try {
            const response = await fetch(`{{ url('admin/penawaran') }}/${uuid}`, {
                headers: { 'Accept': 'application/json' }
            });
            const result = await response.json();
            if (result.success && result.data) {
                const q = result.data;
                document.getElementById('namaPIC').value = q.namaPIC || '';
                document.getElementById('namaPerusahaan').value = q.namaPerusahaan || '';
                document.getElementById('nomorTelepon').value = q.nomorTelepon || '';
                document.getElementById('email').value = q.email || '';
                document.getElementById('jenisKebutuhan').value = q.jenisKebutuhan || '';
                document.getElementById('status').value = q.status || 'baru';
                document.getElementById('deskripsi').value = q.deskripsi || '';
                penawaranModal.show();
            } else {
                Swal.fire('Error', 'Gagal mengambil data penawaran', 'error');
            }
        } catch (error) {
            Swal.fire('Error', 'Terjadi kesalahan sistem', 'error');
        }
    }

    formPenawaran.addEventListener('submit', async function(e) {
        e.preventDefault();
        btnSubmit.setAttribute('data-kt-indicator', 'on');
        btnSubmit.disabled = true;

        const uuid = document.getElementById('penawaran_uuid').value;
        const isEdit = Boolean(uuid);
        const url = isEdit ? `{{ url('admin/penawaran') }}/${uuid}` : `{{ route('admin.penawaran.store') }}`;
        const method = isEdit ? 'PUT' : 'POST';

        const payload = {
            namaPIC: document.getElementById('namaPIC').value,
            namaPerusahaan: document.getElementById('namaPerusahaan').value,
            nomorTelepon: document.getElementById('nomorTelepon').value,
            email: document.getElementById('email').value,
            jenisKebutuhan: document.getElementById('jenisKebutuhan').value,
            status: document.getElementById('status').value,
            deskripsi: document.getElementById('deskripsi').value,
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
                penawaranModal.hide();
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

    function confirmDelete(uuid, pic) {
        Swal.fire({
            title: 'Hapus Penawaran?',
            html: `Apakah Anda yakin ingin menghapus penawaran dari <b>"${pic}"</b>?`,
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
                    const response = await fetch(`{{ url('admin/penawaran') }}/${uuid}`, {
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
                        Swal.fire('Gagal', result.message || 'Gagal menghapus penawaran', 'error');
                    }
                } catch (e) {
                    Swal.fire('Error', 'Kesalahan jaringan', 'error');
                }
            }
        });
    }
</script>
@endpush
