<!-- BEGIN VENDOR JS-->
<script src="{{asset('js/vendors.min.js')}}"></script>
<!-- BEGIN VENDOR JS-->

<!-- BEGIN PAGE VENDOR JS-->
@yield('vendor-script')
<!-- END PAGE VENDOR JS-->

<!-- BEGIN THEME  JS-->
<script src="{{asset('js/plugins.min.js')}}"></script>
<script src="{{asset('js/search.min.js')}}"></script>
<script src="{{asset('js/custom/custom-script.min.js')}}"></script>
<script src="{{asset('js/scripts/customizer.min.js')}}"></script>
<script src="{{asset('js/jconfirm/jquery-confirm.min.js')}}"></script>
<!-- END THEME  JS-->

<!-- BEGIN PAGE LEVEL JS-->
<script src="{{asset('js/scripts/dashboard-modern.js')}}"></script>
<script src="{{asset('js/scripts/intro.min.js')}}"></script>
@yield('page-script')
<!-- END PAGE LEVEL JS-->
