<!-- Basic Examples -->
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2> {{$add_name}} </h2>                       
                <ul class="header-dropdown m-r--5">
                    <li class="dropdown">
                       {{$add_btn}}
                    </li>
                </ul>
            </div>
            <div class="body">
                <div class="table-responsive">
                    <table id="{{$table_id}}" class="table table-bordered table-striped table-hover js-basic-example dataTable">
                        <thead>
                            <tr>
                                @foreach($thead as $th)
                                <th>{{$th}}</th>
                                @endforeach
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                @foreach($thead as $th)
                                <th>{{$th}}</th>
                                @endforeach
                            </tr>
                        </tfoot>
                        <tbody></tbody>    
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- #END# Basic Examples -->
