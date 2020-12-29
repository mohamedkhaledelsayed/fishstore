<!-- ============================================================== -->
<!-- footer -->
<!-- ============================================================== -->
<footer class="footer text-center">
    All Rights Reserved by Yisweb. Designed and Developed by
    <a href="https://yisweb.com">Yisweb</a>.
</footer>
<!-- ============================================================== -->
<!-- End footer -->
<!-- ============================================================== -->
</div>
<!-- ============================================================== -->
<!-- End Page wrapper  -->
<!-- ============================================================== -->
</div>
<!-- ============================================================== -->
<!-- End Wrapper -->
<!-- ============================================================== -->

<!-- ============================================================== -->
<!-- All Jquery -->
<!-- ============================================================== -->
<script src="{{url('admin')}}/assets/libs/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap tether Core JavaScript -->
<script src="{{url('admin')}}/assets/libs/popper.js/dist/umd/popper.min.js"></script>
<script src="{{url('admin')}}/assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- apps -->
<script src="{{url('admin')}}/dist/js/app.js"></script>
<script src="{{url('admin')}}/dist/js/app.init.mini-sidebar.js"></script>
<script src="{{url('admin')}}/dist/js/app-style-switcher.js"></script>
<!-- slimscrollbar scrollbar JavaScript -->
<script src="{{url('admin')}}/assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"></script>
<script src="{{url('admin')}}/assets/extra-libs/sparkline/sparkline.js"></script>
<!--Wave Effects -->
<script src="{{url('admin')}}/dist/js/waves.js"></script>
<!--Menu sidebar -->
<script src="{{url('admin')}}/dist/js/sidebarmenu.js"></script>
<script src="{{asset('admin/assets/libs/select2/dist/js/select2.min.js')}}"></script>

<script src="{{asset('admin/assets/libs/sweetalert2/dist/sweetalert2.min.js')}}"></script>
<script src="{{asset('admin/dist/js/mo.min.js')}}"></script>
<script src="{{asset('admin/dist/js/noty.js')}}"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDfQvN9BWujp6jNh8M3hjo6Odrc3j5x91M&libraries=places"></script>
<script src="{{asset('admin/jquery.locationpicker.js')}}"></script>
<script src="{{asset('admin/dist/js/tagsinput.js')}}"></script>

<script src="{{asset('admin/dist/js/slimselect.min.js')}}"></script>


{{--<script src="{{asset('admin/dist/js/geo/geocomplete.js')}}"></script>--}}
<!--Custom JavaScript -->
<script src="{{url('admin')}}/dist/js/custom.min.js"></script>
{{--<script src="{{url('admin')}}/dist/js/tagsinput.js"></script>--}}

<script>
    let csrfToken = '{{csrf_token()}}',
        adminUrl = '{{route("admin.home")}}';
    window.translations  =  {!! Cache::get('translations') !!};
</script>

<script src="{{url('admin')}}/my.js"></script>
<script src="{{url('admin')}}/search.in.table.js"></script>
@stack('js')
</html>
