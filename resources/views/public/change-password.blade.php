@extends('public.layout.master')
@section('title',$siteInfo->app_title)
@section('content')
<article id="main-content">
    <div class="page-header">
        <div class="container">
            <div class="row">
                <div class="col">
                    <h2 class="section-sub-heading">Change Password</h2>
                    <nav aria-label="breadcrumb" class="breadcrumb-nav">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Change Password</li>
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
                    <!-- <h2 class="section-heading text-center">Change Passwordf</h2> -->
                    <h3 class="section-sub-heading text-center">Change Password</h3>
                </div>
            </div>
            <form class="row position-relative" method="POST" id="change-password">
                @csrf
                <div class="form-group col-md-4 offset-md-4 mb-4">
                    <label for="">Old Password</label>
                    <input type="password" class="form-control" name="old" placeholder="Old Password">
                </div>
                <div class="form-group col-md-4 offset-md-4 mb-4">
                    <label for="">New Password</label>
                    <input type="password" class="form-control" name="new" id="password" placeholder="New Password">
                </div>
                <div class="form-group col-md-4 offset-md-4 mb-4">
                    <label for="">Confirm Password</label>
                    <input type="password" class="form-control" name="confirm" placeholder="Confirm Password">
                </div>
                <div class="form-group col-md-12 mb-3 text-center">
                    <input type="submit" class="btn link-button" name="submit" value="Update">
                </div>
            </form>
        </div>
    </section>
</article>
@stop