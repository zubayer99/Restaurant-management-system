@extends('admin.layout')
@section('title','Dashboard')
@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <h2>DASHBOARD</h2>
        </div>
        <!-- Widgets -->
        <div class="row clearfix">
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="info-box bg-pink hover-expand-effect">
                    <div class="icon">
                        <i class="material-icons">playlist_add_check</i>
                    </div>
                    <div class="content">
                        <div class="text">Today Orders</div>
                        <div class="number count-to">{{$today_orders}}</div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="info-box bg-cyan hover-expand-effect">
                    <div class="icon">
                        <i class="material-icons">money</i>
                    </div>
                    <div class="content">
                        <div class="text">Today Sales</div>
                        <div class="number count-to">{{$siteInfo->curr_format}}{{$today_sales}}</div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="info-box bg-light-green hover-expand-effect">
                    <div class="icon">
                        <i class="material-icons">table</i>
                    </div>
                    <div class="content">
                        <div class="text">Total Reservations</div>
                        <div class="number count-to">{{$reservations}}</div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="info-box bg-orange hover-expand-effect">
                    <div class="icon">
                        <i class="material-icons">person_add</i>
                    </div>
                    <div class="content">
                        <div class="text">Total Customers</div>
                        <div class="number count-to">{{$customers}}</div>
                    </div>
                </div>
            </div>
        </div>
        <!-- #END# Widgets -->
            <div class="body">
            <!-- With Material Design Colors -->
            <div class="row clearfix">
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>Latest Orders</h2>
                        </div>
                        <div class="body">
                            <ul class="list-group">
                                @foreach($latest_orders as $row)
                                <li class="list-group-item">
                                    <p><b>Customer :</b> {{$row->customer_name}}</p>
                                    <p><b>Table :</b> {{$row->table_name}}</p>
                                    <p><b>Status :</b> 
                                        @if($row->status == '1')
                                        <span class="badge bg-blue">On Going</span>
                                        @elseif($row->status == '2')
                                            <span class="badge bg-blue-grey">Completed</span>    
                                        @elseif($row->status == '-1')
                                            <span class="badge bg-red">Cancelled</span>    
                                        @else
                                        <span class="badge btn-warning">Pending</span>
                                        @endif
                                    </p>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>Latest Reservations</h2>
                        </div>
                        <div class="body">
                            <ul class="list-group">
                                @foreach($latest_reservations as $row)
                                <li class="list-group-item">
                                    <p><b>Customer :</b> {{$row->customer_name}}</p>
                                    <p><b>Table :</b> {{$row->table_name}}</p>
                                    <p><b>Time :</b> {{date('h:i a',strtotime($row->start_time))}}</p>
                                    <p><b>Status :</b> 
                                        @if($row->status == '1')
                                        <span class="badge bg-blue">Booked</span>
                                        @else
                                        <span class="badge btn-warning">Free</span>
                                        @endif
                                    </p>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- With Material Design Colors -->
         
        </div>
</section>
@stop    