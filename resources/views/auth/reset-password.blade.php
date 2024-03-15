<!DOCTYPE html>
<!--
Author: Ashish Mishra
Product Name: Recon
Purchase:  
Website:  
Contact: info@sypsys.com
Follow: www.twitter.com/agtechtechnologies
Dribbble: www.dribbble.com/agtechtechnologies
Like: www.facebook.com/agtechtechnologies
License: For each use you must have a valid license purchased only from above link in order to legally use the theme for your project.
-->
<html lang="en">
    <!--begin::Head-->
    <head><base href="../../../">
        <title>Recon: Forgot Password</title>
        <meta name="description" content="Recon" />
        <meta name="keywords" content="Recon" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta charset="utf-8" />
        <meta property="og:locale" content="en_US" />
        <meta property="og:type" content="article" />
        <meta property="og:title" content="Recon" />

        <link rel="shortcut icon" href="assets/media/logos/favicon.ico" />
        <!--begin::Fonts-->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
        <!--end::Fonts-->
        <!--begin::Global Stylesheets Bundle(used by all pages)-->
        <link href="assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/style.bundle.css" rel="stylesheet" type="text/css" />
        <!--end::Global Stylesheets Bundle-->
    </head>
    <!--end::Head-->
    <!--begin::Body-->
    <body id="kt_body" class="bg-body">
        <!--begin::Main-->
        <div class="d-flex flex-column flex-root">
            <!--begin::Authentication - Password reset -->
            <div class="d-flex flex-column flex-column-fluid bgi-position-y-bottom position-x-center bgi-no-repeat bgi-size-contain bgi-attachment-fixed" style="background-image: url(assets/media/illustrations/development-hd.png)">
                <!--begin::Content-->
                <div class="d-flex flex-center flex-column flex-column-fluid p-10 pb-lg-20">
                    <!--begin::Logo-->
                    <a href="" class="mb-12">
                        <img alt="Logo" src="assets/media/logos/logo-2-dark.svg" class="h-60px" />
                    </a>
                    <!--end::Logo-->
                    <!--begin::Wrapper-->
                    <div class="w-lg-500px bg-body rounded shadow-sm p-10 p-lg-15 mx-auto">
                        <!--begin::Form-->

 <form method="POST" action="{{ route('password.update') }}" class="form w-100" novalidate="novalidate">
              @csrf
                <!--begin::Heading-->

                 @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                 <div class="text-center mb-10">
                    <!--begin::Title-->
                    <h1 class="text-dark mb-3">Reset Password ?</h1>
                    <!--end::Title-->
                    <!--begin::Link-->
                    <div class="text-gray-400 fw-bold fs-4">Enter your new password.</div>
                    <!--end::Link-->
                </div>

            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <div class="fv-row mb-10">
                <label class="form-label fw-bolder text-gray-900 fs-6" for="email">Email</label>
                <input class="form-control form-control-solid" id="email" type="email" name="email" value="{{old('email')}}" required autofocus  />
            </div>

            <div class="fv-row mb-10">
                <label class="form-label fw-bolder text-gray-900 fs-6" for="password">Password</label>
                <input class="form-control form-control-solid" id="password" type="password" name="password" value="{{old('password')}}" required autocomplete="new-password"  />
            </div>
            <div class="fv-row mb-10">
                <label class="form-label fw-bolder text-gray-900 fs-6" for="password_confirmation">Confirm Password</label>
                <input class="form-control form-control-solid" id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password"  />
            </div>

            <div class="d-flex flex-wrap justify-content-center pb-lg-0">
                <button type="submit"  class="btn btn-lg btn-primary fw-bolder me-4">
                    <span class="indicator-label">Reset Password</span>
                </button>
                <a href="{{url('login')}}" class="btn btn-lg btn-light-primary fw-bolder">Cancel</a>
            </div>
 
        </form>
 
                        <!--end::Form-->
                    </div>
                    <!--end::Wrapper-->
                </div>
                <!--end::Content-->
                <!--begin::Footer-->
               
                <!--end::Footer-->
            </div>
            <!--end::Authentication - Password reset-->
        </div>
        <!--end::Main-->
        <!--begin::Javascript-->
        <!--begin::Global Javascript Bundle(used by all pages)-->
        <script src="assets/plugins/global/plugins.bundle.js"></script>
        <script src="assets/js/scripts.bundle.js"></script>
        <!--end::Global Javascript Bundle-->
        <!--begin::Page Custom Javascript(used by this page)-->
        <script src="assets/js/custom/authentication/password-reset/password-reset.js"></script>
        <!--end::Page Custom Javascript-->
        <!--end::Javascript-->
    </body>
    <!--end::Body-->
</html>