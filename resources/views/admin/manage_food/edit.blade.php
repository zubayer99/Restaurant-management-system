@extends('admin.layout')
@section('title','Manage Food')
@section('content')

<!-- Content Header (Page header) -->
@component('admin.components.content-header',['breadcrumb'=>['Dashboard'=>'admin/dashboard','Manage Food'=>'admin/manage_food']])
    @slot('title') Edit Food @endslot
 <!--    @slot('add_btn')  @endslot -->
    @slot('active') Edit @endslot
@endcomponent
<!-- /.content-header -->
<!-- Basic Validation -->
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>Food Details</h2>
            </div>
            <div class="body">
                <form class="form-horizontal" id="editFood" method="POST">
                    @csrf
                    {{ method_field('PUT') }}
                    @if($food)
                    <input type="hidden" class="url" value="{{url('admin/manage_food/'.$food->food_id)}}" >
                    <div class="row clearfix">
                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                            <label>Name <small class="text-danger">*</small></label>
                        </div>
                        <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" name="food_name" class="form-control" value="{{$food->food_name}}" placeholder="Enter Food Name">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row clearfix">
                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                            <label>Category <small class="text-danger">*</small></label>
                        </div>
                        <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                            <div class="form-group" >
                               <div class="form-line">
                                    <select class="form-control" name="category" required>
                                        <option disabled value="">Select The Category</option>
                                        @if(!empty($category))
                                            @foreach($category as $types)
                                                @if($food->category == $types->cat_id)
                                                    <option value="{{$types->cat_id}}" selected>{{$types->category_name}}</option>
                                                    @else
                                                    <option value="{{$types->cat_id}}">{{$types->category_name}}</option>
                                                @endif
                                            @endforeach
                                        @endif 
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row clearfix">
                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                            <label>Menu Type <small class="text-danger">*</small></label>
                        </div>
                        <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                            <div class="form-group" >
                                <div class="form-line">
                                    <select class="form-control" name="menu_type" required>
                                        <option disabled value="" >Select The MenuType</option>
                                        @if(!empty($menuType))
                                                @foreach($menuType as $types)
                                                    @if($food->menu_type == $types->id)
                                                        <option value="{{$types->id}}" selected>{{$types->menu_type}}</option>
                                                        @else
                                                        <option value="{{$types->id}}">{{$types->menu_type}}</option>
                                                    @endif
                                                @endforeach
                                            @endif 
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row clearfix">
                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                            <label>Description</label>
                        </div>
                        <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                            <div class="form-group">
                                <div class="form-line">
                                   <textarea name="description" cols="30" rows="5" class="form-control no-resize" value="" required>{{$food->description}}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row clearfix">
                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                            <label>Image <small class="text-danger">*</small></label>
                        </div>
                        <div class="col-lg-7 col-md-7 col-sm-5 col-xs-4">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="hidden" class="form-control" name="old_img" value="{{$food->image}}" />
                                    <input type="file" class="form-control" name="img"  placeholder="Enter your Image" onChange="readURL(this);">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                           @if($food->image != "")
                            <img src="{{asset('public/manage_food/'.$food->image)}}" alt="" width="80px" height="80px">
                            @else
                            <img src="{{asset('public/manage_food/default.jpg')}}" alt="" width="80px" height="80px">
                            @endif
                        </div>
                    </div>
                    <div class="row clearfix">
                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                            <label>Cooking Time <small class="text-danger">*</small></label>
                        </div>
                        <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="material-icons">access_time</i>
                                </span>
                                <div class="form-line">
                                    <input type="text" name="time" class="form-control time24 time" value="{{$food->cooking_time}}" placeholder="00:00">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row clearfix">
                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                            <label>Price ({{$siteInfo->curr_format}}) <small class="text-danger">*</small></label>
                        </div>
                        <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                            <div class="input-group">
                                <div class="form-line">
                                    <input type="number" name="price" class="form-control " value="{{$food->price}}" placeholder="Cooking Price">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row clearfix">
                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                            <label>Status <small class="text-danger">*</small></label>
                        </div>
                        <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                            <div class="form-group" >
                                <div class="form-line">
                                    <select class="form-control" name="status" required>
                                        <option value="" disabled>-- Select Status --</option>
                                        <option value="1" {{ ($food->status == "1" ? "selected":"") }}>Active</option>
                                        <option value="0" {{ ($food->status == "0" ? "selected":"") }}>Inactive</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row clearfix">
                        <div class="col-lg-offset-2 col-md-offset-2 col-sm-offset-4 col-xs-offset-5">
                            <button class="btn bg-red waves-effect" type="submit">UPDATE</button>
                        </div>
                    </div>
                    @endif
                </form>
            </div>
        </div>
    </div>
</div>
<!-- #END# Basic Validation -->
@stop  
@section('pageJsScripts')
<script>
    // Format given values
    // Set new values
    $('.time24').inputmask('hh:mm', { placeholder: '__:__ _m', alias: 'time24', hourFormat: '24' });
</script>
@stop  