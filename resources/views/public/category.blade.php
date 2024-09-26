@extends('public.layout.master')
@section('title',$siteInfo->app_title)
@section('content')
<article id="main-content">
    <div class="page-header">
        <div class="container">
            <div class="row">
                <div class="col">
                    <h2 class="section-sub-heading">{{$name}}</h2>
                    <nav aria-label="breadcrumb" class="breadcrumb-nav">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{$name}}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <section class="pb-5">
        <div class="container">
            <div class="row">
                @foreach($items_list as $item)
                <div class="col-md-3 mb-4">
                    <div class="item-box d-flex flex-column">
                        @if($item->image != '')
                        <img src="{{asset('public/manage_food/'.$item->image)}}" alt="{{$item->food_name}}">
                        @else
                        <img src="{{asset('public/site-images/default.png')}}" alt="{{$item->food_name}}">
                        @endif
                        <div class="content mt-auto">
                            <h3>{{$item->food_name}}</h3>
                            <span class="category"><a href="{{url('category/'.str_replace(' ','-',$name))}}">{{$name}}</a></span>
                            <div class="price">{{$siteInfo->curr_format}}{{$item->price}}</div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
</article>
@stop