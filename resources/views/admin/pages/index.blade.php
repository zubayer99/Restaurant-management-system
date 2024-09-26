@extends('admin.layout')
@section('title','Pages')
@section('content')

<!-- Content Header (Page header) -->
@component('admin.components.content-header',['breadcrumb'=>['Dashboard'=>'admin/dashboard']])
    @slot('title') Pages @endslot
    @slot('active') Pages @endslot
@endcomponent
<!-- /.content-header -->
<!-- show data table -->
@component('admin.components.data-table',['thead'=>
    ['S.No.','Title','Action']
])
@slot('table_id') page-list @endslot
@slot('add_name') Pages @endslot
@slot('add_btn') <a href="{{url('admin/pages/create')}}" class="btn bg-red waves-effect">Add New</a> 
@endslot
@endcomponent

</div>
</section>
@stop  
@section('pageJsScripts')
<script src="{{asset('public/assets/js/modals.js')}}"></script>
<!-- Jquery DataTable Plugin Js -->
<script src="{{asset('public/assets/js/jquery.dataTables.js')}}"></script>
<script src="{{asset('public/assets/js/dataTables.bootstrap.js')}}"></script>
<script type="text/javascript">
    var table = $("#page-list").DataTable({
        processing: true,
        serverSide: true,
        ajax: 'pages',
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'title', name: 'title'},
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