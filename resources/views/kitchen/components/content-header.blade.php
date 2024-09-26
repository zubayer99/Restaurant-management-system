<section class="content">
<div class="container-fluid" id="app">
    <div class="header">
        <ol class="breadcrumb breadcrumb-col-orange align-right">
            @foreach($breadcrumb as $key => $value)
            <li><a href="{{url($value)}}">{{$key}}</a></li>
            @endforeach
            <li class="active">{{$active}}</li>
        </ol>
    </div>