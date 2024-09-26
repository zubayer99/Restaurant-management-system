@extends('admin.layout')
@section('title','Waiters')
@section('content')

<!-- Content Header (Page header) -->
@component('admin.components.content-header',['breadcrumb'=>['Dashboard'=>'admin/dashboard']])
    @slot('title') Waiters @endslot
    @slot('active') Waiters @endslot
@endcomponent
<!-- /.content-header -->
<!-- show data table -->
@component('admin.components.data-table',['thead'=>
    ['S.No.','Name','Email','Phone','Status','Action']
])
@slot('table_id') waiter-list @endslot
@slot('add_name') Waiters @endslot
@slot('add_btn') <a href="{{url('admin/waiters/create')}}" class="btn bg-red waves-effect">Add New</a>@endslot
@endcomponent
@stop  
@section('pageJsScripts')
<script src="{{asset('public/assets/js/modals.js')}}"></script>
<!-- Jquery DataTable Plugin Js -->
<script src="{{asset('public/assets/js/jquery.dataTables.js')}}"></script>
<script src="{{asset('public/assets/js/dataTables.bootstrap.js')}}"></script>
<script type="text/javascript">
    var table = $("#waiter-list").DataTable({
        processing: true,
        serverSide: true,
        ajax: 'waiters',
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'name', name: 'name'},
            {data: 'email', name: 'email'},
            {data: 'phone', name: 'phone'},
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