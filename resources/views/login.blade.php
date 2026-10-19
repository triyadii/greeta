<!DOCTYPE html>
<html lang="id">
	<!--begin::Head-->
	<head>
		<title>Login Administrator - PT. Gretta Solutions Network</title>
		<meta charset="utf-8" />
		<meta name="csrf-token" content="{{ csrf_token() }}">
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="shortcut icon" href="{{ asset('assets/media/logos/favicon.ico') }}" />
		<!--begin::Fonts-->
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
		<!--end::Fonts-->
		<!--begin::Global Stylesheets Bundle-->
		<link href="{{ asset('assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
		<link href="{{ asset('assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
		<!--end::Global Stylesheets Bundle-->
	</head>
	<!--end::Head-->
	<!--begin::Body-->
	<body id="kt_body" class="app-blank">
		<!--begin::Theme mode setup on page load-->
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
		<!--end::Theme mode setup on page load-->
		<!--begin::Root-->
		<div class="d-flex flex-column flex-root" id="kt_app_root">
			<!--begin::Authentication - Sign-in -->
			<div class="d-flex flex-column flex-lg-row flex-column-fluid">
				<!--begin::Body-->
				<div class="d-flex flex-column flex-lg-row-fluid w-lg-50 p-10 order-2 order-lg-1">
					<!--begin::Form-->
					<div class="d-flex flex-center flex-column flex-lg-row-fluid">
						<!--begin::Wrapper-->
						<div class="w-lg-500px p-10">
							<!--begin::Form-->
							<form class="form w-100" id="login-form">
								@csrf
								<!--begin::Heading-->
								<div class="text-center mb-11">
									<a href="{{ url('/') }}" class="mb-6 d-inline-block">
										<img alt="Logo {{ $companyProfile?->namaPerusahaan ?? 'Gretta Solutions' }}" src="{{ $companyProfile?->logo_url ?? \App\Models\CompanyProfile::DEFAULT_LOGO }}" class="h-45px object-fit-contain" />
									</a>
									<h1 class="text-gray-900 fw-bolder mb-2">Login Portal Admin</h1>
									<div class="text-gray-500 fw-semibold fs-6">Sistem Manajemen &amp; Konten Terpadu</div>
								</div>
								<!--end::Heading-->

								<!--begin::Input group-->
								<div class="fv-row mb-8">
									<label class="form-label fs-6 fw-bolder text-dark">Email Administrator</label>
									<input type="email" placeholder="Masukkan email administrator" name="email" value="{{ old('email') }}" autocomplete="username" class="form-control form-control-lg bg-transparent" required />
								</div>
								<!--end::Input group-->

								<!--begin::Input group-->
								<div class="fv-row mb-6">
									<label class="form-label fs-6 fw-bolder text-dark">Kata Sandi (Password)</label>
									<input type="password" placeholder="Masukkan kata sandi" name="password" autocomplete="current-password" class="form-control form-control-lg bg-transparent" required />
								</div>
								<!--end::Input group-->

								<!--begin::Wrapper-->
								<div class="d-flex flex-stack flex-wrap gap-3 fs-base fw-semibold mb-8">
									<label class="form-check form-check-custom form-check-solid">
										<input class="form-check-input" type="checkbox" name="remember" value="1" checked />
										<span class="form-check-label text-gray-600">Ingat Sesi Saya</span>
									</label>
									<a href="{{ url('/') }}" class="link-primary fs-7">Kembali ke Beranda</a>
								</div>
								<!--end::Wrapper-->

								<!--begin::Submit button-->
								<div class="d-grid mb-10">
									<button type="submit" id="btn-submit-login" class="btn btn-primary">
										<span class="indicator-label">Masuk ke Dashboard</span>
										<span class="indicator-progress">Memverifikasi kredensial... 
										<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
									</button>
								</div>
								<!--end::Submit button-->
							</form>
							<!--end::Form-->
						</div>
						<!--end::Wrapper-->
					</div>
					<!--end::Form-->
				</div>
				<!--end::Body-->
				<!--begin::Aside-->
				<div class="d-flex flex-lg-row-fluid w-lg-50 bgi-size-cover bgi-position-center order-1 order-lg-2" style="background-image: url({{ asset('assets/media/misc/auth-bg.png') }})">
					<div class="d-flex flex-column flex-center py-7 py-lg-15 px-5 px-md-15 w-100">
						<a href="{{ url('/') }}" class="mb-0 mb-lg-12">
							<div class="w-70px h-70px rounded-3 bg-white d-flex align-items-center justify-content-center shadow-lg mb-4 mx-auto">
								<i class="ki-duotone ki-shield-tick fs-3x text-primary">
									<span class="path1"></span>
									<span class="path2"></span>
								</i>
							</div>
						</a>
						<h2 class="d-none d-lg-block text-white fs-2qx fw-bolder text-center mb-4">PT. Gretta Solutions Network</h2>
						<div class="d-none d-lg-block text-white fs-base text-center max-w-400px opacity-75">
							Sistem Administrasi Terpusat: Pengelolaan Menu Akses, Role, Profil Perusahaan, Wilayah Operasional, Portofolio, dan Monitoring Pengunjung Harian.
						</div>
					</div>
				</div>
				<!--end::Aside-->
			</div>
			<!--end::Authentication - Sign-in-->
		</div>
		<!--end::Root-->

		<!--begin::Javascript-->
		<script src="{{ asset('assets/plugins/global/plugins.bundle.js') }}"></script>
		<script src="{{ asset('assets/js/scripts.bundle.js') }}"></script>

		<script>
			document.getElementById('login-form').addEventListener('submit', function(e) {
				e.preventDefault();
				const form = this;
				const btn = document.getElementById('btn-submit-login');
				btn.setAttribute('data-kt-indicator', 'on');
				btn.disabled = true;

				const formData = new FormData(form);

				fetch("{{ route('login.post') }}", {
					method: 'POST',
					headers: {
						'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
						'Accept': 'application/json'
					},
					body: formData
				})
				.then(async response => {
					const data = await response.json();
					if (response.ok && data.success) {
						// Store Sanctum token in localStorage
						if (data.token) {
							localStorage.setItem('sanctum_token', data.token);
						}
						Swal.fire({
							text: data.message || "Login berhasil!",
							icon: "success",
							buttonsStyling: false,
							confirmButtonText: "Buka Dashboard",
							customClass: {
								confirmButton: "btn btn-primary"
							}
						}).then(function() {
							window.location.href = data.redirect || "{{ route('admin.dashboard') }}";
						});
					} else {
						btn.removeAttribute('data-kt-indicator');
						btn.disabled = false;
						Swal.fire({
							text: data.message || "Email atau kata sandi tidak cocok.",
							icon: "error",
							buttonsStyling: false,
							confirmButtonText: "Coba Lagi",
							customClass: {
								confirmButton: "btn btn-danger"
							}
						});
					}
				})
				.catch(err => {
					btn.removeAttribute('data-kt-indicator');
					btn.disabled = false;
					Swal.fire({
						text: "Terjadi kesalahan jaringan atau server. Silakan coba lagi.",
						icon: "error",
						buttonsStyling: false,
						confirmButtonText: "OK",
						customClass: {
							confirmButton: "btn btn-danger"
						}
					});
				});
			});
		</script>
		<!--end::Javascript-->
	</body>
	<!--end::Body-->
</html>