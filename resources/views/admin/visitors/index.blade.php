@extends('layouts.admin')

@section('title', 'Manajemen Pengunjung (Visitor)')
@section('page_title', 'Manajemen Pengunjung (Visitor)')
@section('breadcrumb', 'Log Pengunjung')

@section('content')
<!--begin::Stats-->
<div class="row g-5 g-xl-10 mb-5">
    <div class="col-sm-6 col-xl-4">
        <div class="card bg-light-primary card-flush h-md-100">
            <div class="card-body">
                <span class="fs-2hx fw-bold text-gray-900 me-2">{{ number_format($totalUnique) }}</span>
                <span class="fs-4 fw-semibold text-gray-600">Total Pengunjung Unik (IP)</span>
                <div class="text-muted fs-7 mt-1">Akumulasi kunjungan terdaftar di database</div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-4">
        <div class="card bg-light-success card-flush h-md-100">
            <div class="card-body">
                <span class="fs-2hx fw-bold text-success me-2">{{ number_format($todayUnique) }}</span>
                <span class="fs-4 fw-semibold text-gray-600">Pengunjung Unik Hari Ini</span>
                <div class="text-muted fs-7 mt-1">Tanggal: {{ now()->translatedFormat('d F Y') }}</div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-4">
        <div class="card bg-light-info card-flush h-md-100">
            <div class="card-body">
                <span class="fs-2hx fw-bold text-info me-2">1x / Hari</span>
                <span class="fs-4 fw-semibold text-gray-600">Aturan Dedup IP Aktif</span>
                <div class="text-muted fs-7 mt-1">IP yang sama tidak akan dihitung ulang di hari yang sama</div>
            </div>
        </div>
    </div>
</div>
<!--end::Stats-->

<div class="card card-flush shadow-sm">
    <!--begin::Card header-->
    <div class="card-header align-items-center py-5 gap-2 gap-md-5">
        <div class="card-title">
            <div class="d-flex align-items-center position-relative my-1">
                <i class="ki-duotone ki-magnifier fs-3 position-absolute ms-4">
                    <span class="path1"></span>
                    <span class="path2"></span>
                </i>
                <input type="text" data-kt-filter="search" class="form-control form-control-solid w-250px ps-12" placeholder="Cari IP / Page..." />
            </div>
        </div>
        <div class="card-toolbar gap-3">
            <form method="GET" action="{{ route('admin.visitors.index') }}" class="d-flex align-items-center gap-2">
                <input type="date" name="date" class="form-control form-control-solid w-175px" value="{{ request('date') }}" />
                <button type="submit" class="btn btn-sm btn-light-primary fw-bold">Filter</button>
                @if(request('date'))
                    <a href="{{ route('admin.visitors.index') }}" class="btn btn-sm btn-light-secondary fw-bold">Reset</a>
                @endif
            </form>
        </div>
    </div>
    <!--end::Card header-->

    <!--begin::Card body-->
    <div class="card-body pt-0">
        <div class="table-responsive">
            <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_table_visitors">
                <thead>
                    <tr class="text-start text-gray-500 fw-bold fs-7 text-uppercase gs-0">
                        <th class="w-10px pe-2">#</th>
                        <th>Alamat IP</th>
                        <th>Halaman Diakses</th>
                        <th>User Agent (Perangkat / Browser)</th>
                        <th>Tanggal Kunjungan</th>
                        <th>Waktu Log</th>
                        <th class="text-end min-w-100px">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-gray-600 fw-semibold">
                    @forelse($visitors as $index => $v)
                    <tr id="row-{{ $v->uuid }}">
                        <td>{{ $visitors->firstItem() + $index }}</td>
                        <td>
                            <div class="d-flex align-items-center">
                                <span class="badge badge-light-primary font-monospace fs-7 me-2">
                                    <i class="ki-duotone ki-geolocation text-primary me-1 fs-6"><span class="path1"></span><span class="path2"></span></i>
                                    {{ $v->ip_address }}
                                </span>
                            </div>
                        </td>
                        <td>
                            <code class="text-gray-800">{{ $v->page_visited ?: '/' }}</code>
                        </td>
                        <td>
                            <span class="text-gray-700 fs-7" title="{{ $v->user_agent }}">{{ Str::limit($v->user_agent, 45) }}</span>
                        </td>
                        <td>
                            <span class="badge badge-light-info">{{ \Carbon\Carbon::parse($v->visit_date)->format('d M Y') }}</span>
                        </td>
                        <td>{{ $v->created_at ? $v->created_at->format('H:i:s') : '-' }}</td>
                        <td class="text-end">
                            <button type="button" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1" onclick="showVisitorDetail('{{ $v->uuid }}', '{{ $v->ip_address }}', '{{ $v->page_visited }}', '{{ addslashes($v->user_agent) }}', '{{ $v->visit_date }}', '{{ $v->created_at ? $v->created_at->format('d M Y H:i:s') : '-' }}')" title="Detail">
                                <i class="ki-duotone ki-eye fs-3"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i>
                            </button>
                            <button type="button" class="btn btn-icon btn-bg-light btn-active-color-danger btn-sm" onclick="confirmDeleteVisitor('{{ $v->uuid }}', '{{ $v->ip_address }}')" title="Hapus Log">
                                <i class="ki-duotone ki-trash fs-3"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span></i>
                            </button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center py-10 text-muted">Belum ada catatan pengunjung pada tanggal yang dipilih.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-between align-items-center mt-5">
            <div class="text-muted fs-7">
                Menampilkan {{ $visitors->firstItem() ?? 0 }} - {{ $visitors->lastItem() ?? 0 }} dari {{ $visitors->total() }} total log
            </div>
            <div>
                {{ $visitors->withQueryString()->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
    <!--end::Card body-->
</div>
@endsection

@section('modals')
<!--begin::Modal Detail Visitor-->
<div class="modal fade" id="modal_visitor_detail" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-600px">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="fw-bold">Detail Pengunjung Website</h2>
                <div class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal">
                    <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                </div>
            </div>

            <div class="modal-body py-8 px-lg-12">
                <table class="table align-middle table-row-bordered fs-6 gy-3">
                    <tbody>
                        <tr>
                            <td class="text-muted fw-bold w-150px">UUID</td>
                            <td class="text-gray-900 font-monospace" id="det_uuid">-</td>
                        </tr>
                        <tr>
                            <td class="text-muted fw-bold">Alamat IP</td>
                            <td class="text-primary fw-bold font-monospace" id="det_ip">-</td>
                        </tr>
                        <tr>
                            <td class="text-muted fw-bold">Tanggal Kunjungan</td>
                            <td class="text-gray-800" id="det_date">-</td>
                        </tr>
                        <tr>
                            <td class="text-muted fw-bold">Timestamp Log</td>
                            <td class="text-gray-800" id="det_time">-</td>
                        </tr>
                        <tr>
                            <td class="text-muted fw-bold">Halaman Pertama</td>
                            <td class="text-gray-800 font-monospace" id="det_page">-</td>
                        </tr>
                        <tr>
                            <td class="text-muted fw-bold align-top">User Agent</td>
                            <td class="text-gray-700 fs-7 word-break" id="det_ua" style="word-break: break-all;">-</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="modal-footer flex-center">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
<!--end::Modal Detail Visitor-->
@endsection

@push('scripts')
<script>
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    const detailModalEl = document.getElementById('modal_visitor_detail');
    const detailModal = new bootstrap.Modal(detailModalEl);

    // Search filter
    const searchInput = document.querySelector('[data-kt-filter="search"]');
    if (searchInput) {
        searchInput.addEventListener('keyup', function(e) {
            const query = e.target.value.toLowerCase();
            document.querySelectorAll('#kt_table_visitors tbody tr').forEach(row => {
                const text = row.innerText.toLowerCase();
                row.style.display = text.includes(query) ? '' : 'none';
            });
        });
    }

    function showVisitorDetail(uuid, ip, page, ua, date, time) {
        document.getElementById('det_uuid').textContent = uuid;
        document.getElementById('det_ip').textContent = ip;
        document.getElementById('det_page').textContent = page || '/';
        document.getElementById('det_ua').textContent = ua || '-';
        document.getElementById('det_date').textContent = date;
        document.getElementById('det_time').textContent = time;
        detailModal.show();
    }

    function confirmDeleteVisitor(uuid, ip) {
        Swal.fire({
            title: 'Hapus Log Visitor?',
            html: `Apakah Anda yakin ingin menghapus catatan log untuk IP <b>"${ip}"</b>?`,
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
                    const response = await fetch(`{{ url('admin/visitors') }}/${uuid}`, {
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
                        Swal.fire('Gagal', result.message || 'Gagal menghapus log', 'error');
                    }
                } catch (e) {
                    Swal.fire('Error', 'Kesalahan jaringan', 'error');
                }
            }
        });
    }
</script>
@endpush
