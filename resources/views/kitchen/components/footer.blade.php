<input type="text" id="url" hidden value="{{url('/')}}" hidden>
    <!-- Jquery Core Js -->
    <script src="{{asset('public/assets/js/jquery.min.js')}}"></script>
    <!-- Bootstrap Core Js -->
    <script src="{{asset('public/assets/js/bootstrap.js')}}"></script>
    <!-- Select Plugin Js -->
    <script src="{{asset('public/assets/js/bootstrap-select.js')}}"></script>
    <!-- Slimscroll Plugin Js -->
    <script src="{{asset('public/assets/js/jquery.slimscroll.js')}}"></script>
    <!-- Waves Effect Plugin Js -->
    <script src="{{asset('public/assets/js/waves.js')}}"></script>
    <!-- Validation Plugin Js -->
    <script src="{{asset('public/assets/js/jquery.validate.js')}}"></script>
    <!-- Custom Js -->
    <script src="{{asset('public/assets/js/admin.js')}}"></script>
    <script src="{{asset('public/assets/js/sign-in.js')}}"></script>
    <script src="{{asset('public/assets/js/form-validation.js')}}"></script>
    <!-- Sweetalert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.1/dist/sweetalert2.all.min.js"></script>
    <!--Vue Js -->
    <script src="{{asset('public/assets/js/kitchenLogin.js')}}"></script> 
    @yield('pageJsScripts')
</body>
</html>