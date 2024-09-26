@extends('admin.layout')
@section('title','PosInvoice')
@section('content')

<!-- Content Header (Page header) -->
@component('admin.components.content-header',['breadcrumb'=>['Dashboard'=>'admin/dashboard']])
    @slot('title') Order List @endslot
    @slot('active') Order List @endslot
@endcomponent
<!-- /.content-header -->
<!-- show data table -->
@component('admin.components.data-table',['thead'=>
    ['S.No.','Invoice No.','Customer Name','Table','Status','Order Date','Action']
])
@slot('table_id') Order-list @endslot
@slot('add_name') Order List @endslot
@slot('add_btn')
<a href="{{url('admin/order_list/create')}}" class="btn bg-red waves-effect">Add New</a> @endslot
@endcomponent
@stop  
@section('pageJsScripts')
<script src="{{asset('public/assets/js/modals.js')}}"></script>
<!-- Jquery DataTable Plugin Js -->
<script src="{{asset('public/assets/js/jquery.dataTables.js')}}"></script>
<script src="{{asset('public/assets/js/dataTables.bootstrap.js')}}"></script>
<script type="text/javascript">
    var table = $("#Order-list").DataTable({
        processing: true,
        serverSide: true,
        ajax: 'order_list',
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'id', name: 'order_id'},
            {data: 'customer_name', name: 'customer_id'},
            {data: 'table_name', name: 'table_id'},
            {data: 'status', name: 'food_status'},
            {data: 'created_at', name: 'created_at'},
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