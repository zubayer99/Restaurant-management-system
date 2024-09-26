<section class="content">
<div class="container-fluid" id="app">
    <div class="block-header row">
        <h2 class="col-md-6">{{$title}}</h2> 
        <ol class="breadcrumb breadcrumb-col-orange align-right col-md-6">
            @foreach($breadcrumb as $key => $value)
            <li><a href="{{url($value)}}">{{$key}}</a></li>
            @endforeach
            <li class="active">{{$active}}</li>
        </ol>
    </div>