<?php
if(isset(\Auth::user()->id)){
header('Location:dashboard');
}
?>
<!DOCTYPE html>
<!--
Author: Ashish Mishra
Product Name: Recon
Purchase:  
Website:  
Contact: info@agtechtechnologies.com
Follow: www.twitter.com/agtechtechnologies
Dribbble: www.dribbble.com/agtechtechnologies
Like: www.facebook.com/agtechtechnologies
License: For each use you must have a valid license purchased only from above link in order to legally use the theme for your project.
-->
<html lang="en">
    <!--begin::Head-->
    <head><base href="../../../">
        <title>Recon: Admin Login</title>
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
            <!--begin::Authentication - Sign-in -->
            <div class="d-flex flex-column flex-column-fluid bgi-position-y-bottom position-x-center bgi-no-repeat bgi-size-contain bgi-attachment-fixed" style="background-image: url(assets/media/illustrations/development-hd.png)">
                <!--begin::Content-->
                <div class="d-flex flex-center flex-column flex-column-fluid p-10 pb-lg-20">
                    <!--begin::Logo-->
                    <a href="" class="mb-12">
                        <img alt="Logo" src="assets/media/logos/logo-2-dark.svg" class="h-45px"  style="height: 60px!important;" />
                    </a>
                    <!--end::Logo-->
                    <!--begin::Wrapper-->
                    <div class="w-lg-500px bg-body rounded shadow-sm p-10 p-lg-15 mx-auto">
                        <!--begin::Form-->

                        <form class="form w-100"  method="POST"  novalidate="novalidate" id="kt_sign_in_form"  action="{{ route('login') }}">
                            @csrf
                            <!--begin::Heading-->
                            <div class="text-center mb-10">
                                <!--begin::Title-->
                                <h1 class="text-dark mb-3">Sign In to Recon</h1>
                                <!--end::Title-->
                                <!--begin::Link-->
                                
                                <!--end::Link-->
                            </div>
                            @if (session('status'))
                            <div class="mb-4 font-medium text-sm text-green-600" style="color:red">
                            {{ session('status') }}
                            </div>
                            @endif

 @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


                            <!--begin::Heading-->
                            <!--begin::Input group-->
                            <div class="fv-row mb-10">
                                <!--begin::Label-->
                                <label class="form-label fs-6 fw-bolder text-dark">Email</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <input class="form-control form-control-lg form-control-solid"  autocomplete="off"    type="email" name="email" :value="old('email')" required autofocus />
                                <!--end::Input-->
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="fv-row mb-10">
                                <!--begin::Wrapper-->
                                <div class="d-flex flex-stack mb-2">
                                    <!--begin::Label-->
                                    <label class="form-label fw-bolder text-dark fs-6 mb-0">Password</label>
                                    <!--end::Label-->
                                    <!--begin::Link-->
                                    <a  class="link-primary fs-6 fw-bolder"  href="{{ route('password.request') }}" >Forgot Password ?</a>
                                    <!--end::Link-->
                                </div>
                                <!--end::Wrapper-->
                                <!--begin::Input-->
                                <input class="form-control form-control-lg form-control-solid"  autocomplete="off"    type="password" name="password" required autocomplete="current-password"/>
                                <!--end::Input-->
                            </div>
                            <!--end::Input group-->
                            <!--begin::Actions-->
                            <div class="text-center">
                                <!--begin::Submit button-->
                                <button type="submit" class="btn btn-lg btn-primary w-100 mb-5">
                                    <span class="indicator-label">Continue</span>
                                </button>

                                <!--end::Submit button-->
                                <!--begin::Separator-->
                                <!--end::Google link-->
                            </div>
                            <!--end::Actions-->
                        </form>
                        <!--end::Form-->
                    </div>
                    <!--end::Wrapper-->
                </div>
                <!--end::Content-->
                <!--begin::Footer-->
             
                <!--end::Footer-->
            </div>
            <!--end::Authentication - Sign-in-->
        </div>
        <!--end::Main-->
        <!--begin::Javascript-->
        <!--begin::Global Javascript Bundle(used by all pages)-->
        <script src="assets/plugins/global/plugins.bundle.js"></script>
        <script src="assets/js/scripts.bundle.js"></script>
        <!--end::Global Javascript Bundle-->
        <!--begin::Page Custom Javascript(used by this page)-->
         <!--end::Page Custom Javascript-->
        <!--end::Javascript-->
        <style type="text/css">.developer-intro {
    position: fixed;
    bottom: 5px;
    left: 10px;
}
.developer-intro a {
    font-size: 13px;
    font-weight: 600;
    font-weight: 500;
}
</style>
        <div class="developer-intro">Powered by: <a href="https://www.sypsys.com/" target="_blank">Sypsys Technologies </a></div>
    </body>
    <!--end::Body-->
</html>