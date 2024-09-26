@extends('admin.layout')
@section('title','ManageFood')
@section('content')

<!-- Content Header (Page header) -->
@component('admin.components.content-header',['breadcrumb'=>['Dashboard'=>'admin/dashboard']])
    @slot('title') Manage Food @endslot
    @slot('active') Manage Food @endslot
@endcomponent
<!-- /.content-header -->
<!-- show data table -->
@component('admin.components.data-table',['thead'=>
    ['S.No.','Image','Food Name','Category','status','Action']
])
@slot('table_id') food-list @endslot
@slot('add_name') Manage Food @endslot
@slot('add_btn') <a href="{{url('admin/manage_food/create')}}" class="btn bg-red waves-effect">Add New</a>@endslot
@endcomponent
@stop  
@section('pageJsScripts')
<script src="{{asset('public/assets/js/modals.js')}}"></script>
<!-- Jquery DataTable Plugin Js -->
<script src="{{asset('public/assets/js/jquery.dataTables.js')}}"></script>
<script src="{{asset('public/assets/js/dataTables.bootstrap.js')}}"></script>
<script type="text/javascript">
    var table = $("#food-list").DataTable({
        processing: true,
        serverSide: true,
        ajax: 'manage_food',
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'image', name: 'image'},
            {data: 'food_name', name: 'food_name'},
            {data: 'category', name: 'category'},
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