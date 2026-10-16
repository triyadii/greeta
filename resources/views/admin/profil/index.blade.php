@extends('layouts.admin')

@section('title', 'Manajemen Profil Perusahaan')
@section('page_title', 'Profil Perusahaan')
@section('breadcrumb', 'Profil')

@section('content')
<div class="row g-5 g-xl-10">
    <!--begin::Col-->
    <div class="col-xl-4">
        <!--begin::Profile Overview Card-->
        <div class="card card-flush h-xl-100 shadow-sm">
            <div class="card-body text-center pt-9 pb-5">
                <div class="symbol symbol-120px symbol-circle mb-5 border border-primary border-3 p-1 bg-light">
                    <img src="{{ $profile->logo_url }}" alt="Logo {{ $profile->namaPerusahaan ?? 'Perusahaan' }}" class="rounded-circle object-fit-contain w-100 h-100" id="overview_logo_img" />
                </div>
                <h2 class="text-gray-900 fw-bold mb-1">{{ $profile->namaPerusahaan ?? 'PT. Gretta Solutions Network' }}</h2>
                <div class="text-muted fw-semibold mb-6">Solusi Teknologi Informasi &amp; Digital Terpadu</div>

                <div class="d-flex flex-center flex-wrap mb-5 gap-3">
                    <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4">
                        <div class="fs-6 text-gray-800 fw-bold">{{ $profile->websitePerusahaan ?? '-' }}</div>
                        <div class="fw-semibold text-gray-400 fs-7">Website Resmi</div>
                    </div>
                    <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4">
                        <div class="fs-6 text-gray-800 fw-bold">{{ $profile->nomorTeleponPerusahaan ?? '-' }}</div>
                        <div class="fw-semibold text-gray-400 fs-7">Hotline Perusahaan</div>
                    </div>
                </div>

                <button type="button" class="btn btn-primary w-100" onclick="openEditModal()">
                    <i class="ki-duotone ki-pencil fs-2 me-1"><span class="path1"></span><span class="path2"></span></i>
                    Edit Profil &amp; Logo Perusahaan
                </button>
            </div>
        </div>
        <!--end::Profile Overview Card-->
    </div>
    <!--end::Col-->

    <!--begin::Col-->
    <div class="col-xl-8">
        <!--begin::Details Card-->
        <div class="card card-flush h-xl-100 shadow-sm">
            <div class="card-header pt-7">
                <h3 class="card-title align-items-start flex-column">
                    <span class="card-label fw-bold text-gray-900 fs-4">Informasi Lengkap Perusahaan</span>
                    <span class="text-muted mt-1 fw-semibold fs-7">Detail logo, kontak, alamat fisik, dan kanal media sosial</span>
                </h3>
                <div class="card-toolbar">
                    <span class="badge badge-light-primary fw-bold font-monospace">UUID: {{ $profile->uuid ?? 'N/A' }}</span>
                </div>
            </div>

            <div class="card-body pt-5">
                <div class="table-responsive">
                    <table class="table align-middle table-row-bordered fs-6 gy-4">
                        <tbody>
                            <tr>
                                <td class="text-gray-500 fw-bold w-200px">Logo Perusahaan</td>
                                <td class="text-gray-900">
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="border rounded p-1 bg-light d-flex align-items-center justify-content-center" style="width: 55px; height: 55px;">
                                            <img src="{{ $profile->logo_url }}" alt="Logo" class="mw-100 mh-100 object-fit-contain" />
                                        </div>
                                        <div>
                                            <span class="badge {{ $profile->logo ? 'badge-light-success' : 'badge-light-primary' }} fw-bold">
                                                {{ $profile->logo ? 'Logo Kustom Diunggah' : 'Logo Bawaan (Default)' }}
                                            </span>
                                            <div class="text-muted fs-8 mt-1">Muncul di header, footer website publik, dan sidebar admin</div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-gray-500 fw-bold w-200px">Nama Perusahaan</td>
                                <td class="text-gray-900 fw-bolder">{{ $profile->namaPerusahaan ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td class="text-gray-500 fw-bold">Alamat Kantor</td>
                                <td class="text-gray-800">{{ $profile->alamatPerusahan ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td class="text-gray-500 fw-bold">Nomor Telepon</td>
                                <td class="text-gray-800">
                                    <i class="ki-duotone ki-phone fs-4 text-success me-2"><span class="path1"></span><span class="path2"></span></i>
                                    {{ $profile->nomorTeleponPerusahaan ?? '-' }}
                                </td>
                            </tr>
                            <tr>
                                <td class="text-gray-500 fw-bold">Email Perusahaan</td>
                                <td class="text-gray-800">
                                    <i class="ki-duotone ki-sms fs-4 text-primary me-2"><span class="path1"></span><span class="path2"></span></i>
                                    <a href="mailto:{{ $profile->emailPerusahaan }}" class="text-gray-800 text-hover-primary">{{ $profile->emailPerusahaan ?? '-' }}</a>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-gray-500 fw-bold">Website</td>
                                <td class="text-gray-800">
                                    <i class="ki-duotone ki-world fs-4 text-info me-2"><span class="path1"></span><span class="path2"></span></i>
                                    <a href="{{ $profile->websitePerusahaan }}" target="_blank" class="text-primary fw-semibold">{{ $profile->websitePerusahaan ?? '-' }}</a>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-gray-500 fw-bold">Instagram</td>
                                <td class="text-gray-800">
                                    <span class="badge badge-light-danger me-2">Instagram</span>
                                    {{ $profile->instagram ?? '-' }}
                                </td>
                            </tr>
                            <tr>
                                <td class="text-gray-500 fw-bold">TikTok</td>
                                <td class="text-gray-800">
                                    <span class="badge badge-light-dark me-2">TikTok</span>
                                    {{ $profile->tiktok ?? '-' }}
                                </td>
                            </tr>
                            <tr>
                                <td class="text-gray-500 fw-bold">Threads</td>
                                <td class="text-gray-800">
                                    <span class="badge badge-light-dark me-2">Threads</span>
                                    {{ $profile->treads ?? '-' }}
                                </td>
                            </tr>
                            <tr>
                                <td class="text-gray-500 fw-bold">Facebook</td>
                                <td class="text-gray-800">
                                    <span class="badge badge-light-primary me-2">Facebook</span>
                                    {{ $profile->facebook ?? '-' }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!--end::Details Card-->
    </div>
    <!--end::Col-->
</div>
@endsection

@section('modals')
<!--begin::Modal Edit Profil-->
<div class="modal fade" id="modal_profil" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-750px">
        <div class="modal-content">
            <div class="modal-header" id="kt_modal_profil_header">
                <h2 class="fw-bold">Edit Profil &amp; Logo Perusahaan</h2>
                <div class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal">
                    <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                </div>
            </div>

            <form id="form_profil" class="form" enctype="multipart/form-data">
                <div class="modal-body py-10 px-lg-17 scroll-y" style="max-height: 70vh;">
                    
                    <!-- Logo Perusahaan Upload & Preview -->
                    <div class="fv-row mb-8 text-center">
                        <label class="d-block fw-semibold fs-6 mb-3">Logo Perusahaan</label>
                        <div class="d-flex flex-column align-items-center">
                            <div class="position-relative d-inline-block mb-3">
                                <div class="w-130px h-130px rounded-circle border border-2 border-primary p-2 bg-light d-flex align-items-center justify-content-center overflow-hidden shadow-sm">
                                    <img id="logo_preview_img" src="{{ $profile->logo_url }}" alt="Preview Logo" class="w-100 h-100 object-fit-contain" />
                                </div>
                                <label class="btn btn-icon btn-circle btn-active-color-primary w-35px h-35px bg-body shadow position-absolute bottom-0 end-0 translate-middle-y cursor-pointer" data-bs-toggle="tooltip" title="Pilih File Logo Baru">
                                    <i class="ki-duotone ki-pencil fs-4 text-primary"><span class="path1"></span><span class="path2"></span></i>
                                    <input type="file" name="logo" id="logo" class="d-none" accept=".png, .jpg, .jpeg, .webp, .svg" onchange="handleLogoChange(this)" />
                                </label>
                            </div>

                            <input type="hidden" name="remove_logo" id="remove_logo" value="0" />

                            <div class="d-flex gap-2">
                                <label for="logo" class="btn btn-sm btn-light-primary">
                                    <i class="ki-duotone ki-file-up fs-5 me-1"><span class="path1"></span><span class="path2"></span></i>
                                    Unggah Logo Baru
                                </label>
                                <button type="button" class="btn btn-sm btn-light-danger" id="btn_remove_logo" onclick="handleRemoveLogo()">
                                    <i class="ki-duotone ki-trash fs-5 me-1"><span class="path1"></span><span class="path2"></span></i>
                                    Reset ke Default
                                </button>
                            </div>
                            <div class="form-text fs-7 mt-2 text-muted">
                                Format: PNG, JPG, JPEG, WEBP, atau SVG. Ukuran maks 2MB. Disarankan berlatar transparan.
                            </div>
                        </div>
                    </div>

                    <div class="separator separator-dashed my-6"></div>

                    <!-- Nama Perusahaan -->
                    <div class="fv-row mb-7">
                        <label class="required fs-6 fw-semibold mb-2">Nama Perusahaan</label>
                        <input type="text" class="form-control form-control-solid" name="namaPerusahaan" id="namaPerusahaan" value="{{ $profile->namaPerusahaan ?? '' }}" required />
                    </div>

                    <!-- Alamat Perusahaan -->
                    <div class="fv-row mb-7">
                        <label class="fs-6 fw-semibold mb-2">Alamat Perusahaan</label>
                        <textarea class="form-control form-control-solid" rows="3" name="alamatPerusahan" id="alamatPerusahan">{{ $profile->alamatPerusahan ?? '' }}</textarea>
                    </div>

                    <div class="row g-5 mb-7">
                        <div class="col-md-6">
                            <label class="fs-6 fw-semibold mb-2">Nomor Telepon</label>
                            <input type="text" class="form-control form-control-solid" name="nomorTeleponPerusahaan" id="nomorTeleponPerusahaan" value="{{ $profile->nomorTeleponPerusahaan ?? '' }}" placeholder="021-xxxxxxxx" />
                        </div>
                        <div class="col-md-6">
                            <label class="fs-6 fw-semibold mb-2">Email Perusahaan</label>
                            <input type="email" class="form-control form-control-solid" name="emailPerusahaan" id="emailPerusahaan" value="{{ $profile->emailPerusahaan ?? '' }}" placeholder="info@greeta.id" />
                        </div>
                    </div>

                    <!-- Website -->
                    <div class="fv-row mb-7">
                        <label class="fs-6 fw-semibold mb-2">Website Resmi</label>
                        <input type="text" class="form-control form-control-solid" name="websitePerusahaan" id="websitePerusahaan" value="{{ $profile->websitePerusahaan ?? '' }}" placeholder="https://greeta.id" />
                    </div>

                    <div class="separator separator-dashed my-8"></div>
                    <h5 class="fw-bold mb-4 text-gray-800">Media Sosial Perusahaan</h5>

                    <div class="row g-5 mb-7">
                        <div class="col-md-6">
                            <label class="fs-6 fw-semibold mb-2">Instagram</label>
                            <input type="text" class="form-control form-control-solid" name="instagram" id="instagram" value="{{ $profile->instagram ?? '' }}" placeholder="@greeta.id" />
                        </div>
                        <div class="col-md-6">
                            <label class="fs-6 fw-semibold mb-2">TikTok</label>
                            <input type="text" class="form-control form-control-solid" name="tiktok" id="tiktok" value="{{ $profile->tiktok ?? '' }}" placeholder="@greeta.id" />
                        </div>
                    </div>

                    <div class="row g-5 mb-7">
                        <div class="col-md-6">
                            <label class="fs-6 fw-semibold mb-2">Threads</label>
                            <input type="text" class="form-control form-control-solid" name="treads" id="treads" value="{{ $profile->treads ?? '' }}" placeholder="@greeta.id" />
                        </div>
                        <div class="col-md-6">
                            <label class="fs-6 fw-semibold mb-2">Facebook</label>
                            <input type="text" class="form-control form-control-solid" name="facebook" id="facebook" value="{{ $profile->facebook ?? '' }}" placeholder="PT Gretta Solutions Network" />
                        </div>
                    </div>
                </div>

                <div class="modal-footer flex-center">
                    <button type="button" class="btn btn-light me-3" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary" id="btn_submit_profil">
                        <span class="indicator-label">Simpan Perubahan</span>
                        <span class="indicator-progress">Menyimpan... <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<!--end::Modal Edit Profil-->
@endsection

@push('scripts')
<script>
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    const profilModalEl = document.getElementById('modal_profil');
    const profilModal = new bootstrap.Modal(profilModalEl);
    const formProfil = document.getElementById('form_profil');
    const btnSubmitProfil = document.getElementById('btn_submit_profil');
    
    const defaultLogoUrl = '{{ \App\Models\CompanyProfile::DEFAULT_LOGO }}';
    const initialLogoUrl = '{{ $profile->logo_url }}';
    const logoPreviewImg = document.getElementById('logo_preview_img');
    const removeLogoInput = document.getElementById('remove_logo');
    const logoInput = document.getElementById('logo');

    function openEditModal() {
        profilModal.show();
    }

    function handleLogoChange(input) {
        if (input.files && input.files[0]) {
            const file = input.files[0];
            if (file.size > 2 * 1024 * 1024) {
                Swal.fire('File Terlalu Besar', 'Ukuran logo maksimal adalah 2MB.', 'warning');
                input.value = '';
                return;
            }
            const reader = new FileReader();
            reader.onload = function(e) {
                logoPreviewImg.src = e.target.result;
                removeLogoInput.value = '0';
            };
            reader.readAsDataURL(file);
        }
    }

    function handleRemoveLogo() {
        logoInput.value = '';
        removeLogoInput.value = '1';
        logoPreviewImg.src = defaultLogoUrl;
        Swal.fire({
            icon: 'info',
            title: 'Logo Direset',
            text: 'Logo akan dikembalikan ke logo bawaan setelah Anda mengklik Simpan Perubahan.',
            timer: 2000,
            showConfirmButton: false
        });
    }

    formProfil.addEventListener('submit', async function(e) {
        e.preventDefault();
        btnSubmitProfil.setAttribute('data-kt-indicator', 'on');
        btnSubmitProfil.disabled = true;

        const formData = new FormData(formProfil);

        try {
            const response = await fetch(`{{ route('admin.profil.store') }}`, {
                method: 'POST',
                headers: {
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                },
                body: formData
            });

            const result = await response.json();
            if (response.ok && result.success) {
                profilModal.hide();
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: result.message,
                    timer: 1500,
                    showConfirmButton: false
                }).then(() => location.reload());
            } else {
                const errors = result.errors ? Object.values(result.errors).flat().join('<br>') : (result.message || 'Gagal menyimpan profil');
                Swal.fire('Validasi Gagal', errors, 'warning');
            }
        } catch (err) {
            Swal.fire('Error', 'Terjadi kesalahan sistem saat menyimpan data', 'error');
        } finally {
            btnSubmitProfil.removeAttribute('data-kt-indicator');
            btnSubmitProfil.disabled = false;
        }
    });
</script>
@endpush
