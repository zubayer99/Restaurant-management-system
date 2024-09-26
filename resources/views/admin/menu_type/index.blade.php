@extends('admin.layout')
@section('title','MenuType')
@section('content')

<!-- Content Header (Page header) -->
@component('admin.components.content-header',['breadcrumb'=>['Dashboard'=>'admin/dashboard']])
    @slot('title') Menu Types @endslot
    @slot('active') Menu Types @endslot
@endcomponent
<!-- /.content-header -->
<!-- show data table -->
@component('admin.components.data-table',['thead'=>
    ['S.No.','Image','Menu Type','status','Action']
])
@slot('table_id') menu-list @endslot
@slot('add_name') Menu Types List @endslot
@slot('add_btn') <button type="button" data-color="blue-grey" data-toggle="modal" data-target="#defaultModal" class="btn bg-red waves-effect">Add New</button> 
@endslot
@endcomponent
<!-- For Material Design Colors -->
<div class="modal fade" id="defaultModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document" >
        <div class="modal-content">
            <!-- Basic Validation -->
            <form id="addMenu" method="POST">
                <div class="modal-header">
                    <h4 class="modal-title" id="defaultModalLabel">Add Menu Type</h4>
                </div>
                <div class="modal-body">
                    <div class="row clearfix">
                        <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                            <label>Name <span class="text-danger">*</span></label>
                        </div>
                        <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" class="form-control" name="menu_name" placeholder="Enter Menu Type">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row clearfix">
                        <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                            <label>Image</label>
                        </div>
                        <div class="col-lg-6 col-md-5 col-sm-4 col-xs-3">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="file" class="form-control" name="img"  placeholder="Enter your Image" onChange="readURL(this);">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-3">
                            <img id="image" src="{{asset('public/menu_type/default.png')}}" width="100px">
                        </div>
                    </div>
                    <div class="row clearfix">
                        <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                            <label>Status <span class="text-danger">*</span></label>
                        </div>
                        <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                            <div class="form-group">
                                <div class="form-line">
                                    <select class="form-control" name="status" required>
                                        <option value="" disabled>-- Select Status --</option>
                                        <option value="1">Active</option>
                                        <option value="2">Inactive</option>
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
<div class="modal fade" id="defaultInfo"  tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document" >
        <div class="modal-content">
            <form id="editMenu" method="POST" >
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
    var table = $("#menu-list").DataTable({
        processing: true,
        serverSide: true,
        ajax: 'menu_type',
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'image', name: 'image'},
            {data: 'menu_type', name: 'menu_type'},
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
<script type="text/javascript">
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#image').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]); // convert to base64 string
        }
    }
</script>   
@stop 