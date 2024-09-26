@extends('admin.layout')
@section('title','City')
@section('content')

<!-- Content Header (Page header) -->
@component('admin.components.content-header',['breadcrumb'=>['Dashboard'=>'admin/dashboard']])
    @slot('title') City @endslot
    @slot('active') City @endslot
@endcomponent
<!-- /.content-header -->
<!-- show data table -->
@component('admin.components.data-table',['thead'=>
    ['S.No.','City Name','State','Action']
])
@slot('table_id') city-list @endslot
@slot('add_name') City @endslot
@slot('add_btn') <button type="button" data-color="blue-grey" data-toggle="modal" data-target="#defaultModal" class="btn bg-red waves-effect">Add New</button> 
@endslot
@endcomponent

<!-- For Material Design Colors -->
<div class="modal fade" id="defaultModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document" >
        <div class="modal-content">
            <!-- Basic Validation -->
            <form id="addCity" method="POST" >
                <div class="modal-header">
                    <h4 class="modal-title" id="defaultModalLabel">Add City</h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" class="url" value="{{url('admin/city')}}" >
                    <div class="row clearfix">
                        <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                            <label>State Name </label>
                        </div>
                        <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                            <div class="form-group">
                                <div class="form-line">
                                    <select class="form-control" name="state" required>
                                        <option value="" disabled>-- Select State --</option>
                                        @if(!empty($state))
                                            @foreach($state as $types)
                                            <option value="{{$types->state_id}}">{{$types->state_name}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row clearfix">
                        <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                            <label>City Name </label>
                        </div>
                        <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" class="form-control" name="city_name" placeholder="Enter your City Name">
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
            <form id="editCity" method="POST" >
                 <div class="modal-header">
                    <h4 class="modal-title" id="defaultModalLabel">Edit City</h4>
                </div>
                <div class="modal-body">
                    @csrf
                    {{ method_field('PUT') }}
                    <input type="hidden" name="city_id" class="city">
                    <input type="hidden" class="u-url" value="{{url('admin/city')}}">
                    <div class="row clearfix">
                        <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                            <label>State Name </label>
                        </div>
                        <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                            <div class="form-group">
                                <div class="form-line">
                                    <select class="form-control" name="state" required>
                                        <option value="" disabled>-- Select State --</option>
                                        @if(!empty($state))
                                            @foreach($state as $types)
                                               <option value="{{$types->state_id}}">{{$types->state_name}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row clearfix">
                        <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                            <label>city Name </label>
                        </div>
                        <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" class="form-control" name="city_name" placeholder="Enter your City Name">
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
    var table = $("#city-list").DataTable({
        processing: true,
        serverSide: true,
        ajax: 'city',
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'city_name', name: 'city_name'},
            {data: 'state', name: 'state'},
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