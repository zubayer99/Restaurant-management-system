@extends('admin.layout')
@section('title','Category')
@section('content')

<!-- Content Header (Page header) -->
@component('admin.components.content-header',['breadcrumb'=>['Dashboard'=>'admin/dashboard','Category'=>'admin/manage_category']])
    @slot('title') Edit Category @endslot
 <!--    @slot('add_btn')  @endslot -->
    @slot('active') Edit Category @endslot
@endcomponent
<!-- /.content-header -->
<!-- Basic Validation -->
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>Category Details</h2>
            </div>
            <div class="body">
                <form class="form-horizontal" id="editCategory" method="POST">
                   @csrf
                    {{ method_field('PUT') }}
                    @if($category)
                    <input type="hidden" class="url" value="{{url('admin/manage_category/'.$category->cat_id)}}" >
                    <div class="row clearfix">
                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                            <label>Category Name</label>
                        </div>
                        <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" name="category_name" class="form-control" value="{{$category->category_name}}" placeholder="Enter your Category Name">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row clearfix">
                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                            <label>Image</label>
                        </div>
                        <div class="col-lg-7 col-md-7 col-sm-5 col-xs-4">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="hidden" class="form-control" name="old_img" value="{{$category->image}}" />
                                    <input type="file" class="form-control" name="img" placeholder="Enter your Image" onChange="readURL(this);">
                                    <label class="form-control">Choose file</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                            @if($category->image != "")
                            <img id="image" src="{{asset('public/manage_category/'.$category->image)}}" alt="" width="80px" height="80px">
                            @else
                            <img id="image" src="{{asset('public/manage_category/default.jpg')}}" alt="" width="80px" height="80px">
                            @endif
                        </div>
                    </div>
                    <div class="row clearfix">
                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                            <label>Status</label>
                        </div>
                        <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                            <div class="form-group" >
                                <div class="form-line">
                                    <select class="form-control" name="status" required>
                                        <option value="" disabled>-- Select Status --</option>
                                        <option value="1" {{ ($category->status == "1" ? "selected":"") }}>Active</option>
                                        <option value="0" {{ ($category->status == "0" ? "selected":"") }}>Inactive</option>
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