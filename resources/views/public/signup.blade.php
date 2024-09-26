@extends('public.layout.master')
@section('title',$siteInfo->app_title)
@section('content')
<article id="main-content">
    <div class="page-header">
        <div class="container">
            <div class="row">
                <div class="col">
                    <h2 class="section-sub-heading">Signup</h2>
                    <nav aria-label="breadcrumb" class="breadcrumb-nav">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Signup</li>
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
                    <h2 class="section-heading text-center">Signup</h2>
                    <h3 class="section-sub-heading text-center">Create Account</h3>
                </div>
            </div>
            <form class="row position-relative" method="POST" id="user-signup">
                @csrf
                <div class="form-group col-md-4 offset-md-2 mb-4">
                    <input type="text" class="form-control" name="name" placeholder="Full Name">
                </div>
                <div class="form-group col-md-4 mb-4">
                    <input type="email" class="form-control" name="email" placeholder="Email Address">
                </div>
                <div class="form-group col-md-4 offset-md-2 mb-4">
                    <input type="number" class="form-control" name="phone" placeholder="Phone Number">
                </div>
                <div class="form-group col-md-4 mb-4">
                    <input type="password" class="form-control" name="password" placeholder="Password">
                </div>
                <div class="form-group col-md-8 offset-md-2 mb-4">
                    <textarea name="address" class="form-control" placeholder="Address"></textarea>
                </div>
                <div class="form-group col-md-12 mb-3 text-center">
                    <input type="submit" class="btn link-button" name="submit" value="Signup">
                </div>
                <div class="text-center">
                    <span>Already have as account? <a href="{{url('login')}}">Login</a></span>
                </div>
            </form>
        </div>
    </section>
</article>
@stop