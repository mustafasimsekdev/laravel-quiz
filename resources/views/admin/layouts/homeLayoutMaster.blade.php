<body
    class="vertical-layout vertical-menu-collapsible page-header-dark vertical-modern-menu preload-transitions 2-columns   "
    data-open="click" data-menu="vertical-modern-menu" data-col="2-columns">

<!-- BEGIN: Header-->
<header class="page-topbar" id="header">

    <!-- BEGIN: Navbar-->
    @include('admin.panels.navbar')
    <!-- END: Navbar-->

</header>
<!-- END: Header-->

<!-- BEGIN: SideNav-->
@include('admin.panels.sidebar')
<!-- END: SideNav-->

<!-- BEGIN: Page Main-->
<div id="main">
    <div class="row">
        <div class="content-wrapper-before gradient-45deg-indigo-purple"></div>
        @yield('breadcrumbs')
        <div class="col s12">
            <div class="container">

                <!-- START CONTENT -->
                @yield('content')
                <!-- END CONTENT -->

            </div>
            <div class="content-overlay"></div>
        </div>
    </div>
</div>
<!-- END: Page Main-->


<!-- BEGIN: Footer-->
@include('admin.panels.footer')
<!-- END: Footer-->


<!-- BEGIN VENDOR JS, PAGE VENDOR JS, THEME  JS, PAGE LEVEL JS-->
@include('admin.panels.scripts')
<!-- END VENDOR JS, PAGE VENDOR JS, THEME  JS, PAGE LEVEL JS-->

</body>

