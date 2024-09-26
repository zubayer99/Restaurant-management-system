@extends('admin.layout')
@section('title','Reservation')
@section('content')

<!-- Content Header (Page header) -->
@component('admin.components.content-header',['breadcrumb'=>['Dashboard'=>'admin/dashboard']])
    @slot('title') Reservation @endslot
    @slot('active') Reservation @endslot
@endcomponent
<!-- /.content-header -->
<!-- show data table -->
@component('admin.components.data-table',['thead'=>
    ['S.No.','Customer Name','Table Name','No. OF Person','Date','From Time','To Time','status','Action']
])
@slot('table_id') reservation-list @endslot
@slot('add_name') Reservation @endslot
@slot('add_btn') <a href="{{url('admin/reservation/create')}}" class="btn bg-red waves-effect">Add New</a>@endslot
@endcomponent
@stop  
@section('pageJsScripts')
<script src="{{asset('public/assets/js/modals.js')}}"></script>
<!-- Jquery DataTable Plugin Js -->
<script src="{{asset('public/assets/js/jquery.dataTables.js')}}"></script>
<script src="{{asset('public/assets/js/dataTables.bootstrap.js')}}"></script>
<script type="text/javascript">
    var table = $("#reservation-list").DataTable({
        processing: true,
        serverSide: true,
        ajax: 'reservation',
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'customer_name', name: 'customer_name'},
            {data: 'table_name', name: 'name'},
            {data: 'number_of_person', name: 'number_of_person'},
            {data: 'date', name: 'date'},
            {data: 'start_time', name: 'from time'},
            {data: 'end_time', name: 'to time'},
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