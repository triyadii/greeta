@extends('layouts.admin')

@section('title', 'Dashboard')
@section('page_title', 'Dashboard Ringkasan')
@section('breadcrumb', 'Overview')

@section('content')
<!--begin::Row Stats-->
<div class="row g-5 g-xl-8 mb-6">
    <!-- Total Visitor -->
    <div class="col-xl-3 col-md-6">
        <div class="card bg-light-primary card-xl-stretch mb-xl-8 border border-primary border-dashed">
            <div class="card-body">
                <i class="ki-duotone ki-people fs-2tx text-primary mb-3">
                    <span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span>
                </i>
                <div class="text-gray-900 fw-bold fs-2 mb-2 mt-2">{{ number_format($totalVisitors) }}</div>
                <div class="fw-semibold text-gray-600">Total Kunjungan Unik (IP)</div>
            </div>
        </div>
    </div>

    <!-- Visitor Hari Ini -->
    <div class="col-xl-3 col-md-6">
        <div class="card bg-light-success card-xl-stretch mb-xl-8 border border-success border-dashed">
            <div class="card-body">
                <i class="ki-duotone ki-calendar-tick fs-2tx text-success mb-3">
                    <span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span><span class="path6"></span>
                </i>
                <div class="text-gray-900 fw-bold fs-2 mb-2 mt-2">{{ number_format($visitorsToday) }}</div>
                <div class="fw-semibold text-gray-600">Pengunjung Hari Ini (1x/IP)</div>
            </div>
        </div>
    </div>

    <!-- Visitor Bulan Ini -->
    <div class="col-xl-3 col-md-6">
        <div class="card bg-light-info card-xl-stretch mb-xl-8 border border-info border-dashed">
            <div class="card-body">
                <i class="ki-duotone ki-chart-simple fs-2tx text-info mb-3">
                    <span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span>
                </i>
                <div class="text-gray-900 fw-bold fs-2 mb-2 mt-2">{{ number_format($visitorsThisMonth) }}</div>
                <div class="fw-semibold text-gray-600">Kunjungan Bulan Ini</div>
            </div>
        </div>
    </div>

    <!-- Permintaan Penawaran -->
    <div class="col-xl-3 col-md-6">
        <div class="card bg-light-warning card-xl-stretch mb-xl-8 border border-warning border-dashed">
            <div class="card-body">
                <i class="ki-duotone ki-message-text-2 fs-2tx text-warning mb-3">
                    <span class="path1"></span><span class="path2"></span><span class="path3"></span>
                </i>
                <div class="text-gray-900 fw-bold fs-2 mb-2 mt-2">{{ number_format($totalQuotations) }}</div>
                <div class="fw-semibold text-gray-600">Total Penawaran Masuk ({{ $pendingQuotations }} Baru)</div>
            </div>
        </div>
    </div>
</div>
<!--end::Row Stats-->

<!--begin::Row Charts & Tables-->
<div class="row g-5 g-xl-8 mb-6">
    <!-- Chart Kunjungan 7 Hari -->
    <div class="col-xl-8">
        <div class="card card-xl-stretch mb-5 mb-xl-8 shadow-sm">
            <div class="card-header border-0 pt-5">
                <h3 class="card-title align-items-start flex-column">
                    <span class="card-label fw-bold fs-3 mb-1">Grafik Tren Kunjungan Visitor (7 Hari Terakhir)</span>
                    <span class="text-muted mt-1 fw-semibold fs-7">Setiap IP unik dihitung maksimal 1x per hari</span>
                </h3>
            </div>
            <div class="card-body">
                <div id="kt_charts_visitor" style="height: 300px"></div>
            </div>
        </div>
    </div>

    <!-- Quick Info Portofolio & Berita -->
    <div class="col-xl-4">
        <div class="card card-xl-stretch mb-5 mb-xl-8 shadow-sm">
            <div class="card-header border-0 pt-5">
                <h3 class="card-title align-items-start flex-column">
                    <span class="card-label fw-bold fs-3 mb-1">Status Konten &amp; Publikasi</span>
                    <span class="text-muted mt-1 fw-semibold fs-7">Ringkasan modul website</span>
                </h3>
            </div>
            <div class="card-body pt-2">
                <!-- Portofolio -->
                <div class="d-flex align-items-center mb-6">
                    <span class="bullet bullet-vertical h-40px bg-primary me-4"></span>
                    <div class="flex-grow-1">
                        <a href="{{ route('admin.portofolio.index') }}" class="text-gray-800 text-hover-primary fw-bold fs-6">Portofolio Proyek</a>
                        <span class="text-muted fw-semibold d-block">Studi kasus &amp; proyek unggulan</span>
                    </div>
                    <span class="badge badge-light-primary fs-7 fw-bold">{{ $totalPortfolios }} Item</span>
                </div>
                <!-- Berita -->
                <div class="d-flex align-items-center mb-6">
                    <span class="bullet bullet-vertical h-40px bg-success me-4"></span>
                    <div class="flex-grow-1">
                        <a href="{{ route('admin.berita.index') }}" class="text-gray-800 text-hover-primary fw-bold fs-6">Berita &amp; Artikel</a>
                        <span class="text-muted fw-semibold d-block">Publikasi wawasan teknologi</span>
                    </div>
                    <span class="badge badge-light-success fs-7 fw-bold">{{ $totalNews }} Post</span>
                </div>
                <!-- Penawaran -->
                <div class="d-flex align-items-center">
                    <span class="bullet bullet-vertical h-40px bg-warning me-4"></span>
                    <div class="flex-grow-1">
                        <a href="{{ route('admin.penawaran.index') }}" class="text-gray-800 text-hover-primary fw-bold fs-6">Penawaran Solusi IT</a>
                        <span class="text-muted fw-semibold d-block">Leads &amp; Permintaan Konsultasi</span>
                    </div>
                    <span class="badge badge-light-warning fs-7 fw-bold">{{ $pendingQuotations }} Pending</span>
                </div>
            </div>
        </div>
    </div>
</div>
<!--end::Row Charts & Tables-->

<!--begin::Row Recent Visitors & Quotations-->
<div class="row g-5 g-xl-8">
    <!-- Log Kunjungan IP Terkini -->
    <div class="col-xl-6">
        <div class="card card-xl-stretch mb-5 mb-xl-8 shadow-sm">
            <div class="card-header border-0 pt-5">
                <h3 class="card-title align-items-start flex-column">
                    <span class="card-label fw-bold fs-4 mb-1">Pengunjung Harian Terkini (IP Unik)</span>
                    <span class="text-muted mt-1 fw-semibold fs-7">Maksimal 1 kali tercatat per IP per hari</span>
                </h3>
                <div class="card-toolbar">
                    <a href="{{ route('admin.visitors.index') }}" class="btn btn-sm btn-light">Lihat Semua</a>
                </div>
            </div>
            <div class="card-body py-3">
                <div class="table-responsive">
                    <table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-3">
                        <thead>
                            <tr class="fw-bold text-muted">
                                <th>Alamat IP</th>
                                <th>Tanggal Kunjungan</th>
                                <th>Hitungan Hari Ini</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentVisitors as $v)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="symbol symbol-30px me-3">
                                            <span class="symbol-label bg-light-info text-info"><i class="ki-duotone ki-geolocation fs-4"></i></span>
                                        </div>
                                        <span class="fw-bold text-gray-800">{{ $v->ip_address }}</span>
                                    </div>
                                </td>
                                <td><span class="text-muted fw-semibold fs-7">{{ $v->visit_date->format('d M Y') }}</span></td>
                                <td><span class="badge badge-light-success fs-8 fw-bold">{{ $v->visit_count }}x Kunjungan</span></td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3" class="text-center text-muted py-4">Belum ada data kunjungan.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Penawaran Terkini -->
    <div class="col-xl-6">
        <div class="card card-xl-stretch mb-5 mb-xl-8 shadow-sm">
            <div class="card-header border-0 pt-5">
                <h3 class="card-title align-items-start flex-column">
                    <span class="card-label fw-bold fs-4 mb-1">Permintaan Penawaran Terbaru</span>
                    <span class="text-muted mt-1 fw-semibold fs-7">PIC dan Kebutuhan Klien Masuk</span>
                </h3>
                <div class="card-toolbar">
                    <a href="{{ route('admin.penawaran.index') }}" class="btn btn-sm btn-light">Lihat Semua</a>
                </div>
            </div>
            <div class="card-body py-3">
                <div class="table-responsive">
                    <table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-3">
                        <thead>
                            <tr class="fw-bold text-muted">
                                <th>PIC / Perusahaan</th>
                                <th>Kebutuhan</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentQuotations as $q)
                            <tr>
                                <td>
                                    <div class="d-flex flex-column">
                                        <span class="fw-bold text-gray-800">{{ $q->namaPIC }}</span>
                                        <span class="text-muted fs-7">{{ $q->namaPerusahaan }}</span>
                                    </div>
                                </td>
                                <td><span class="badge badge-light-primary fs-8">{{ $q->jenisKebutuhan ?? 'Umum' }}</span></td>
                                <td>
                                    <span class="badge badge-{{ $q->status === 'baru' ? 'danger' : ($q->status === 'diproses' ? 'warning' : 'success') }} fs-8">
                                        {{ ucfirst($q->status) }}
                                    </span>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3" class="text-center text-muted py-4">Belum ada penawaran masuk.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!--end::Row Recent Visitors & Quotations-->
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var element = document.getElementById('kt_charts_visitor');
        if (!element) return;

        var labels = {!! json_encode($last7Days->pluck('label')) !!};
        var values = {!! json_encode($last7Days->pluck('count')) !!};

        var options = {
            series: [{
                name: 'Kunjungan Unik (IP)',
                data: values
            }],
            chart: {
                fontFamily: 'inherit',
                type: 'area',
                height: 300,
                toolbar: { show: false }
            },
            plotOptions: {},
            legend: { show: false },
            dataLabels: { enabled: false },
            fill: {
                type: 'gradient',
                gradient: {
                    shadeIntensity: 1,
                    opacityFrom: 0.4,
                    opacityTo: 0,
                    stops: [0, 90, 100]
                }
            },
            stroke: {
                curve: 'smooth',
                show: true,
                width: 3,
                colors: ['#004225']
            },
            xaxis: {
                categories: labels,
                axisBorder: { show: false },
                axisTicks: { show: false },
                labels: {
                    style: { colors: '#A1A5B7', fontSize: '12px' }
                }
            },
            yaxis: {
                labels: {
                    style: { colors: '#A1A5B7', fontSize: '12px' }
                }
            },
            colors: ['#004225'],
            tooltip: {
                y: {
                    formatter: function (val) {
                        return val + " Pengunjung";
                    }
                }
            }
        };

        var chart = new ApexCharts(element, options);
        chart.render();
    });
</script>
@endpush
