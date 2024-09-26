@extends('admin.layout')
@section('title','Category')
@section('content')

<!-- Content Header (Page header) -->
@component('admin.components.content-header',['breadcrumb'=>['Dashboard'=>'admin/dashboard']])
    @slot('title') All Categories @endslot
    @slot('active') Category @endslot
@endcomponent
<!-- /.content-header -->
<!-- show data table -->
@component('admin.components.data-table',['thead'=>
    ['S.No.','Image','Category Name','status','Action']
])
@slot('table_id') category-list @endslot
@slot('add_name') Category List @endslot
@slot('add_btn') <a href="{{url('admin/manage_category/create')}}"  class="btn bg-red waves-effect">Add New</a>@endslot
@endcomponent
@stop  
@section('pageJsScripts')
<script src="{{asset('assets/js/modals.js')}}"></script>
<!-- Jquery DataTable Plugin Js -->
<script src="{{asset('public/assets/js/jquery.dataTables.js')}}"></script>
<script src="{{asset('public/assets/js/dataTables.bootstrap.js')}}"></script>
<script type="text/javascript">
    var table = $("#category-list").DataTable({
        processing: true,
        serverSide: true,
        ajax: 'manage_category',
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'image', name: 'image'},
            {data: 'category_name', name: 'category_name'},
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