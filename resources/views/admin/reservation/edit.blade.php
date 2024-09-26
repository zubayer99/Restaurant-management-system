@extends('admin.layout')
@section('title','Reservation')
@section('content')

<!-- Content Header (Page header) -->
@component('admin.components.content-header',['breadcrumb'=>['Dashboard'=>'admin/dashboard','Reservation'=>'admin/reservation']])
    @slot('title') Edit Reservation @endslot
 <!--    @slot('add_btn')  @endslot -->
    @slot('active') Edit Reservation @endslot
@endcomponent
<!-- /.content-header -->
<!-- Basic Validation -->
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>Reservation Details</h2>
            </div>
            <div class="body">
                <form class="form-horizontal" id="editReservation" method="POST">
                    @csrf
                    {{ method_field('PUT') }}
                    @if($reservation)
                    <input type="hidden" class="url" value="{{url('admin/reservation/'.$reservation->reservation_id)}}" >
                    <div class="row clearfix">
                        <div class="col-md-offset-1 col-md-5">
                            <label for="email_address">Table</label>
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" class="form-control"  value="{{ App\Models\TableList::where('table_id',$reservation->table_id)->pluck('table_name')->first(); }}" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-offset-1 col-sm-5">
                            <label for="email_address">Number of Person</label>
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="number" class="form-control" value="{{$reservation->number_of_person}}" readonly placeholder="Enter your Table Number">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row clearfix">
                    <div class="col-md-offset-1 col-md-4">
                        <b>Date</b>
                        <div class="input-group">
                            <div class="form-line">
                                <input type="date" class="form-control date" readonly value="{{$reservation->date }}" placeholder="Please Enter Your Date">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <b>Start Time</b>
                        <div class="input-group">
                            <div class="form-line">
                                <input type="time" class="form-control" readonly value="{{$reservation->start_time}}" placeholder="Please Enter Start Time">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <b>End Time </b>
                        <div class="input-group">
                            <div class="form-line">
                                <input type="time" class="form-control" name="end_time" value="{{$reservation->end_time}}" placeholder="Please Enter End Time">
                            </div>
                        </div>
                    </div>
                    <div class="row clearfix">
                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                            <label>Customer Name <small class="text-danger">*</small></label>
                        </div>
                        <div class="col-lg-4 col-md-10 col-sm-8 col-xs-7">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" name="customer_name" class="form-control" value="{{$reservation->customer_name}}" placeholder="Enter your Customer Name">
                                    <input type="hidden" name="customer_id"  value="{{$reservation->customer_id}}">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                            <label>Phone Number <small class="text-danger">*</small></label>
                        </div>
                        <div class="col-lg-4 col-md-10 col-sm-8 col-xs-7">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" class="form-control mobile-phone-number" value="{{$reservation->phone}}" name="phone" placeholder="Ex: +00 (000) 000-00-00">
                                    <input type="hidden" name="customer_id"  value="{{$reservation->customer_id}}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row clearfix">
                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                            <label>Email Address</label>
                        </div>
                        <div class="col-lg-4 col-md-10 col-sm-8 col-xs-7">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" name="email" class="form-control" value="{{$reservation->email}}" placeholder="Enter your email address">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                            <label>Status <small class="text-danger">*</small></label>
                        </div>
                        <div class="col-lg-4 col-md-10 col-sm-8 col-xs-7">
                            <div class="form-group" >
                                <div class="form-line">
                                    <select class="form-control" name="status" required>
                                        <option value="" disabled>-- Select Status --</option>
                                        <option value="1" {{ ($reservation->status == "1" ? "selected":"") }}>Booked</option>
                                        <option value="0" {{ ($reservation->status == "0" ? "selected":"") }}>Free</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row clearfix">
                        <div class="col-lg-offset-2 col-md-offset-2 col-sm-offset-4 col-xs-offset-5">
                            <button class="btn bg-red waves-effect" type="submit">UPDATE</button>
                        </div>
                    </div>
                    @endif
                </form>
            </div>
        </div>
    </div>
</div>
<!-- #END# Basic Validation -->
@stop  

