@extends('kitchen.layout')
@section('title','Dashboard')
@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <h2>DASHBOARD</h2>
        </div>
        <div class="row">
            @foreach($orders as $order)
            <div class="col-md-4">
                <div class="card">
                    <div class="header bg-blue">
                        <h4>Order: {{$order->id}}</h4>
                        <h5>Table: {{$order->table}}</h5>
                    </div>
                    <div class="body">
                        <table class="table">
                            <thead>
                                <th>Item Name</th>
                                <th>Qty</th>
                            </thead>
                            <tbody>
                                @foreach($order->order_items as $item)
                                <tr>
                                    <td>{{$item->name->food_name}}</td>
                                    <td align="right">{{$item->qty}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @if($order->status == '0')
                        <button class="btn btn-sm bg-green accept-order" data-id="{{$order->id}}">Accept</button>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@stop    