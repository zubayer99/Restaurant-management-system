@extends('admin.layout')
@section('title','On Going Orders')
@section('content')

<!-- Content Header (Page header) -->
@component('admin.components.content-header',['breadcrumb'=>['Dashboard'=>'admin/dashboard']])
    @slot('title') Ongoig Orders @endslot
    @slot('active') Ongoing Orders @endslot
@endcomponent
<!-- /.content-header -->
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="body">
                <div class="row">
                    @if($orders->isNotEmpty())
                    @foreach($orders as $order)
                    <div class="col-md-4">
                        <div class="card">
                            <div class="header">
                                <h2>Order : <b>{{$order->id}}</b></h2>
                                <ul class="header-dropdown m-r--5">
                                    <li class="dropdown">
                                    @if($order->status == '1')
                                    <span class="badge bg-blue">On Going</span>
                                    @elseif($order->status == '2')
                                        <span class="badge bg-blue-grey">Completed</span>    
                                    @elseif($order->status == '-1')
                                        <span class="badge bg-red">Cancelled</span>    
                                    @else
                                    <span class="badge btn-warning">Pending</span>
                                    @endif
                                    </li>
                                </ul>
                            </div>
                            <div class="body">
                                <ul>
                                    <li>Table : {{$order->table}}</li>
                                    <li>Waiter : Waiter1</li>
                                    <li>Running From : {{date('h:i:s a',strtotime($order->created_at))}}</li>
                                </ul>
                                <a href="order_list/{{$order->id}}" class="btn bg-blue btn-sm">Complete</a>
                                <button type="button" value="delete" class="btn bg-red waves-effect btn-sm delete-orderMenu" data-id="{{$order->id}}"><i class="material-icons">delete</i></button>
                                <a href="order_list/{{$order->id}}"  class="btn btn-sm view_detail bg-green waves-effect"><i class="material-icons">visibility</i></a>
                                <a href="{{url('admin/order_list/print/'.$order->id)}}" class="btn btn-sm bg-blue-grey"><i class="material-icons">print</i></a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    @else
                        <p>No Orders Found</p>
                    @endif
                </div>    
            </div>
        </div>
    </div>
</div>
@stop  
@section('pageJsScripts')

@stop 