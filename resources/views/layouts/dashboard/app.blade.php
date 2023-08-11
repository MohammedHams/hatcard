@php
  $user =  \App\Models\User::select('phone','balance')->where('_id',Auth::id())->first();
@endphp
<!DOCTYPE html>
<html lang="ar" direction="rtl" dir="rtl" style="direction: rtl">
<!--begin::Head-->
<head><base href="">

    <title>لوحة تحكم تطبيق HatCard</title>
    <meta charset="utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link rel="canonical" href="" />
    <!--begin::Fonts-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Cairo:wght@600&display=swap" />
    <!--end::Fonts-->
    <!--begin::Page Vendor Stylesheets(used by this page)-->
    <link href="{{asset('plugins/custom/datatables/datatables.dark.bundle.css')}}" rel="stylesheet" type="text/css" />
 {{--   <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />--}}
    <link href="{{asset('plugins/custom/prismjs/prismjs.bundle.rtl.css')}}" rel="stylesheet" type="text/css" />
    <!--end::Page Vendor Stylesheets-->
    <!--begin::Global Stylesheets Bundle(used by all pages)-->
    <link href="{{asset('css/plugins.bundle.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('css/style.bundle.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('css/style.css')}}" rel="stylesheet" type="text/css" />

    <style>.svg-loader{
            display:flex;
            position: relative;
            align-content: space-around;
            justify-content: center;
        }
        .loader-svg{
            position: absolute;
            left: 0; right: 0; top: 0; bottom: 0;
            fill: none;
            stroke-width: 5px;
            stroke-linecap: round;
            stroke: rgb(64, 0, 148);
        }
        .loader-svg.bg{
            stroke-width: 4px;
            stroke: rgb(207, 205, 245);
        }
        .animate{
            stroke-dasharray: 242.6;
            animation: fill-animation 1s cubic-bezier(1,1,1,1) 0s infinite;
        }

        @keyframes fill-animation{
            0%{
                stroke-dasharray: 40 242.6;
                stroke-dashoffset: 0;
            }
            50%{
                stroke-dasharray: 141.3;
                stroke-dashoffset: 141.3;
            }
            100%{
                stroke-dasharray: 40 242.6;
                stroke-dashoffset: 282.6;
            }
        }

    </style>
    <!--end::Global Stylesheets Bundle-->
    @stack('styles')
</head>
<!--begin::Body-->
<body id="kt_body" class="header-fixed header-tablet-and-mobile-fixed toolbar-enabled">

<!--begin::Main-->
<!--begin::Root-->
<div class="d-flex flex-column flex-root">
    <!--begin::Page-->
    <div class="page d-flex flex-column flex-column-fluid">
        <!--begin::Header-->
        <div id="kt_header" class="header" data-kt-sticky="true" data-kt-sticky-name="header" data-kt-sticky-offset="{default: '200px', lg: '300px'}">
            <!--begin::Container-->
            <div class="header-top-container container-xxl sabi d-flex flex-grow-1 flex-stack">
                <!--begin::Header Logo-->
                <div class="d-flex align-items-center me-5">
                    <!--begin::Heaeder menu toggle-->
                    <div class="d-lg-none btn btn-icon btn-active-color-300 w-30px h-30px me-2" id="kt_header_menu_toggle">
                        <!--begin::Svg Icon | path: icons/duotune/abstract/abs015.svg-->
                        <span class="svg-icon svg-icon-2">
									<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
										<path d="M21 7H3C2.4 7 2 6.6 2 6V4C2 3.4 2.4 3 3 3H21C21.6 3 22 3.4 22 4V6C22 6.6 21.6 7 21 7Z" fill="currentColor" />
										<path opacity="0.3" d="M21 14H3C2.4 14 2 13.6 2 13V11C2 10.4 2.4 10 3 10H21C21.6 10 22 10.4 22 11V13C22 13.6 21.6 14 21 14ZM22 20V18C22 17.4 21.6 17 21 17H3C2.4 17 2 17.4 2 18V20C2 20.6 2.4 21 3 21H21C21.6 21 22 20.6 22 20Z" fill="currentColor" />
									</svg>
								</span>
                        <!--end::Svg Icon-->
                    </div>
                    <!--end::Heaeder menu toggle-->
                    <!--begin::Logo-->
                    <a href="{{route('dashboard.index')}}">
                        <!--begin::Desktop modes-->
                        <img alt="Logo" src="{{asset('images/logo.png')}}" class="d-none d-lg-inline-block h-100px" style="margin-bottom: 5px;" />
                        <!--end::Desktop modes-->
                        <!--begin::Table & mobile modes-->
                        <img alt="Logo" src="{{asset('images/logo.png')}}" class="d-lg-none h-50px" style="margin-bottom: 5px;" />
                        <!--end::Table & mobile modes-->
                    </a>
                    <!--end::Logo-->
                </div>
                <!--end::Header Logo-->
                <!--begin::Toolbar wrapper-->
                <div class="topbar d-flex align-items-stretch flex-shrink-0" id="kt_topbar">
                    <!--begin:Search--><!--begin::User-->
                    <div class="d-flex align-items-center ms-2 ms-lg-3" id="kt_header_user_menu_toggle">
                        <!--begin::Menu wrapper-->
                        <div class="cursor-pointer symbol symbol-30px symbol-md-40px" data-kt-menu-trigger="click" data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end">
                            <img src="{{asset('media/avatars/300-1.jpg')}}" alt="user" />
                        </div>
                        <!--begin::User account menu-->
                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-primary fw-bold py-4 fs-6 w-275px" data-kt-menu="true">
                            <!--begin::Menu item-->
                            <div class="menu-item px-3">
                                <div class="menu-content d-flex align-items-center px-3">
                                    <!--begin::Avatar-->
                                    <div class="symbol symbol-50px me-5">
                                        <img alt="Logo" src="{{asset('media/avatars/300-1.jpg')}}" />
                                    </div>
                                    <!--end::Avatar-->
                                    <!--begin::Username-->
                                    <div class="d-flex flex-column">
                                        <div class="fw-bolder d-flex align-items-center fs-5">{{Auth::user()->name}}
                                            <span class="badge badge-light-success fw-bolder fs-8 px-2 py-1 ms-2">الرصيد : {{$user->balance}}</span></div>
                                        <a href="#" class="fw-bold text-muted text-hover-primary fs-7">{{$user->phone}}</a>
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
                                <a href="#" class="menu-link px-5"><i class="bi bi-person" style="font-size: 16px;margin-left: 5px"></i>الملف الشخصي</a>
                            </div>
                            <!--end::Menu item-->
                            <!--begin::Menu item-->
                            <div class="menu-item px-5">
                                <a href="{{route('network.index')}}" class="menu-link px-5">
                                    <span class="menu-text"><i class="bi bi-wifi" style="font-size: 16px;margin-left: 5px"></i>شبكاتي</span>
                                    {{--<span class="menu-badge">
												<span class="badge badge-light-danger badge-circle fw-bolder fs-7">3</span>
											</span>--}}
                                </a>
                            </div>

                            <div class="menu-item px-5">
                                <a href="{{route('report.index')}}" class="menu-link px-5">
                                    <span class="menu-text"><i class="bi bi-credit-card" style="font-size: 16px;margin-left: 5px"></i>تقارير رفع البطاقات</span>
                                    {{--<span class="menu-badge">
												<span class="badge badge-light-danger badge-circle fw-bolder fs-7">3</span>
											</span>--}}
                                </a>
                            </div>
                            <!--end::Menu item-->
                            <!--begin::Menu item-->
{{--
                            <div class="menu-item px-5" data-kt-menu-trigger="hover" data-kt-menu-placement="left-start">
                                <a href="#" class="menu-link px-5">
                                    <span class="menu-title">My Subscription</span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <!--begin::Menu sub-->
                                <div class="menu-sub menu-sub-dropdown w-175px py-4">
                                    <!--begin::Menu item-->
                                    <div class="menu-item px-3">
                                        <a href="../../demo19/dist/account/referrals.html" class="menu-link px-5">Referrals</a>
                                    </div>
                                    <!--end::Menu item-->
                                    <!--begin::Menu item-->
                                    <div class="menu-item px-3">
                                        <a href="../../demo19/dist/account/billing.html" class="menu-link px-5">Billing</a>
                                    </div>
                                    <!--end::Menu item-->
                                    <!--begin::Menu item-->
                                    <div class="menu-item px-3">
                                        <a href="../../demo19/dist/account/statements.html" class="menu-link px-5">Payments</a>
                                    </div>
                                    <!--end::Menu item-->
                                    <!--begin::Menu item-->
                                    <div class="menu-item px-3">
                                        <a href="../../demo19/dist/account/statements.html" class="menu-link d-flex flex-stack px-5">Statements
                                            <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="View your statements"></i></a>
                                    </div>
                                    <!--end::Menu item-->
                                    <!--begin::Menu separator-->
                                    <div class="separator my-2"></div>
                                    <!--end::Menu separator-->
                                    <!--begin::Menu item-->
                                    <div class="menu-item px-3">
                                        <div class="menu-content px-3">
                                            <label class="form-check form-switch form-check-custom form-check-solid">
                                                <input class="form-check-input w-30px h-20px" type="checkbox" value="1" checked="checked" name="notifications" />
                                                <span class="form-check-label text-muted fs-7">Notifications</span>
                                            </label>
                                        </div>
                                    </div>
                                    <!--end::Menu item-->
                                </div>
                                <!--end::Menu sub-->
                            </div>
                            <!--end::Menu item-->
                            <!--begin::Menu item-->
                            <div class="menu-item px-5">
                                <a href="../../demo19/dist/account/statements.html" class="menu-link px-5">My Statements</a>
                            </div>
                            <!--end::Menu item-->
                            <!--begin::Menu separator-->
                            <div class="separator my-2"></div>
                            <!--end::Menu separator-->
                            <!--begin::Menu item-->
                            <div class="menu-item px-5" data-kt-menu-trigger="hover" data-kt-menu-placement="left-start">
                                <a href="#" class="menu-link px-5">
											<span class="menu-title position-relative">Language
											<span class="fs-8 rounded bg-light px-3 py-2 position-absolute translate-middle-y top-50 end-0">English
											<img class="w-15px h-15px rounded-1 ms-2" src="{{asset('media/flags/united-states.svg')}}" alt="" /></span></span>
                                </a>
                                <!--begin::Menu sub-->
                                <div class="menu-sub menu-sub-dropdown w-175px py-4">
                                    <!--begin::Menu item-->
                                    <div class="menu-item px-3">
                                        <a href="../../demo19/dist/account/settings.html" class="menu-link d-flex px-5 active">
												<span class="symbol symbol-20px me-4">
													<img class="rounded-1" src="{{asset('media/flags/united-states.svg')}}" alt="" />
												</span>English</a>
                                    </div>
                                    <!--end::Menu item-->
                                    <!--begin::Menu item-->
                                    <div class="menu-item px-3">
                                        <a href="../../demo19/dist/account/settings.html" class="menu-link d-flex px-5">
												<span class="symbol symbol-20px me-4">
													<img class="rounded-1" src="{{asset('media/flags/spain.svg')}}" alt="" />
												</span>Spanish</a>
                                    </div>
                                    <!--end::Menu item-->
                                    <!--begin::Menu item-->
                                    <div class="menu-item px-3">
                                        <a href="../../demo19/dist/account/settings.html" class="menu-link d-flex px-5">
												<span class="symbol symbol-20px me-4">
													<img class="rounded-1" src="{{asset('media/flags/germany.svg')}}" alt="" />
												</span>German</a>
                                    </div>
                                    <!--end::Menu item-->
                                    <!--begin::Menu item-->
                                    <div class="menu-item px-3">
                                        <a href="../../demo19/dist/account/settings.html" class="menu-link d-flex px-5">
												<span class="symbol symbol-20px me-4">
													<img class="rounded-1" src="{{asset('media/flags/japan.svg')}}" alt="" />
												</span>Japanese</a>
                                    </div>
                                    <!--end::Menu item-->
                                    <!--begin::Menu item-->
                                    <div class="menu-item px-3">
                                        <a href="../../demo19/dist/account/settings.html" class="menu-link d-flex px-5">
												<span class="symbol symbol-20px me-4">
													<img class="rounded-1" src="{{asset('media/flags/france.svg')}}" alt="" />
												</span>French</a>
                                    </div>
                                    <!--end::Menu item-->
                                </div>
                                <!--end::Menu sub-->
                            </div>
                            <!--end::Menu item-->
                            <!--begin::Menu item-->
                            <div class="menu-item px-5 my-1">
                                <a href="../../demo19/dist/account/settings.html" class="menu-link px-5">Account Settings</a>
                            </div>
                            <!--end::Menu item-->
--}}
                            <!--begin::Menu item-->
                            <div class="menu-item px-5">
                                <a href="{{route('agent.logout')}}" class="menu-link px-5"><i class="bi bi-box-arrow-in-right" style="font-size: 16px;margin-left: 5px"></i>تسجيل خروج</a>
                            </div>
                            <!--end::Menu item-->
                            <!--begin::Menu separator-->
                            <div class="separator my-2"></div>
                            <!--end::Menu separator-->
                            <!--begin::Menu item-->

                            <!--end::Menu item-->
                        </div>
                        <!--end::User account menu-->
                        <!--end::Menu wrapper-->
                    </div>
                    <!--end::User -->
                    <!--begin::Heaeder menu toggle-->
                    <!--end::Heaeder menu toggle-->
                </div>
                <!--end::Toolbar wrapper-->
            </div>
            @include('layouts.dashboard.menu')


            <div class="d-flex flex-row flex-column-fluid align-items-stretch">
    <div class="wrapper d-flex flex-column flex-row-fluid container-xxl" id="kt_wrapper">
        <!--begin::Toolbar-->
        <div class="toolbar d-flex flex-stack flex-wrap py-4 gap-2" id="kt_toolbar">
            <!--begin::Page title-->
            <!--end::Page title-->
            <!--begin::Actions-->
            <!--end::Actions-->
        </div>
        <!--end::Toolbar-->
        <!--begin::Main-->
        <!--begin::Content-->
        <div class="content flex-row-fluid" id="kt_content">

            <div class="wrapper d-flex flex-column flex-row-fluid container-xxl" id="kt_wrapper">

            @yield('content')
            </div>
        </div>
        <!--end::Content-->

        <!--end::Main-->
    </div>
</div>
</div>
    </div>
</div>

@include('layouts.dashboard.footer')
@include('layouts.dashboard.modal')
<script>var hostUrl = "assets/";</script>
<!--begin::Global Javascript Bundle(used by all pages)-->
<script src="{{asset('js/plugins.bundle.js')}}"></script>
<script src="{{asset('js/scripts.bundle.js')}}"></script>
<!--begin::Javascript-->
<!--begin::Global Javascript Bundle(used by all pages)-->
<script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>


<!--begin::Own Scripts(general script)-->
<script src="{{ asset('js/main.js') }}"></script>
<script src="{{ asset('js/custom.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<!--end::Own Scripts-->
<script>

    $(function (){
        $(".modal-content" ).draggable()
        // activate the menu in left side bar based on url
        $("#kt_aside_menu_wrapper a").each(function () {
            var pageUrl = window.location.href.split(/[?#]/)[0];
            if (this.href == pageUrl) {
                $(this).addClass("active");
                $(this).parent().addClass("show"); // add active to li of the current link
                $(this).parent().parent().addClass("show");
                //$(this).parent().parent().prev().addClass("menu-item-active"); // add active class to an anchor
                $(this).parent().parent().parent().addClass("show");
                $(this).parent().parent().parent().parent().addClass("show"); // add active to li of the current link
                $(this).parent().parent().parent().parent().parent().addClass("show");
                $(this).parent().parent().parent().parent().parent().parent().addClass("show");
                $(this).parent().parent().parent().parent().parent().parent().parent().addClass("show");
            }
        });
    });
</script>
<script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>

<!--end::Global Javascript Bundle-->
<!--begin::Page Vendors Javascript(used by this page)-->

<script src="{{asset('plugins/custom/datatables/datatables.bundle.js')}}"></script>
@yield('scripts')
<script></script>
<!--end::Page Custom Javascript-->
<!--end::Javascript-->
</body>
<!--end::Body-->
</html>
