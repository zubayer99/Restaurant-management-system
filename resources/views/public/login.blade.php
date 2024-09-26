@extends('public.layout.master')
@section('title',$siteInfo->app_title)
@section('content')
<article id="main-content">
    <div class="page-header">
        <div class="container">
            <div class="row">
                <div class="col">
                    <h2 class="section-sub-heading">Login</h2>
                    <nav aria-label="breadcrumb" class="breadcrumb-nav">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Login</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <section id="contact-form" class="py-5">
        <div class="container">
            <div class="row">
                <div class="col">
                    <h2 class="section-heading text-center">Login</h2>
                    <h3 class="section-sub-heading text-center">Welcome back</h3>
                </div>
            </div>
            <form class="row position-relative" method="POST" id="user-login">
                @csrf
                <div class="form-group col-md-4 offset-md-4 mb-4">
                    <input type="email" class="form-control" name="user_name" placeholder="Email Address">
                </div>
                <div class="form-group col-md-4 offset-md-4 mb-4">
                    <input type="password" class="form-control" name="user_password" placeholder="Password">
                </div>
                <div class="form-group col-md-4 offset-md-4 mb-3 d-flex flex-row justify-content-between">
                    <a href="{{url('forgot-password')}}" class="align-self-center">Forgot password?</a>
                    <input type="submit" class="btn link-button" name="submit" value="Login">
                </div>
                <div class="text-center">
                    <span>Don't have an account? <a href="{{url('/signup')}}">Signup</a></span>
                </div>
            </form>
        </div>
    </section>
</article>
@stop