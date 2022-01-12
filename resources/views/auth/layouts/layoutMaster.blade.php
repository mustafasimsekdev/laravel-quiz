<body
    class="vertical-layout vertical-menu-collapsible page-header-dark vertical-modern-menu preload-transitions 1-column login-register-bg  blank-page blank-page"
    data-open="click" data-menu="vertical-modern-menu" data-col="1-column">

<!-- BEGIN: Page Main-->

<div class="row">
    <div class="col s12">
        <div class="container">

        <!-- START CONTENT -->
        @yield('content')
        <!-- END CONTENT -->

        </div>
        <div class="content-overlay"></div>
    </div>
</div>

<!-- END: Page Main-->

<!-- BEGIN VENDOR JS, PAGE VENDOR JS, THEME  JS, PAGE LEVEL JS-->
@include('auth.panels.scripts')
<!-- END VENDOR JS, PAGE VENDOR JS, THEME  JS, PAGE LEVEL JS-->

</body>

