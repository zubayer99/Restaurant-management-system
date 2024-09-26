@extends('public.layout.master')
@section('title',$siteInfo->app_title)
@section('content')
<section id="banner-section">
    <div class="swiper">
    <!-- Additional required wrapper -->
    <div class="swiper-wrapper">
        @foreach($banner as $banner)
        <div class="swiper-slide" style="background-image: url('public/banners/{{$banner->image}}');">
            <div class="row">
                <div class="col-6">
                    <h1>{{$banner->title}}</h1>
                    <span class="d-block mb-4">{{$banner->descr}}</span>
                    @if($banner->btn_text != '')
                    <a href="{{$banner->btn_link}}" class="btn link-button">sdsdfsd</a>
                    @endif
                </div>
            </div>
        </div>
        @endforeach
    </div>
</section>
<section id="category-section" class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2 class="section-heading">Our Popular Food</h2>
                <h3 class="section-sub-heading">Our Category</h3>
            </div>
        </div>
        <div class="row">
            @foreach($categories as $category)
            <div class="col-lg-4 col-md-6 h-100">
                <div  class="category-box">
                    @if($category->image != '')
                    <img src="{{asset('public/manage_category/'.$category->image)}}" alt="image name">
                    @else
                    <img src="{{asset('public/manage_category/default.png')}}" alt="image name">
                    @endif
                    <div class="content d-flex flex-row justify-content-between">
                        <h4 class="align-self-center m-0"><a href="{{url('category/'.str_replace(' ','-',$category->category_name))}}">{{$category->category_name}}</a></h4>
                        <a href="{{url('category/'.str_replace(' ','-',$category->category_name))}}" class="read-more"><i class="fa fa-angle-right"></i></a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
<section id="reservation-section">
    <div class="container">
        <div class="row">
            <div class="col">
                <h2 class="section-heading">Booking a Table</h2>
                <h3 class="section-sub-heading">Make a reservation</h3>
                <a href="{{url('reservation')}}" class="link-button">Book a Table</a>
            </div>
        </div>
    </div>
</section>
<section id="menu-section">
    <div class="container">
        <div class="row">
            <div class="col">
                <h2 class="section-heading">Food Menu</h2>
                <h3 class="section-sub-heading">Choose Your Best Menus</h3>
            </div>
        </div>
        <div class="row">
            @foreach($menu_list as $menu)
            <div class="col-lg-3 col-md-4">
                <a href="{{url('menu/'.str_replace(' ','-',$menu->menu_type))}}" class="menu-box">
                    @if($menu->image != '')
                    <img src="{{asset('public/menu_type/'.$menu->image)}}" alt="image name">
                    @else
                    <img src="{{asset('public/menu_type/default.png')}}" alt="image name">
                    @endif
                    <h4>{{$menu->menu_type}}</h4>
                </a>
            </div>
            @endforeach
        </div>
    </div>
</section>
<section id="working-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-7 col-md-12">
                <h2 class="section-heading">Opened Hour</h2>
                <h3 class="section-sub-heading">Enjoy Our Foods Everyday</h3>
            </div>
            <div class="col-lg-5 d-lg-block d-md-none">
            <ul class="text-md-center">
                    <li>Open On -{{date('h:i a',strtotime($siteInfo->opening_time))}}</li>
                    <li>Close On - {{date('h:i a',strtotime($siteInfo->closing_time))}}</li>
                    <li>All Days open</li>
                </ul>
            </div>
        </div>
    </div>
</section>
@stop