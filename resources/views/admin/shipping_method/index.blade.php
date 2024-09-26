@extends('admin.layout')
@section('title','Shipping Method')
@section('content')

<!-- Content Header (Page header) -->
@component('admin.components.content-header',['breadcrumb'=>['Dashboard'=>'admin/dashboard']])
    @slot('title') Shipping Method @endslot
    @slot('active') Shipping Method @endslot
@endcomponent
<!-- /.content-header -->
<!-- show data table -->
@component('admin.components.data-table',['thead'=>
    ['S.No.','Shipping Name','Shipping Price','Status','Action']
])
@slot('table_id') shipping-list @endslot
@slot('add_name') Shipping Method @endslot
@slot('add_btn') <button type="button" data-color="blue-grey" data-toggle="modal" data-target="#defaultModal" class="btn bg-blue-grey waves-effect">Add New</button> 
@endslot
@endcomponent
<!-- For Material Design Colors -->
<div class="modal fade" id="defaultModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document" >
        <div class="modal-content">
            <!-- Basic Validation -->
            <form id="addShipping" method="POST" >
                <input type="text" hidden class="url" value="{{url('admin/shipping_method')}}">
                <div class="modal-header">
                    <h4 class="modal-title" id="defaultModalLabel">Add Shipping Method</h4>
                </div>
                <div class="modal-body">
                    <div class="row clearfix">
                        <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                            <label>Shipping Name </label>
                        </div>
                        <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" class="form-control" name="shipping_name" placeholder="Enter Method Name">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row clearfix">
                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                            <label>Price</label>
                        </div>
                        <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                            <div class="input-group">
                                <div class="form-line">
                                    <input type="number" name="shipping_price" class="form-control" placeholder="Enter Method Price">
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
                        <button class="btn btn-primary waves-effect" type="submit">SUBMIT</button>
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
            <form id="editShipping" method="POST" >
                 <div class="modal-header">
                    <h4 class="modal-title" id="defaultModalLabel">Edit Shipping Method</h4>
                </div>
                <div class="modal-body">
                    @csrf
                    {{ method_field('PUT') }}
                    <input type="hidden" name="id" class="shipping_id">
                    <input type="text" hidden class="u-url" value="{{url('admin/shipping_method')}}">
                    <div class="row clearfix">
                        <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                            <label>Shipping Name </label>
                        </div>
                        <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" class="form-control" name="shipping_name" placeholder="Enter your Shipping Name">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row clearfix">
                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                            <label>Price</label>
                        </div>
                        <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                            <div class="input-group">
                                <div class="form-line">
                                    <input type="number" name="shipping_price" class="form-control" placeholder="Enter Ypur Shipping Method Price">
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
                        <button class="btn btn-primary waves-effect" type="submit">UPDATE</button>
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
    var table = $("#shipping-list").DataTable({
        processing: true,
        serverSide: true,
        ajax: 'shipping_method',
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'shipping_name', name: 'shipping_name'},
            {data: 'shipping_price', name: 'shipping_price'},
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