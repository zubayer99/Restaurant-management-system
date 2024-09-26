@extends('admin.layout')
@section('title','Reservation')
@section('content')

<!-- Content Header (Page header) -->
@component('admin.components.content-header',['breadcrumb'=>['Dashboard'=>'admin/dashboard','Reservation'=>'admin/reservation']])
    @slot('title') Add Reservation @endslot
 <!--    @slot('add_btn')  @endslot -->
    @slot('active') Add Reservation @endslot
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
                <form class="form-horizontal" id="CheckReservation" method="POST"> 
                    @csrf
                    <div class="row clearfix">
                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                            <label>Date</label>
                        </div>
                        <div class="col-lg-4 col-md-10 col-sm-8 col-xs-7">
                            <div class="input-daterange input-group">
                                <div class="form-line">
                                    <input type="date" class="form-control time12 date" name="date" value="{{date('Y-m-d')}}" placeholder="Date">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                            <label>No. oF Person</label>
                        </div>
                        <div class="col-lg-4 col-md-10 col-sm-8 col-xs-7">
                            <div class="input-daterange input-group">
                                <div class="form-line">
                                    <input type="number" name="person"  class="form-control no_person" placeholder="Enter your Number OF Person">
                                </div>
                            </div>
                        </div>
                    </div> 
                    <div class="row clearfix">
                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                            <label>Time</label>
                        </div>
                        <div class="col-lg-4 col-md-10 col-sm-8 col-xs-7">
                            <div class="input-daterange input-group" >
                                <div class="form-line">
                                    <input type="time" class="form-control time12 start_time" value="{{date('h:i')}}" name="time" placeholder="Time">
                                </div>
                            </div>
                        </div>
                        
                    </div>
                    <div class="row clearfix">
                        <div class="col-lg-offset-2 col-md-offset-2 col-sm-offset-4 col-xs-offset-5">
                            <button class="btn bg-red waves-effect">Check Availability</button>
                        </div>
                    </div>
                    <div class="row clearfix">
                        <div class="col-md-offset-2 col-md-10 col-sm-10">
                            <div class="availabletable"></div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- For Material Design Colors -->
        <div class="modal fade" id="defaultModal" data-backdrop="static" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document" >
                <table class="table"> 
                    <div class="modal-content">
                        <!-- Basic Validation -->
                        <form id="addReservation" method="POST" >
                            <div class="modal-header">
                                <h4 class="modal-title" id="defaultModalLabel">Add Reservation</h4>
                            </div>
                            <div class="modal-body">
                                <input type="hidden" class="url" value="{{url('admin/reservation/table_id')}}" >
                                <input type="hidden" class="rdt-url" value="{{url('admin/reservation')}}" >
                                <div class="row clearfix">
                                    <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                                        <label>Table Number <small class="text-danger">*</small></label>
                                    </div>
                                    <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" class="form-control" name="table" readonly >
                                                <input type="text" hidden name="table_no">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                                        <label>Persons <small class="text-danger">*</small></label>
                                    </div>
                                    <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" class="form-control" readonly name="no_person" >
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                                        <label>Date <small class="text-danger">*</small></label>
                                    </div>
                                    <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" class="form-control" readonly name="date" >
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                                        <label>Start Time <small class="text-danger">*</small></label>
                                    </div>
                                    <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="time" class="form-control" readonly name="start_time" >
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                                        <label>End Time <small class="text-danger">*</small></label>
                                    </div>
                                    <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="time" class="form-control" name="end_time" >
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                                        <label>Customer Name <small class="text-danger">*</small></label>
                                    </div>
                                    <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" class="form-control" name="c_name" placeholder="Customer Name">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                                        <label>Phone Number <small class="text-danger">*</small></label>
                                    </div>
                                    <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                                        <div class="input-group demo-masked-input">
                                            <div class="form-line">
                                                <input type="text" class="form-control mobile-phone-number" name="c_phone" placeholder="Ex: +00 (000) 000-00-00">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="message-box"></div>
                                <!-- #END# Basic Validation -->
                                <div class="modal-footer">
                                    <input type="submit" class="btn bg-red" value="Submit">
                                    <!-- <button class="btn bg-red waves-effect" type="submit">SUBMIT</button> -->
                                    
                                </div>
                            </div>
                        </form>
                    </div>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- #END# Basic Validation -->
@stop 
@section('pageJsScripts')
<script type="text/javascript"> 
  //Mobile Phone Number
    $('.mobile-phone-number').inputmask('+99 (999) 999-99-99', { placeholder: '+__ (___) ___-__-__' });
</script>
@stop 