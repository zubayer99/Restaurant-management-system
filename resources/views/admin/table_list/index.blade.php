@extends('admin.layout')
@section('title','Tables List')
@section('content')

<!-- Content Header (Page header) -->
@component('admin.components.content-header',['breadcrumb'=>['Dashboard'=>'admin/dashboard']])
    @slot('title') Tables List @endslot
    @slot('active') Tables List @endslot
@endcomponent
<!-- /.content-header -->
<!-- show data table -->
@component('admin.components.data-table',['thead'=>
    ['S.No.','Table Name','Capacity','Status','Action']
])
@slot('table_id') table-list @endslot
@slot('add_name') Tables List @endslot
@slot('add_btn') <button type="button" data-toggle="modal" data-target="#defaultModal" class="btn bg-red waves-effect">Add New</button>@endslot
@endcomponent
<!-- For Material Design Colors -->
<div class="modal fade" id="defaultModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document" >
        <div class="modal-content">
            <!-- Basic Validation -->
            <form id="addTable" method="POST" >
                <div class="modal-header">
                    <h4 class="modal-title" id="defaultModalLabel">Add Table List</h4>
                </div>
                <div class="modal-body">
                    <div class="row clearfix">
                        <input type="text" class="url" hidden value="{{url('/admin/table_list')}}">
                        <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                            <label>Table Name </label>
                        </div>
                        <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" class="form-control" name="table_name" placeholder="Enter Table Name">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row clearfix">
                        <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                            <label>Capacity</label>
                        </div>
                        <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="number" class="form-control" name="capacity" placeholder="Enter Capacity">
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
            <form id="editTable" method="POST" >
                 <div class="modal-header">
                    <h4 class="modal-title" id="defaultModalLabel">Edit Table List</h4>
                </div>
                <div class="modal-body">
                    @csrf
                    {{ method_field('PATCH') }}
                    <input type="hidden" class="url" value="{{url('/admin/table_list')}}">
                    <input type="hidden" name="id" class="table_id">
                    <div class="row clearfix">
                        <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                            <label>Table Name </label>
                        </div>
                        <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" class="form-control" name="table_name" placeholder="Enter Table Name">
                                </div>
                            </div>
                        </div>
                    </div>
                     <div class="row clearfix">
                        <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                            <label>Capacity</label>
                        </div>
                        <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="number" class="form-control" name="capacity" placeholder="Enter Capacity">
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
    var table = $("#table-list").DataTable({
        processing: true,
        serverSide: true,
        ajax: 'table_list',
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'table_name', name: 'table_name'},
            {data: 'capacity', name: 'capacity'},
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