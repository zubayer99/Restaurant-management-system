<div class="container">
    <div class="row">
        <div class="col-md-12 text-center">
            <h4 class="section-sub-heading">Available Tables</h4>
        </div>
        @if($tables_list->isNotEmpty())
        @foreach($tables_list as $table)
        <div class="col-md-3 mb-3">
            @if(session()->has('customer_id'))
                <a href="{{url('add-reservation?persons='.$request['persons'].'&date='.$request['date'].'&time='.$request['time'].'&table='.$table->table_id)}}" class="table-box">
                    <h5>{{$table->table_name}}</h5>
                    <h6>Capacity : {{$table->capacity}}</h6>
                </a>
            @else
                <a href="{{url('login')}}" class="table-box">
                    <h5>{{$table->table_name}}</h5>
                    <h6>Capacity : {{$table->capacity}}</h6>
                </a>
            @endif
        </div>
        @endforeach
        @else
            <div class="col-12 text-center">
                <h2 class="text-secondary">Tables not Available.</h2>
            </div>
        @endif
    </div>
</div>