@extends('admin.layout')
@section('title','Banners')
@section('content')

<!-- Content Header (Page header) -->
@component('admin.components.content-header',['breadcrumb'=>['Dashboard'=>'admin/dashboard']])
    @slot('title') Banners @endslot
    @slot('active') Banners @endslot
@endcomponent
<!-- /.content-header -->
<!-- show data table -->
@component('admin.components.data-table',['thead'=>
    ['S.No.','Image','Title','Status','Action']
])
@slot('table_id') banner-list @endslot
@slot('add_name') Banner List @endslot
@slot('add_btn') <a href="{{url('admin/banners/create')}}"  class="btn bg-red waves-effect">Add New</a>@endslot
@endcomponent
@stop  
@section('pageJsScripts')
<script src="{{asset('assets/js/modals.js')}}"></script>
<!-- Jquery DataTable Plugin Js -->
<script src="{{asset('public/assets/js/jquery.dataTables.js')}}"></script>
<script src="{{asset('public/assets/js/dataTables.bootstrap.js')}}"></script>
<script type="text/javascript">
    var table = $("#banner-list").DataTable({
        processing: true,
        serverSide: true,
        ajax: 'banners',
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'image', name: 'image'},
            {data: 'title', name: 'title'},
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