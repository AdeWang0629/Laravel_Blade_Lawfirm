<!-- Back-to-top -->
<a href="#top" id="back-to-top"><i class="las la-angle-double-up"></i></a>
<!-- JQuery min js -->
<script src="{{URL::asset('admin_assets/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap Bundle js -->
<script src="{{URL::asset('admin_assets/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- Ionicons js -->
<script src="{{URL::asset('admin_assets/plugins/ionicons/ionicons.js')}}"></script>
<!-- Moment js -->
<script src="{{URL::asset('admin_assets/plugins/moment/moment.js')}}"></script>

<!-- Rating js-->
<script src="{{URL::asset('admin_assets/plugins/rating/jquery.rating-stars.js')}}"></script>
<script src="{{URL::asset('admin_assets/plugins/rating/jquery.barrating.js')}}"></script>

<!--Internal  Perfect-scrollbar js -->
<script src="{{URL::asset('admin_assets/plugins/perfect-scrollbar/perfect-scrollbar.min.js')}}"></script>
<!--Internal Sparkline js -->
<script src="{{URL::asset('admin_assets/plugins/jquery-sparkline/jquery.sparkline.min.js')}}"></script>
<!-- Custom Scroll bar Js-->
<script src="{{URL::asset('admin_assets/plugins/mscrollbar/jquery.mCustomScrollbar.concat.min.js')}}"></script>
<script src="{{URL::asset('admin_assets/plugins/sidebar/sidebar-custom.js')}}"></script>
<!-- Eva-icons js -->
<script src="{{URL::asset('admin_assets/js/eva-icons.min.js')}}"></script>
@yield('js')
<!-- Sticky js -->
@if (\Route::currentRouteName() != 'login.show')
    <script src="{{URL::asset('admin_assets/js/sticky.js')}}"></script>
@endif
<!-- custom js -->
<script src="{{URL::asset('admin_assets/js/custom.js')}}"></script><!-- Left-menu js-->
<script src="{{URL::asset('admin_assets/plugins/side-menu/sidemenu.js')}}"></script>
@include('sweetalert::alert')