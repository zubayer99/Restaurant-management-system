<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Kitchen > {{$siteInfo->app_title}}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
     <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">
    <!-- Bootstrap Core Css -->
    <link rel="stylesheet" href="{{asset('public/assets/css/bootstrap.css')}}">
    <!-- Waves Effect Css -->
    <link rel="stylesheet" href="{{asset('public/assets/css/waves.css')}}">
    <!-- Animation Css -->
    <link rel="stylesheet" href="{{asset('public/assets/css/animate.css')}}">
    <!-- Bootstrap Select Css -->
    <link rel="stylesheet" href="{{asset('public/assets/css/bootstrap-select.css')}}">
    <!-- JQuery DataTable Css -->
    <link rel="stylesheet" href="{{asset('public/assets/css/dataTables.bootstrap.css')}}">
    <!-- Sweetalert -->
  <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.1/dist/sweetalert2.min.css" rel="stylesheet">
    <!-- Custom Css -->
    <link rel="stylesheet" href="{{asset('public/assets/css/style.css')}}">
</head>
<body>
    <!-- Overlay For Sidebars -->
    <div class="overlay"></div>
    <!-- #END# Overlay For Sidebars -->
    <!-- Search Bar -->
    <div class="search-bar">
        <div class="search-icon">
            <i class="material-icons">search</i>
        </div>
        <input type="text" placeholder="START TYPING...">
        <div class="close-search">
            <i class="material-icons">close</i>
        </div>
    </div>
    <!-- #END# Search Bar -->
    <!-- Top Bar -->
    <nav class="navbar" style="background:#2196F3;">
        <div class="container-fluid">
            <div class="navbar-header">
                <a href="javascript:void(0);" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false"></a>
                <a href="javascript:void(0);" class="bars"></a>
                <a class="navbar-brand" href="{{url('kitchen/dashboard')}}">{{$siteInfo->app_title}}</a>
            </div>
            
        </div>
    </nav>
    <!-- #Top Bar -->