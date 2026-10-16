<!DOCTYPE html>
<html lang="id">
<head>
    <title>@yield('title', 'Dashboard') - PT. Gretta Solutions Network</title>
    <meta charset="utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="shortcut icon" href="{{ asset('assets/media/logos/favicon.ico') }}" />
    <!--begin::Fonts-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
    <!--end::Fonts-->
    <!--begin::Vendor Stylesheets-->
    <link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
    <!--end::Vendor Stylesheets-->
    <!--begin::Global Stylesheets Bundle-->
    <link href="{{ asset('assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
    <!--end::Global Stylesheets Bundle-->
    @stack('styles')
</head>
<body id="kt_app_body" data-kt-app-layout="dark-sidebar" data-kt-app-header-fixed="true" data-kt-app-sidebar-enabled="true" data-kt-app-sidebar-fixed="true" data-kt-app-sidebar-hoverable="true" data-kt-app-sidebar-push-header="true" data-kt-app-sidebar-push-toolbar="true" data-kt-app-sidebar-push-footer="true" data-kt-app-toolbar-enabled="true" class="app-default">
    <script>
        var defaultThemeMode = "light"; 
        var themeMode; 
        if ( document.documentElement ) { 
            if ( document.documentElement.hasAttribute("data-bs-theme-mode")) { 
                themeMode = document.documentElement.getAttribute("data-bs-theme-mode"); 
            } else { 
                if ( localStorage.getItem("data-bs-theme") !== null ) { 
                    themeMode = localStorage.getItem("data-bs-theme"); 
                } else { 
                    themeMode = defaultThemeMode; 
                } 
            } 
            if (themeMode === "system") { 
                themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light"; 
            } 
            document.documentElement.setAttribute("data-bs-theme", themeMode); 
        }
    </script>

    <!--begin::App-->
    <div class="d-flex flex-column flex-root app-root" id="kt_app_root">
        <!--begin::Page-->
        <div class="app-page flex-column flex-column-fluid" id="kt_app_page">
            <!--begin::Header-->
            <div id="kt_app_header" class="app-header" data-kt-sticky="true" data-kt-sticky-activate="{default: true, lg: true}" data-kt-sticky-name="app-header-minimize" data-kt-sticky-offset="{default: '200px', lg: '0'}" data-kt-sticky-animation="false">
                <div class="app-container container-fluid d-flex align-items-stretch justify-content-between" id="kt_app_header_container">
                    <!--begin::Sidebar mobile toggle-->
                    <div class="d-flex align-items-center d-lg-none ms-n3 me-1 me-md-2" title="Show sidebar menu">
                        <div class="btn btn-icon btn-active-color-primary w-35px h-35px" id="kt_app_sidebar_mobile_toggle">
                            <i class="ki-duotone ki-abstract-14 fs-2 fs-md-1">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                        </div>
                    </div>
                    <!--end::Sidebar mobile toggle-->
                    <!--begin::Mobile logo-->
                    <div class="d-flex align-items-center flex-grow-1 flex-lg-grow-0">
                        <a href="{{ route('admin.dashboard') }}" class="d-lg-none">
                            <img alt="Logo" src="https://lh3.googleusercontent.com/aida/AEtjO1X9E2w3eu5Tp-5nDqWqkfn3Pb3EncTNdUDnPDluLQb7x9o1MEA53AqEBwOwY0ein5ym31YytcUF50c6cIoKcxlYWh0KeZFnS5XBr793pphLUpYCiBWL8hssy0EyIxiiOxgLBmt7BSp5bBcFhvpq3XtPk8Sdm9FYPvfQeuTPCzB80PKGjUoU7X9x3UXcC4Oj813d1vfaHAQufwCfPIkm_BczratuU56bUo_p4tLKo_8a1i-kKGDks6bJSmxF" class="h-30px" />
                        </a>
                    </div>
                    <!--end::Mobile logo-->
                    <!--begin::Header wrapper-->
                    <div class="d-flex align-items-stretch justify-content-between flex-lg-grow-1" id="kt_app_header_wrapper">
                        <!--begin::Page title-->
                        <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3 mb-5 mb-lg-0">
                            <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">
                                @yield('page_title', 'Dashboard')
                            </h1>
                            <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                                <li class="breadcrumb-item text-muted">
                                    <a href="{{ route('admin.dashboard') }}" class="text-muted text-hover-primary">Admin</a>
                                </li>
                                <li class="breadcrumb-item">
                                    <span class="bullet bg-gray-400 w-5px h-2px"></span>
                                </li>
                                <li class="breadcrumb-item text-muted">@yield('breadcrumb', 'Overview')</li>
                            </ul>
                        </div>
                        <!--end::Page title-->
                        <!--begin::Navbar-->
                        <div class="app-navbar flex-shrink-0">
                            <div class="app-navbar-item ms-1 ms-md-3">
                                <a href="{{ url('/') }}" target="_blank" class="btn btn-sm btn-light-primary fw-bold me-2">
                                    <i class="ki-duotone ki-exit-right-corner fs-4 me-1"><span class="path1"></span><span class="path2"></span></i>
                                    Lihat Website
                                </a>
                            </div>

                            <!--begin::Theme mode switcher-->
                            <div class="app-navbar-item ms-1 ms-md-3">
                                <a href="#" class="btn btn-icon btn-custom btn-icon-muted btn-active-light btn-active-color-primary w-35px h-35px" data-kt-menu-trigger="{default:'click', lg: 'hover'}" data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end" title="Ganti Mode Tema">
                                    <i class="ki-duotone ki-night-day theme-light-show fs-2"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span><span class="path6"></span><span class="path7"></span><span class="path8"></span><span class="path9"></span><span class="path10"></span></i>
                                    <i class="ki-duotone ki-moon theme-dark-show fs-2"><span class="path1"></span><span class="path2"></span></i>
                                </a>
                                <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-title-gray-700 menu-icon-gray-500 menu-active-bg menu-state-color fw-semibold py-4 fs-base w-150px" data-kt-menu="true">
                                    <div class="menu-item px-3 my-0">
                                        <a href="javascript:void(0)" onclick="setAppTheme('light')" class="menu-link px-3 py-2" id="theme-btn-light">
                                            <span class="menu-icon">
                                                <i class="ki-duotone ki-night-day fs-2"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span><span class="path6"></span><span class="path7"></span><span class="path8"></span><span class="path9"></span><span class="path10"></span></i>
                                            </span>
                                            <span class="menu-title">Mode Terang</span>
                                        </a>
                                    </div>
                                    <div class="menu-item px-3 my-0">
                                        <a href="javascript:void(0)" onclick="setAppTheme('dark')" class="menu-link px-3 py-2" id="theme-btn-dark">
                                            <span class="menu-icon">
                                                <i class="ki-duotone ki-moon fs-2"><span class="path1"></span><span class="path2"></span></i>
                                            </span>
                                            <span class="menu-title">Mode Gelap</span>
                                        </a>
                                    </div>
                                    <div class="menu-item px-3 my-0">
                                        <a href="javascript:void(0)" onclick="setAppTheme('system')" class="menu-link px-3 py-2" id="theme-btn-system">
                                            <span class="menu-icon">
                                                <i class="ki-duotone ki-screen fs-2"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span></i>
                                            </span>
                                            <span class="menu-title">Ikuti Sistem</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <!--end::Theme mode switcher-->

                            <!--begin::User menu-->
                            <div class="app-navbar-item ms-1 ms-md-3" id="kt_header_user_menu_toggle">
                                <div class="cursor-pointer symbol symbol-35px" data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end">
                                    <div class="symbol-label fs-3 bg-light-primary text-primary fw-bolder">
                                        {{ substr(Auth::user()->name ?? 'A', 0, 1) }}
                                    </div>
                                </div>
                                <!--begin::User account menu-->
                                <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-color fw-semibold py-4 fs-6 w-275px" data-kt-menu="true">
                                    <div class="menu-item px-3">
                                        <div class="menu-content d-flex align-items-center px-3">
                                            <div class="symbol symbol-50px me-5">
                                                <div class="symbol-label fs-2 bg-light-primary text-primary fw-bolder">
                                                    {{ substr(Auth::user()->name ?? 'A', 0, 1) }}
                                                </div>
                                            </div>
                                            <div class="d-flex flex-column">
                                                <div class="fw-bold d-flex align-items-center fs-5">{{ Auth::user()->name ?? 'Administrator' }}
                                                    <span class="badge badge-light-success fw-bold fs-8 px-2 py-1 ms-2">
                                                        {{ Auth::user()->role?->namaRole ?? 'Staff' }}
                                                    </span>
                                                </div>
                                                <span class="fw-semibold text-muted text-hover-primary fs-7">{{ Auth::user()->email ?? 'admin@greeta.id' }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="separator my-2"></div>
                                    <div class="menu-item px-5">
                                        <a href="javascript:void(0)" onclick="handleLogout()" class="menu-link px-5 text-danger">
                                            <i class="ki-duotone ki-entrance-left fs-4 text-danger me-2"><span class="path1"></span><span class="path2"></span></i>
                                            Keluar (Sign Out)
                                        </a>
                                    </div>
                                </div>
                                <!--end::User account menu-->
                            </div>
                            <!--end::User menu-->
                        </div>
                        <!--end::Navbar-->
                    </div>
                    <!--end::Header wrapper-->
                </div>
            </div>
            <!--end::Header-->

            <!--begin::Wrapper-->
            <div class="app-wrapper flex-column flex-row-fluid" id="kt_app_wrapper">
                <!--begin::Sidebar-->
                <div id="kt_app_sidebar" class="app-sidebar flex-column" data-kt-drawer="true" data-kt-drawer-name="app-sidebar" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="225px" data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_app_sidebar_mobile_toggle">
                    <!--begin::Logo-->
                    <div class="app-sidebar-logo px-6" id="kt_app_sidebar_logo">
                        <a href="{{ route('admin.dashboard') }}" class="d-flex align-items-center">
                            <img alt="Logo" src="https://lh3.googleusercontent.com/aida/AEtjO1X9E2w3eu5Tp-5nDqWqkfn3Pb3EncTNdUDnPDluLQb7x9o1MEA53AqEBwOwY0ein5ym31YytcUF50c6cIoKcxlYWh0KeZFnS5XBr793pphLUpYCiBWL8hssy0EyIxiiOxgLBmt7BSp5bBcFhvpq3XtPk8Sdm9FYPvfQeuTPCzB80PKGjUoU7X9x3UXcC4Oj813d1vfaHAQufwCfPIkm_BczratuU56bUo_p4tLKo_8a1i-kKGDks6bJSmxF" class="h-35px app-sidebar-logo-default" />
                        </a>
                        <div id="kt_app_sidebar_toggle" class="app-sidebar-toggle btn btn-icon btn-shadow btn-sm btn-color-muted btn-active-color-primary h-30px w-30px position-absolute top-50 start-100 translate-middle rotate" data-kt-toggle="true" data-kt-toggle-state="active" data-kt-toggle-target="body" data-kt-toggle-name="app-sidebar-minimize">
                            <i class="ki-duotone ki-black-left-line fs-3 rotate-180">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                        </div>
                    </div>
                    <!--end::Logo-->

                    <!--begin::sidebar menu-->
                    <div class="app-sidebar-menu overflow-hidden flex-column-fluid">
                        <div id="kt_app_sidebar_menu_wrapper" class="app-sidebar-wrapper">
                            <div id="kt_app_sidebar_menu_scroll" class="scroll-y my-5 mx-3" data-kt-scroll="true" data-kt-scroll-activate="true" data-kt-scroll-height="auto" data-kt-scroll-dependencies="#kt_app_sidebar_logo, #kt_app_sidebar_footer" data-kt-scroll-wrappers="#kt_app_sidebar_menu" data-kt-scroll-offset="5px" data-kt-scroll-save-state="true">
                                <div class="menu menu-column menu-rounded menu-sub-indented fw-semibold fs-6" id="#kt_app_sidebar_menu" data-kt-menu="true" data-kt-menu-expand="false">
                                    
                                    <!-- Dashboard -->
                                    <div class="menu-item">
                                        <a class="menu-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                                            <span class="menu-icon">
                                                <i class="ki-duotone ki-element-11 fs-2"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span></i>
                                            </span>
                                            <span class="menu-title">Dashboard</span>
                                        </a>
                                    </div>

                                    <div class="menu-item pt-5">
                                        <div class="menu-content"><span class="menu-heading fw-bold text-uppercase fs-7">Sistem &amp; Hak Akses</span></div>
                                    </div>

                                    <!-- 1. Menu & Akses -->
                                    <div class="menu-item">
                                        <a class="menu-link {{ request()->routeIs('admin.menus.*') ? 'active' : '' }}" href="{{ route('admin.menus.index') }}">
                                            <span class="menu-icon">
                                                <i class="ki-duotone ki-abstract-26 fs-2"><span class="path1"></span><span class="path2"></span></i>
                                            </span>
                                            <span class="menu-title">Manajemen Menu &amp; Akses</span>
                                        </a>
                                    </div>

                                    <!-- 2. Role Akses -->
                                    <div class="menu-item">
                                        <a class="menu-link {{ request()->routeIs('admin.roles.*') ? 'active' : '' }}" href="{{ route('admin.roles.index') }}">
                                            <span class="menu-icon">
                                                <i class="ki-duotone ki-shield-tick fs-2"><span class="path1"></span><span class="path2"></span></i>
                                            </span>
                                            <span class="menu-title">Manajemen Role Akses</span>
                                        </a>
                                    </div>

                                    <div class="menu-item pt-5">
                                        <div class="menu-content"><span class="menu-heading fw-bold text-uppercase fs-7">Profil &amp; Informasi</span></div>
                                    </div>

                                    <!-- 3. Profil Perusahaan -->
                                    <div class="menu-item">
                                        <a class="menu-link {{ request()->routeIs('admin.profil.*') ? 'active' : '' }}" href="{{ route('admin.profil.index') }}">
                                            <span class="menu-icon">
                                                <i class="ki-duotone ki-shop fs-2"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span></i>
                                            </span>
                                            <span class="menu-title">Manajemen Profil</span>
                                        </a>
                                    </div>

                                    <!-- 4. Visi Misi -->
                                    <div class="menu-item">
                                        <a class="menu-link {{ request()->routeIs('admin.visi-misi.*') ? 'active' : '' }}" href="{{ route('admin.visi-misi.index') }}">
                                            <span class="menu-icon">
                                                <i class="ki-duotone ki-compass fs-2"><span class="path1"></span><span class="path2"></span></i>
                                            </span>
                                            <span class="menu-title">Manajemen Visi Misi</span>
                                        </a>
                                    </div>

                                    <!-- 5. Penawaran -->
                                    <div class="menu-item">
                                        <a class="menu-link {{ request()->routeIs('admin.penawaran.*') ? 'active' : '' }}" href="{{ route('admin.penawaran.index') }}">
                                            <span class="menu-icon">
                                                <i class="ki-duotone ki-message-text-2 fs-2"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i>
                                            </span>
                                            <span class="menu-title">Manajemen Penawaran</span>
                                        </a>
                                    </div>

                                    <!-- 6. Wilayah Operasional -->
                                    <div class="menu-item">
                                        <a class="menu-link {{ request()->routeIs('admin.wilayah.*') ? 'active' : '' }}" href="{{ route('admin.wilayah.index') }}">
                                            <span class="menu-icon">
                                                <i class="ki-duotone ki-map fs-2"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i>
                                            </span>
                                            <span class="menu-title">Wilayah Operasional</span>
                                        </a>
                                    </div>

                                    <div class="menu-item pt-5">
                                        <div class="menu-content"><span class="menu-heading fw-bold text-uppercase fs-7">Layanan &amp; Konten</span></div>
                                    </div>

                                    <!-- 7. Portofolio -->
                                    <div class="menu-item">
                                        <a class="menu-link {{ request()->routeIs('admin.portofolio.*') ? 'active' : '' }}" href="{{ route('admin.portofolio.index') }}">
                                            <span class="menu-icon">
                                                <i class="ki-duotone ki-briefcase fs-2"><span class="path1"></span><span class="path2"></span></i>
                                            </span>
                                            <span class="menu-title">Manajemen Portofolio</span>
                                        </a>
                                    </div>

                                    <!-- 8. Pilar -->
                                    <div class="menu-item">
                                        <a class="menu-link {{ request()->routeIs('admin.pilar.*') ? 'active' : '' }}" href="{{ route('admin.pilar.index') }}">
                                            <span class="menu-icon">
                                                <i class="ki-duotone ki-category fs-2"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span></i>
                                            </span>
                                            <span class="menu-title">Manajemen Pilar</span>
                                        </a>
                                    </div>

                                    <!-- 9. Berita -->
                                    <div class="menu-item">
                                        <a class="menu-link {{ request()->routeIs('admin.berita.*') ? 'active' : '' }}" href="{{ route('admin.berita.index') }}">
                                            <span class="menu-icon">
                                                <i class="ki-duotone ki-document fs-2"><span class="path1"></span><span class="path2"></span></i>
                                            </span>
                                            <span class="menu-title">Manajemen Berita</span>
                                        </a>
                                    </div>

                                    <!-- 10. Visitor -->
                                    <div class="menu-item">
                                        <a class="menu-link {{ request()->routeIs('admin.visitors.*') ? 'active' : '' }}" href="{{ route('admin.visitors.index') }}">
                                            <span class="menu-icon">
                                                <i class="ki-duotone ki-people fs-2"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span></i>
                                            </span>
                                            <span class="menu-title">Manajemen Visitor (IP)</span>
                                        </a>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end::sidebar menu-->
                </div>
                <!--end::Sidebar-->

                <!--begin::Main-->
                <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
                    <div class="d-flex flex-column flex-column-fluid">
                        <div id="kt_app_content" class="app-content flex-column-fluid py-3 py-lg-6">
                            <div id="kt_app_content_container" class="app-container container-fluid">
                                @yield('content')
                            </div>
                        </div>
                    </div>
                    <!--begin::Footer-->
                    <div id="kt_app_footer" class="app-footer">
                        <div class="app-container container-fluid d-flex flex-column flex-md-row flex-center flex-md-stack py-3">
                            <div class="text-gray-900 order-2 order-md-1">
                                <span class="text-muted fw-semibold me-1">&copy; {{ date('Y') }}</span>
                                <a href="{{ url('/') }}" target="_blank" class="text-gray-800 text-hover-primary">PT. Gretta Solutions Network</a>
                            </div>
                            <ul class="menu menu-gray-600 menu-hover-primary fw-semibold order-1">
                                <li class="menu-item"><span class="menu-link px-2 text-muted">Portal Admin V1.0</span></li>
                            </ul>
                        </div>
                    </div>
                    <!--end::Footer-->
                </div>
                <!--end::Main-->
            </div>
            <!--end::Wrapper-->
        </div>
        <!--end::Page-->
    </div>
    <!--end::App-->

    <!--begin::Modals placeholder-->
    @yield('modals')
    <!--end::Modals placeholder-->

    <!--begin::Global Javascript Bundle-->
    <script src="{{ asset('assets/plugins/global/plugins.bundle.js') }}"></script>
    <script src="{{ asset('assets/js/scripts.bundle.js') }}"></script>
    <script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
    <!--end::Global Javascript Bundle-->

    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
        @csrf
    </form>

    <script>
        function setAppTheme(mode) {
            let targetTheme = mode;
            if (mode === "system") {
                targetTheme = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light";
            }
            document.documentElement.setAttribute("data-bs-theme", targetTheme);
            localStorage.setItem("data-bs-theme", mode);
            updateThemeActiveState(mode);
        }

        function updateThemeActiveState(mode) {
            const currentMode = mode || localStorage.getItem("data-bs-theme") || "light";
            ['light', 'dark', 'system'].forEach(m => {
                const el = document.getElementById(`theme-btn-${m}`);
                if (el) {
                    if (m === currentMode) {
                        el.classList.add('active');
                    } else {
                        el.classList.remove('active');
                    }
                }
            });
        }

        document.addEventListener('DOMContentLoaded', function() {
            updateThemeActiveState();
        });

        function handleLogout() {
            Swal.fire({
                title: "Konfirmasi Logout",
                text: "Apakah Anda yakin ingin keluar dari sesi administrator?",
                icon: "warning",
                showCancelButton: true,
                buttonsStyling: false,
                confirmButtonText: "Ya, Keluar",
                cancelButtonText: "Batal",
                customClass: {
                    confirmButton: "btn btn-danger",
                    cancelButton: "btn btn-secondary"
                }
            }).then(function(result) {
                if (result.isConfirmed) {
                    localStorage.removeItem('sanctum_token');
                    document.getElementById('logout-form').submit();
                }
            });
        }
    </script>

    @stack('scripts')
</body>
</html>
