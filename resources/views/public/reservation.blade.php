@extends('public.layout.master')
@section('title',$siteInfo->app_title)
@section('content')
<article id="main-content">
    <div class="page-header">
        <div class="container">
            <div class="row">
                <div class="col">
                    <h2 class="section-sub-heading">Reservation</h2>
                    <nav aria-label="breadcrumb" class="breadcrumb-nav">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Reservation</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <section id="reservation-form" class="py-5">
        <div class="container">
            <div class="row">
                <div class="col">
                    <h3 class="section-heading text-center">Booking a table</h3>
                    <h4 class="section-sub-heading text-center">Make a Reservation</h4>
                    <form class="row bg-white position-relative" id="check-tables" method="POST">
                        @csrf
                        <div class="form-group col-md-4 mb-4">
                            <input type="number" class="form-control" name="persons" placeholder="Persons" required>
                        </div>
                        <div class="form-group col-md-4 mb-4">
                            <input type="date" class="form-control" name="date" value="{{date('Y-m-d')}}" required>
                        </div>
                        <div class="form-group col-md-4 mb-4">
                            <input type="time" class="form-control" name="time" value="{{date('h:i')}}" required >
                        </div>
                        <div class="form-group col-md-12 text-center">
                            <input type="submit" class="btn link-button" value="Check Availability">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <div class="available-tables py-5 position-relative">
        
    </div>
</article>
@stop