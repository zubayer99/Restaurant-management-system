@extends('admin.layout')
@section('title','Contact Query')
@section('content')

<!-- Content Header (Page header) -->
@component('admin.components.content-header',['breadcrumb'=>['Dashboard'=>'admin/dashboard']])
    @slot('title') Contact Query @endslot
    @slot('active') Contact Query @endslot
@endcomponent
<!-- /.content-header -->
<!-- show data table -->
@component('admin.components.data-table',['thead'=>
    ['S.No.','User','Message','Action']
])
@slot('table_id') message-list @endslot
@slot('add_name') Contact Query @endslot
@slot('add_btn') @endslot
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
    var table = $("#message-list").DataTable({
        processing: true,
        serverSide: true,
        ajax: 'contact-query',
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'user', name: 'user'},
            {data: 'message', name: 'message'},
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