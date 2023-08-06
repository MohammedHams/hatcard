<div class="header-menu-container d-flex align-items-stretch flex-stack w-100" id="kt_header_nav">
    <!--begin::Menu wrapper-->
    <div class="header-menu container-xxl flex-column align-items-stretch flex-lg-row" data-kt-drawer="true" data-kt-drawer-name="header-menu" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="{default:'200px', '300px': '250px'}" data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_header_menu_toggle" data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_body', lg: '#kt_header_nav'}">
        <!--begin::Menu-->
        <div class="menu menu-column menu-lg-row menu-active-bg menu-title-gray-800 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-500 fw-bold my-5 my-lg-0 align-items-stretch flex-grow-1" id="kt_header_menu" data-kt-menu="true">
            <div  data-kt-menu-placement="bottom-start" class="menu-item {{ request()->routeIs('dashboard.index') ? 'here' : '' }} menu-lg-down-accordion me-lg-1">

                <a class="menu-link py-3" id="kt_page_loading_message" href="{{route('dashboard.index')}}">
                    <span class="menu-title">الشاشة الرئيسية</span>
                                            </a>

            </div>
            <div  data-kt-menu-placement="bottom-start" class="menu-item {{ request()->routeIs('network.index') ? 'here' : '' }} menu-lg-down-accordion me-lg-1">
                <a class="menu-link py-3" id="kt_page_loading_message" href="{{route('network.index')}}">


                    <span class="menu-title">شبكاتي</span>

                </a>
            </div>
            <div  data-kt-menu-placement="bottom-start" class="menu-item {{ request()->routeIs('report.index') ? 'here' : '' }} menu-lg-down-accordion me-lg-1">
                <a class="menu-link py-3" id="kt_page_loading_message" href="{{route('report.index')}}">
                    <span class="menu-title">تقارير رفع البطاقات</span>

                </a>
            </div>
        </div>
        <!--end::Menu-->
    </div>
    <!--end::Menu wrapper-->
</div>
</div>
