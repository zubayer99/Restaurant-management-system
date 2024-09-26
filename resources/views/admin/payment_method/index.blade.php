@extends('admin.layout')
@section('title','Payment Methods')
@section('content')

<!-- Content Header (Page header) -->
@component('admin.components.content-header',['breadcrumb'=>['Dashboard'=>'admin/dashboard']])
    @slot('title') Payment Methods @endslot
    @slot('active') Payment Methods @endslot
@endcomponent
<!-- /.content-header -->
<!-- show data table -->
@component('admin.components.data-table',['thead'=>
    ['S.No.','Payment Name','Status','Action']
])
@slot('table_id') payment-list @endslot
@slot('add_name') Payment Methods @endslot
@slot('add_btn') <button type="button" data-color="blue-grey" data-toggle="modal" data-target="#defaultModal" class="btn bg-red waves-effect">Add New</button> 
@endslot
@endcomponent
<!-- For Material Design Colors -->
<div class="modal fade" id="defaultModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document" >
        <div class="modal-content">
            <!-- Basic Validation -->
            <form id="addPayment" method="POST" >
                <div class="modal-header">
                    <h4 class="modal-title" id="defaultModalLabel">Add Payment Method</h4>
                </div>
                <div class="modal-body">
                    <div class="row clearfix">
                        <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                            <label>Payment Name </label>
                        </div>
                        <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" class="form-control" name="payment_name" placeholder="Enter your Payment Name">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row clearfix">
                        <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                            <label>Status</label>
                        </div>
                        <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                            <div class="form-group">
                                <div class="form-line">
                                    <select class="form-control" name="status" required>
                                        <option value="" disabled>-- Select Status --</option>
                                        <option value="1">Active</option>
                                        <option value="0">Inactive</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- #END# Basic Validation -->
                    <div class="modal-footer">
                        <button class="btn bg-red waves-effect" type="submit">SUBMIT</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- For Material Design Colors -->
<div class="modal fade" id="modal-info" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document" >
        <div class="modal-content">
            <form id="editPayment" method="POST" >
                 <div class="modal-header">
                    <h4 class="modal-title" id="defaultModalLabel">Edit Payment Method</h4>
                </div>
                <div class="modal-body">
                    @csrf
                    {{ method_field('PUT') }}
                    <input type="hidden" name="id" class="payment_id">
                    <div class="row clearfix">
                        <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                            <label>Payment Name </label>
                        </div>
                        <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" class="form-control" name="payment_name" placeholder="Enter your Payment Name">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row clearfix">
                        <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                            <label>Status</label>
                        </div>
                        <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                            <div class="form-group">
                                <div class="form-line">
                                    <select class="form-control" name="status" required>
                                        <option value="" disabled>-- Select Status --</option>
                                        <option value="1">Active</option>
                                        <option value="0">Inactive</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- #END# Basic Validation -->
                    <div class="modal-footer">
                        <button class="btn bg-red waves-effect" type="submit">UPDATE</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
</div>
</section>
@stop  
@section('pageJsScripts')
<script src="{{asset('public/assets/js/modals.js')}}"></script>
<!-- Jquery DataTable Plugin Js -->
<script src="{{asset('public/assets/js/jquery.dataTables.js')}}"></script>
<script src="{{asset('public/assets/js/dataTables.bootstrap.js')}}"></script>
<script type="text/javascript">
    var table = $("#payment-list").DataTable({
        processing: true,
        serverSide: true,
        ajax: 'payment_method',
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'payment_name', name: 'payment_name'},
            {data: 'status', name: 'status'},
            {
                data: 'action',
                name: 'action',
                orderable: true,
                searchable: true,
            }
        ]
    });
</script> 
@stop 