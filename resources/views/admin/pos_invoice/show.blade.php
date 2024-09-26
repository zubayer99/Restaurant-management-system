@extends('admin.layout')
@section('title','PosInvoice')
@section('content')

<!-- Content Header (Page header) -->
@component('admin.components.content-header',['breadcrumb'=>['Dashboard'=>'admin/dashboard','Orders'=>'admin/order_list']])
    @slot('title') Show @endslot
 <!--    @slot('add_btn')  @endslot -->
    @slot('active') Show @endslot
@endcomponent
<!-- /.content-header -->
<!-- Striped Rows -->
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        @if($orderMenu)
        <div class="card">
            <div class="header">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        @if($siteInfo->logo != '')
                            <div style = "margin: 0 0 10px 0;">
                                <img id="logo" src="{{asset('public/site-images/'.$siteInfo->logo)}}" alt="" width="200px">
                            </div>
                            @endif
                        <span class="badge btn-success">Billing From</span>
                        <h2><b>{{$siteInfo->store_name}}</b></h2>
                        <h5>{{$siteInfo->address}}</h5>
                        <h6><b>Mobile No:</b> {{$siteInfo->phone}}</h6>
                        <h6><b>Email:</b> {{$siteInfo->email}}</h6>
                   </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <h3> <span><b>Invoice No: {{$orderMenu->id}}</b></h3></span>
                        <h5><span><b>Order Status:</b>
                            @if($orderMenu->status == '1')
                            <span class="badge bg-blue">On Going</span>
                            @elseif($orderMenu->status == '2')
                                <span class="badge bg-blue-grey">Completed</span>    
                            @elseif($orderMenu->status == '-1')
                                <span class="badge bg-red">Cancelled</span>    
                            @else
                            <span class="badge btn-warning">Pending</span>
                            @endif
                        </h5></span>
                        <h5><span><b>Billing Date:</b> {{date('d M, Y',strtotime($orderMenu->updated_at))}}</span></h5>
                        <span class="badge btn-success">Billing To</span>
                        <h5>{{$orderMenu->customer_name}}</h5>
                        <h6><span><b>Address :</b> 
                                @if($orderMenu->address == '')
                                 <span>Not Define</span>
                                @else
                                <span>{{$orderMenu->address}}</span>
                                @endif
                        </span></h6>
                        <h6><span><b>Mobile No :</b> {{$orderMenu->phone}}</span></h6>
                    </div>
                </div>
            </div>
            <div class="body table-responsive">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Item</th>
                            <th>Unit Price</th>
                            <th>Quantity</th>
                            <th>Total Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($order_items as $item)
                        <tr>
                            <td scope="row">{{$item->food_name}}</td>
                            <td class="price">{{$siteInfo->curr_format}} {{$item->amount/$item->qty}}</td>
                            <td>{{$item->qty}}</td>
                            <td class="subtotal">{{$siteInfo->curr_format}} {{$item->amount}}</td> 
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3" align="right"><b>Grand Total</b></td>
                            <td class="total-amount">{{$siteInfo->curr_format}} {{$orderMenu->amount}}</td>
                        </tr>
                        <tr>
                            <td colspan="3" align="right"><b>Tax({{$siteInfo->tax_percent}}%)</b></td>
                            <td class="total-amount">{{$siteInfo->curr_format}} {{$orderMenu->tax_amount}}</td>
                        </tr>
                        <tr>
                            <td colspan="3" align="right"><b>Net Total</b></td>
                            <td class="total-amount">{{$siteInfo->curr_format}} {{$orderMenu->net_amount}}</td>
                        </tr>
                    </tfoot>
                </table>
                @if($orderMenu->status == '1')
                <table class="border">
                    <tr>
                        <td>Payment Method</td>
                        <td>
                            <select class="pay_method">
                                @foreach($pay_methods as $row)
                                    <option value="{{$row->payment_id}}">{{$row->payment_name}}</option>
                                @endforeach
                            </select>
                            <input type="text" class="id" value="{{$orderMenu->id}}" hidden>
                        </td>
                        <td><button class="btn bg-red complete-order">Make Payment</button></td>
                    </tr>
                </table>
                @elseif($orderMenu->status == '2')
                    <h4>Order Completed</h4>
                @elseif($orderMenu->status == '-1')
                    <h4>Order Cancelled</h4>
                @endif
            </div>
        </div>
        @endif
    </div>
</div>
<!-- #END# Striped Rows -->