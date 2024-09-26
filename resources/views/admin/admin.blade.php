<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login > {{$siteInfo->app_title}}</title>
     <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">
    <!-- Bootstrap Core Css -->
    <link rel="stylesheet" href="{{asset('public/assets/css/bootstrap.css')}}">
    <!-- Waves Effect Css -->
    <link rel="stylesheet" href="{{asset('public/assets/css/waves.css')}}">
    <!-- Animation Css -->
    <link rel="stylesheet" href="{{asset('public/assets/css/animate.css')}}">
    <!-- Sweetalert -->
  <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.1/dist/sweetalert2.min.css" rel="stylesheet">
    <!-- Custom Css -->
    <link rel="stylesheet" href="{{asset('public/assets/css/style.css')}}">
  </head>
<body class="login-page" >
    <div class="login-box" id="login">
    
        <div class="logo bg-red">
            <a href="javascript:void(0);">{{$siteInfo->app_title}}</b></a>
        </div>
        <div class="card">
            <div class="body">
                <form id="adminLogin" method="POST">
                    @csrf
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">person</i>
                        </span>
                        <div class="form-line">
                            <input type="text" class="form-control" name="username" placeholder="Username" required autofocus autocomplete="off">
                        </div>
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">lock</i>
                        </span>
                        <div class="form-line">
                            <input type="password" class="form-control" name="password" placeholder="Password" required autocomplete="off">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-offset-4 col-xs-4">
                            <input type="submit" class="btn btn-block bg-red waves-effect" value="Log In" />
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <input type="text" id="url" hidden value="{{url('/')}}">
    <!-- Jquery Core Js -->
    <script src="{{asset('public/assets/js/jquery.min.js')}}"></script>
    <!-- Bootstrap Core Js -->
    <script src="{{asset('public/assets/js/bootstrap.js')}}"></script>
    <!-- Waves Effect Plugin Js -->
    <script src="{{asset('public/assets/js/waves.js')}}"></script>
    <!-- Validation Plugin Js -->
    <script src="{{asset('public/assets/js/jquery.validate.js')}}"></script>
    <!-- Sweetalert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.1/dist/sweetalert2.all.min.js"></script>
    <!-- Custom Js -->
    <script src="{{asset('public/assets/js/admin.js')}}"></script>
    <script src="{{asset('public/assets/js/adminLogin.js')}}"></script>
    </body>
</html>
