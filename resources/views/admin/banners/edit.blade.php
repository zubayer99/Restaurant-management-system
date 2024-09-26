@extends('admin.layout')
@section('title','Banners')
@section('content')

<!-- Content Header (Page header) -->
@component('admin.components.content-header',['breadcrumb'=>['Dashboard'=>'admin/dashboard','Category'=>'admin/manage_category']])
    @slot('title') Edit Banner @endslot
 <!--    @slot('add_btn')  @endslot -->
    @slot('active') Edit Banner @endslot
@endcomponent
<!-- /.content-header -->
<!-- Basic Validation -->
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>Banner Details</h2>
            </div>
            <div class="body">
                <form class="form-horizontal" id="updateBanner" method="POST">
                   @csrf
                    {{ method_field('PUT') }}
                    <div class="row clearfix">
                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                            <label>Title <small class="text-danger">*</small></label>
                        </div>
                        <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" name="title" value="{{$banner->title}}" class="form-control" placeholder="Banner Title">
                                    <input type="text" class="id" value="{{$banner->id}}" hidden>
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
                                    <input type="text" name="descr" value="{{$banner->descr}}" class="form-control" placeholder="Small Description">
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
                                    <input type="file" name="img" onChange="readURL(this);" class="form-control" placeholder="Select Image">
                                    <input type="text" name="old_img" value="{{$banner->image}}" hidden>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                            @if($banner->image != '')
                            <img id="image" src="{{asset('public/banners/'.$banner->image)}}" width="100px">
                            @else
                            <img id="image" src="{{asset('public/banners/default.png')}}" width="100px">
                            @endif
                        </div>
                    </div>
                    <div class="row clearfix">
                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                            <label>Button Text</label>
                        </div>
                        <div class="col-lg-4 col-md-10 col-sm-8 col-xs-7">
                            <div class="form-group" >
                                <div class="form-line">
                                    <input type="text" name="btn_text" value="{{$banner->btn_text}}" class="form-control" placeholder="Button text">
                                </div>
                                <small>(If you want to hide button leave empty this field.)</small>
                            </div>
                        </div>
                    </div>
                    <div class="row clearfix">
                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                            <label>Button Link</label>
                        </div>
                        <div class="col-lg-4 col-md-10 col-sm-8 col-xs-7">
                            <div class="form-group" >
                                <div class="form-line">
                                    <input type="text" name="btn_link" value="{{$banner->btn_link}}" class="form-control" placeholder="Button Link">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row clearfix">
                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                            <label>Status</label>
                        </div>
                        <div class="col-lg-4 col-md-10 col-sm-8 col-xs-7">
                            <div class="form-group" >
                                <div class="form-line">
                                    <select name="status" class="form-control">
                                        <option value="1" @if($banner->status =='1') selected @endif>Show</option>
                                        <option value="0" @if($banner->status =='0') selected @endif >Hide</option>
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
                </form>
            </div>
        </div>
    </div>
</div>
<!-- #END# Basic Validation -->
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
</script>   
@stop 