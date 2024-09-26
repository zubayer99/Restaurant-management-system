@extends('admin.layout')
@section('title','Pos Invoice')
@section('content')

<!-- Content Header (Page header) -->
@component('admin.components.content-header',['breadcrumb'=>['Dashboard'=>'admin/dashboard','Orders'=>'admin/order_list']])
    @slot('title') Create Order @endslot
    @slot('active') Create Order @endslot
@endcomponent
<!-- /.content-header -->
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <!-- <input type="hidden" class="dir-url" value="{{url('admin/pos_invoice')}}" > -->
        <input type="hidden" class="url" value="{{url('admin/cat_item')}}" >
        <input type="hidden" class="dlt-url" value="{{url('admin/food_item')}}" >
        <div class="card">
            <div class="header">
                <h2>Pos Invoice</h2>
            </div>
            <div class="body">
                <div class="row">
                    <div class="col-md-6 row">
                        <div class="col-md-6">
                            <div class="input-group mb-0">
                                    <div class="form-line">
                                    <select class="form-control get-cat-items">
                                        <option value="all" selected> All</option>
                                        @foreach($category as $item)
                                            @if($item->food_count > 0 )
                                                <option value="{{$item->cat_id}}">{{$item->category_name}}</option>
                                            @endif    
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="input-group mb-0">
                                <div class="form-line">
                                    <input type="text" class="form-control search-item" placeholder="Search">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 food_items">
                            @foreach($managefood as $item)
                            <div class="col-xs-6 col-md-3" style="padding: 0 5px;">
                                <a href="javascript:void(0);" class="thumbnail" style="margin:0 0 10px;" data-id="{{$item->food_id}}">
                                    @if($item->image != "")
                                    <img id="image" src="{{asset('public/manage_food/'.$item->image)}}" alt="" width="100px" height="100px">
                                    @else
                                    <img id="image" src="{{asset('public/manage_food/default.jpg')}}" alt="" width="150px" height="150px">
                                    @endif
                                </a>
                                <h5 style="text-align:center; font-size:12px;">{{$item->food_name}}</h5>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="col-md-6 row">
                        <div class="col-lg-6 col-md-4">
                            <label class="text-left">Customer Name</label>
                            <div class="input-group mb-0">
                                    <select class="form-control customer_name" required>
                                        <option value="" disabled>-- Select Customer --</option>
                                        @if(!empty($customerlist))
                                            @foreach($customerlist as $types)
                                                @php $selected = ($types->customer_id == '1') ? 'selected' : ''; @endphp
                                            <option value="{{$types->customer_id}}" {{$selected}} >{{$types->customer_name}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    <input type="text" name="tax_percent" value="{{$siteInfo->tax_percent}}" hidden>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-4">
                            <label class="text-left">Customer Type</label>
                            <div class="input-group mb-0">
                                <select class="form-control customer_type" required>
                                    @if(!empty($customer_types))
                                    @foreach($customer_types as $c_types)
                                    @php $selected = ''; @endphp    
                                        @if($c_types->slug == 'dine-in-customer')
                                            @php $selected = 'selected'; @endphp
                                        @endif
                                        <option value="{{$c_types->id}}" data-slug="{{$c_types->slug}}" {{$selected}}>{{$c_types->title}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-4 col-sm-3 table_box">
                            <div class="input-group mb-0">
                                <label>Table List</label>
                                <select class="form-control table_list" name="table_list" required>
                                    <option value="" disabled>-- Select Table List --</option>
                                    @if(!empty($tablelist))
                                        @foreach($tablelist as $types)
                                        <option value="{{$types->table_id}}">{{$types->table_name}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-4 col-sm-3 waiter_box">
                            <div class="input-group mb-0">
                                <label>Waiter</label>
                                <select class="form-control waiter_list" name="waiter_list" required>
                                    <option value="" disabled>-- Select Waiter --</option>
                                    @if(!empty($waiters))
                                        @foreach($waiters as $waiter)
                                        <option value="{{$waiter->id}}">{{$waiter->name}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12 addFoodList">
                            <div class="table-responsive" style="display:none;">
                                <table class="table table-bordered item_table">
                                    <thead>
                                        <tr>
                                            <th>Item</th>
                                            <th>Price</th>
                                            <th>Quantity</th>
                                            <th>Total</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="3" align="right"><b>TOTAL AMOUNT</b></td>
                                            <td>{{$siteInfo->curr_format}}
                                                <span class="total-amount"></span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="3" align="right"><b>Tax({{$siteInfo->tax_percent}}%)</b></td>
                                            <td>{{$siteInfo->curr_format}}
                                                <span class="tax-amount"></span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="3" align="right"><b>NET AMOUNT</b></td>
                                            <td>{{$siteInfo->curr_format}}
                                                <span class="net-amount"></span>
                                            </td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                        <div class="col-md-12">
                        <button class="btn bg-red waves-effect order_complete" type="submit">Place Order</button> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop  
@section('pageJsScripts')
<script type="text/javascript">
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#image').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]); // convert to base64 string
        }
    }

     // Format given values
    // Set new values
    $('.time24').inputmask('hh:mm', { placeholder: '__:__ _m', alias: 'time24', hourFormat: '24' });
 </script>   
@stop 