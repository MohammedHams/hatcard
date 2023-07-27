@include('layouts.dashboard.header')
<div class="d-flex flex-row flex-column-fluid align-items-stretch">
    @yield('content')
</div>
@include('layouts.dashboard.footer')
<script>var hostUrl = "assets/";</script>
<!--begin::Global Javascript Bundle(used by all pages)-->
<script src="{{asset('plugins/global/plugins.bundle.js')}}"></script>
<script src="{{asset('js/scripts.bundle.js')}}"></script>
<!--end::Global Javascript Bundle-->
<!--begin::Page Vendors Javascript(used by this page)-->
<script src="{{asset('plugins/custom/fullcalendar/fullcalendar.bundle.js')}}"></script>
<script src="{{asset('plugins/custom/datatables/datatables.bundle.js')}}"></script>
<!--end::Page Vendors Javascript-->
<!--begin::Page Custom Javascript(used by this page)-->
<script src="{{asset('js/widgets.bundle.js')}}"></script>
<script src="{{asset('js/custom/widgets.js')}}"></script>
<script src="{{asset('js/custom/apps/chat/chat.js')}}"></script>
<script src="{{asset('js/custom/utilities/modals/upgrade-plan.js')}}"></script>
<script src="{{asset('js/custom/utilities/modals/create-app.js')}}"></script>
<script src="{{asset('js/custom/utilities/modals/users-search.js')}}"></script>
<!--end::Page Custom Javascript-->
<!--end::Javascript-->
</body>
<!--end::Body-->
</html>
