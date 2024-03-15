
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
    <head><base href="">
        <title>Recon - Dashboard</title>
        <meta name="description" content="Recon" />
        <meta name="keywords" content="Recon" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta charset="utf-8" />
        <meta property="og:locale" content="en_US" />
        <meta property="og:type" content="article" />
        <meta property="og:title" content="Recon" />
         <meta property="og:site_name" content="Recon | Dashboard" />
         <link rel="shortcut icon" href="{{url('')}}/assets/media/logos/favicon.ico" />
        <!--begin::Fonts-->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
        <!--end::Fonts-->
        <!--begin::Page Vendor Stylesheets(used by this page)-->
        <link href="{{url('')}}/assets/plugins/custom/leaflet/leaflet.bundle.css" rel="stylesheet" type="text/css" />
        <!--end::Page Vendor Stylesheets-->
        <!--begin::Global Stylesheets Bundle(used by all pages)-->
        <link href="{{url('')}}/assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
        <link href="{{url('')}}/assets/css/style.bundle.css" rel="stylesheet" type="text/css" />
        <!--end::Global Stylesheets Bundle-->
    </head>
    <!--end::Head-->
    <!--begin::Body-->
    <body id="kt_body" class="header-fixed header-tablet-and-mobile-fixed aside-fixed aside-secondary-disabled">
        <!--begin::Main-->
        <!--begin::Root-->
        <div class="d-flex flex-column flex-root">
            <!--begin::Page-->
            <div class="page d-flex flex-row flex-column-fluid">
                <!--begin::Aside-->
                <div id="kt_aside" class="aside bg-primary" data-kt-drawer="true" data-kt-drawer-name="aside" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="auto" data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_aside_toggle">
                    <!--begin::Logo-->
                    <div class="aside-logo d-none d-lg-flex flex-column align-items-center flex-column-auto py-8" id="kt_aside_logo">
                        <a href="">
                            <img alt="Logo" src="{{url('')}}/assets/media/logos/logo-demo-4.svg" class="h-55px" />
                        </a>
                    </div>
                    <!--end::Logo-->
                    <!--begin::Nav-->
                    <div class="aside-nav d-flex flex-column align-lg-center flex-column-fluid w-100 pt-5 pt-lg-0" id="kt_aside_nav">
                        <!--begin::Primary menu-->
                        <div id="kt_aside_menu" class="menu menu-column menu-title-gray-600 menu-state-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-500 fw-bold fs-6" data-kt-menu="true">
                            <div class="menu-item py-2">
                                <a class="menu-link active menu-center" href="{{url('dashboard')}}" title="Dashboard" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss="click" data-bs-placement="right">
                                    <span class="menu-icon me-0">
                                        <i class="bi bi-house fs-2"></i>
                                    </span>
                                </a>
                            </div>
                            <div class="menu-item py-2 sub">
                                <a class="menu-link menu-center" title="Surveys" href="{{routes('surveys')}}" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss="click" data-bs-placement="right">
                                    <span class="menu-icon me-0">
                                        <i class="bi bi-file-earmark-lock fs-2"></i>
                                    </span>
                                </a>   
                            </div>
                             
                            <div class="menu-item py-2 suba">
                                <a class="menu-link menu-center" title="Surveyors" href="{{url('surveyors')}}" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss="click" data-bs-placement="right">
                                    <span class="menu-icon me-0">
                                        <i class="bi bi-people fs-2"></i>
                                    </span>
                                </a>
                            </div>

                            <div class="menu-item py-2 suba">
                                <a class="menu-link menu-center" title="Management" href="{{url('management')}}" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss="click" data-bs-placement="right">
                                    <span class="menu-icon me-0">
                                        <i class="bi-person-plus-fill fs-2"></i>
                                    </span>
                                </a>
                            </div>
                             
                            <div data-kt-menu-trigger="click" data-kt-menu-placement="right-start" data-kt-menu-flip="bottom" class="menu-item py-2">
                                <span class="menu-link menu-center" title="Settings" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss="click" data-bs-placement="right">
                                    <span class="menu-icon me-0">
                                        <i class="bi bi-gear fs-2"></i>
                                    </span>
                                </span>
                                
                            </div>
                        </div>
                        <!--end::Primary menu-->
                    </div>
                    <!--end::Nav-->
                    <!--begin::Footer-->
                    
                    <!--end::Footer-->
                </div>
                <!--end::Aside-->
                <!--begin::Wrapper-->
                <div class="wrapper d-flex flex-column flex-row-fluid" id="kt_wrapper">
                    <!--begin::Header-->
                    <div id="kt_header" style="" class="header bg-white align-items-stretch">
                        <!--begin::Container-->
                        <div class="container-fluid d-flex align-items-stretch justify-content-between">
                            <!--begin::Aside mobile toggle-->
                            <div class="d-flex align-items-center d-lg-none ms-n3 me-1" title="Show aside menu">
                                <div class="btn btn-icon btn-active-color-primary w-40px h-40px" id="kt_aside_toggle">
                                    <!--begin::Svg Icon | path: icons/duotone/Text/Menu.svg-->
                                    <span class="svg-icon svg-icon-2x mt-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <rect x="0" y="0" width="24" height="24" />
                                                <rect fill="#000000" x="4" y="5" width="16" height="3" rx="1.5" />
                                                <path d="M5.5,15 L18.5,15 C19.3284271,15 20,15.6715729 20,16.5 C20,17.3284271 19.3284271,18 18.5,18 L5.5,18 C4.67157288,18 4,17.3284271 4,16.5 C4,15.6715729 4.67157288,15 5.5,15 Z M5.5,10 L18.5,10 C19.3284271,10 20,10.6715729 20,11.5 C20,12.3284271 19.3284271,13 18.5,13 L5.5,13 C4.67157288,13 4,12.3284271 4,11.5 C4,10.6715729 4.67157288,10 5.5,10 Z" fill="#000000" opacity="0.3" />
                                            </g>
                                        </svg>
                                    </span>
                                    <!--end::Svg Icon-->
                                </div>
                            </div>
                            <!--end::Aside mobile toggle-->
                            <!--begin::Mobile logo-->
                            <div class="d-flex align-items-center flex-grow-1 flex-lg-grow-0">
                                <a href="{{url('dashboard')}}" class="d-lg-none">
                                    <img alt="Logo" src="{{url('')}}/assets/media/logos/logo-3.svg" class="h-30px" />
                                </a>
                            </div>
                            <!--end::Mobile logo-->
                            <div class="d-flex align-items-center" id="kt_header_wrapper">
                                <!--begin::Page title-->
                                <div class="page-title d-flex flex-column align-items-start justify-content-center flex-wrap me-lg-20 pb-2 pb-lg-0" data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_content_container', lg: '#kt_header_wrapper'}">
                                    <!--begin::Heading-->
                                    <h1 class="text-dark fw-bolder my-1 fs-3 lh-1">Dashboard</h1>
                                    <!--end::Heading-->
                                </div>
                                <!--end::Page title=-->
                            </div>
                            <!--begin::Wrapper-->
                            <div class="d-flex align-items-stretch justify-content-between flex-lg-grow-1" style="justify-content: flex-end !important;">
                                <!--begin::Navbar-->
                               



                                <!--end::Navbar-->
                                <!--begin::Topbar-->
                                <div class="d-flex align-items-stretch justify-self-end flex-shrink-0">
                                    <!--begin::Toolbar wrapper-->
                                    <div class="d-flex align-items-stretch flex-shrink-0">
                                        <!--begin::Search-->
                                         
                                        <!--end::Search-->
                                        <!--begin::Activities-->
                                        
                                        <!--end::Activities-->
                                        <!--begin::Quick links-->
                                       
                                        <!--end::Quick links-->
                                        <!--begin::Chat-->
                                      
                                        <!--end::Chat-->
                                        <!--begin::Notifications-->
                                      
                                        <!--end::Notifications-->
                                        <!--begin::User-->
                                        <div class="d-flex align-items-center ms-1 ms-lg-3" id="kt_header_user_menu_toggle">
                                            <!--begin::Menu wrapper-->
                                            <div class="cursor-pointer symbol symbol-30px symbol-md-40px" data-kt-menu-trigger="click" data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end" data-kt-menu-flip="bottom">
                                                <img src="{{url('')}}/assets/media/avatars/150-26.jpg" alt="metronic" />
                                            </div>
                                            <!--begin::Menu-->
                                            <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-primary fw-bold py-4 fs-6 w-275px" data-kt-menu="true">
                                                <!--begin::Menu item-->
                                                <div class="menu-item px-3">
                                                    <div class="menu-content d-flex align-items-center px-3">
                                                        <!--begin::Avatar-->
                                                        <div class="symbol symbol-50px me-5">
                                                            <img alt="Logo" src="{{url('')}}/assets/media/avatars/150-26.jpg" />
                                                        </div>
                                                        <!--end::Avatar-->
                                                        <!--begin::Username-->
                                                        <div class="d-flex flex-column">
                                                            <div class="fw-bolder d-flex align-items-center fs-5">{{\Auth::user()->name}}
                                                             </div>
                                                            <a href="#" class="fw-bold text-muted text-hover-primary fs-7">{{\Auth::user()->email}}</a>
                                                        </div>
                                                        <!--end::Username-->
                                                    </div>
                                                </div>
                                                <!--end::Menu item-->
                                                <!--begin::Menu separator-->
                                                <div class="separator my-2"></div>
                                                <!--end::Menu separator-->
                                                <!--begin::Menu item-->
                                                <div class="menu-item px-5">
                                                    <a href="{{url('user/profile')}}" class="menu-link px-5">My Profile</a>
                                                </div>
                                                <!--end::Menu item-->
                                                <!--begin::Menu item-->
                                               
                                                 <!--begin::Menu item-->
                                                
                                                
                                                <!--end::Menu item-->
                                                <!--begin::Menu item-->
                                                <div class="menu-item px-5">
                                                    <a href="{{url('logout')}}" class="menu-link px-5">Sign Out</a>
                                                </div>
                                                <!--end::Menu item-->
                                            </div>
                                            <!--end::Menu-->
                                            <!--end::Menu wrapper-->
                                        </div>
                                        <!--end::User -->
                                        <!--begin::Heaeder menu toggle-->
                                      
                                        <!--end::Heaeder menu toggle-->
                                    </div>
                                    <!--end::Toolbar wrapper-->
                                </div>
                                <!--end::Topbar-->
                            </div>
                            <!--end::Wrapper-->
                        </div>
                        <!--end::Container-->
                    </div>
                    <!--end::Header-->
                    <!--begin::Search form-->
                 
                    <!--end::Search form-->
                    <!--begin::Content-->
                    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
                        <!--begin::Container-->
                         @yield('content');
                        <!--end::Container-->
                    </div>
                    <!--end::Content-->
                    <!--begin::Footer-->
                     
                    <!--end::Footer-->
                </div>
                <!--end::Wrapper-->
            </div>
            <!--end::Page-->
        </div>
        <!--end::Root-->
        <!--begin::Drawers-->
        <!--begin::Activities drawer-->
        
        <!--end::Activities drawer-->
        <!--begin::Exolore drawer toggle-->
     
        <!--end::Exolore drawer-->
        <!--begin::Chat drawer-->
        
        <!--end::Modal - Select Location-->
        <!--end::Modals-->
        <!--begin::Scrolltop-->
        <div id="kt_scrolltop" class="scrolltop" data-kt-scrolltop="true">
            <!--begin::Svg Icon | path: icons/duotone/Navigation/Up-2.svg-->
            <span class="svg-icon">
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                        <polygon points="0 0 24 0 24 24 0 24" />
                        <rect fill="#000000" opacity="0.5" x="11" y="10" width="2" height="10" rx="1" />
                        <path d="M6.70710678,12.7071068 C6.31658249,13.0976311 5.68341751,13.0976311 5.29289322,12.7071068 C4.90236893,12.3165825 4.90236893,11.6834175 5.29289322,11.2928932 L11.2928932,5.29289322 C11.6714722,4.91431428 12.2810586,4.90106866 12.6757246,5.26284586 L18.6757246,10.7628459 C19.0828436,11.1360383 19.1103465,11.7686056 18.7371541,12.1757246 C18.3639617,12.5828436 17.7313944,12.6103465 17.3242754,12.2371541 L12.0300757,7.38413782 L6.70710678,12.7071068 Z" fill="#000000" fill-rule="nonzero" />
                    </g>
                </svg>
            </span>
            <!--end::Svg Icon-->
        </div>
        <!--end::Scrolltop-->
        <!--end::Main-->
        <!--begin::Javascript-->
        <!--begin::Global Javascript Bundle(used by all pages)-->
        <script src="{{url('')}}/assets/plugins/global/plugins.bundle.js"></script>
        <script src="{{url('')}}/assets/js/scripts.bundle.js"></script>
        <!--end::Global Javascript Bundle-->
        <!--begin::Page Vendors Javascript(used by this page)-->
        <script src="{{url('')}}/assets/plugins/custom/leaflet/leaflet.bundle.js"></script>
        <!--end::Page Vendors Javascript-->
        <!--begin::Page Custom Javascript(used by this page)-->
        <script src="{{url('')}}/assets/js/custom/modals/select-location.js"></script>
        <script src="{{url('')}}/assets/js/custom/widgets.js"></script>
        <script src="{{url('')}}/assets/js/custom/modals/create-app.js"></script>
        <script src="{{url('')}}/assets/js/custom/apps/chat/chat.js"></script>
        <!--end::Page Custom Javascript-->
        <!--end::Javascript-->
    </body>
    <!--end::Body-->
</html>