@extends('admin.layout')
@section('title','Kitchen Settings')
@section('content')

<!-- Content Header (Page header) -->
@component('admin.components.content-header',['breadcrumb'=>['Dashboard'=>'admin/dashboard']])
    @slot('title') Kitchen Settings @endslot
    @slot('active') Kitchen Settings  @endslot
@endcomponent
<!-- /.content-header -->
<!-- Basic Validation -->
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <!-- <h2>General Icon</h2> -->
            </div>
            <div class="body">
                <form class="form-horizontal" id="updateKitchenSettings" method="POST">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}
                    <div class="row clearfix">
                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                            <label>Username</label>
                        </div>
                        <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" name="username" class="form-control" value="{{$kitchen->username}}" placeholder="Kitchen Username">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row clearfix">
                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                            <label>Password</label>
                        </div>
                        <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="password" name="new_pass" class="form-control" value="" placeholder="">
                                </div>
                                <small>(Note : Leave password if not change in password.)</small>
                                <input type="password" name="old_pass" value="{{$kitchen->password}}" hidden>
                            </div>
                        </div>
                    </div>
                    <div class="row clearfix">
                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                            <label>Status</label>
                        </div>
                        <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                            <div class="form-group">
                                <div class="form-line">
                                    <select name="status" class="form-control">
                                        <option value="1" @if($kitchen->status == '1') selected @endif  >Active</option>
                                        <option value="0" @if($kitchen->status == '0') selected @endif >Inactive</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row clearfix">
                        <div class="col-lg-offset-2 col-md-offset-2 col-sm-offset-4 col-xs-offset-5">
                            <button class="btn bg-red waves-effect" type="submit">Update</button>
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
                $('#icon').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]); // convert to base64 string
        }
    }
</script>   

<script type="text/javascript">
    function readLogo(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#logo').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]); // convert to base64 string
        }
    }
</script>   
@stop 