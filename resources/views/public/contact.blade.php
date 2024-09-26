@extends('public.layout.master')
@section('title',$siteInfo->app_title)
@section('content')
<article id="main-content">
    <div class="page-header">
        <div class="container">
            <div class="row">
                <div class="col">
                    <h2 class="section-sub-heading">Contact</h2>
                    <nav aria-label="breadcrumb" class="breadcrumb-nav">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Contact</li>
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
                    <h2 class="section-heading text-center">Message</h2>
                    <h3 class="section-sub-heading text-center">Send us Message</h3>
                </div>
            </div>
            <form class="row position-relative" method="POST" id="addContactUs">
                @csrf
                <div class="form-group col-md-6 mb-4">
                    <input type="text" class="form-control" name="name" placeholder="Name">
                </div>
                <div class="form-group col-md-6 mb-4">
                    <input type="email" class="form-control" name="email" placeholder="Email Address">
                </div>
                <div class="form-group col-md-6 mb-4">
                    <input type="number" class="form-control" name="phone" placeholder="Phone Number">
                </div>
                <div class="form-group col-md-6 mb-4">
                    <input type="text" class="form-control" name="webiste" placeholder="Website">
                </div>
                <div class="form-group col-md-12 mb-4">
                    <textarea name="message" class="form-control" placeholder="Write Message"></textarea>
                </div>
                <div class="form-group col-md-12 mb-3 text-center">
                    <input type="submit" class="btn link-button" name="submit" value="Send Us Message">
                </div>
            </form>
        </div>
    </section>
</article>
@stop