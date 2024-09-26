@extends('admin.layout')
@section('title','Add Page')
@section('content')

<!-- Content Header (Page header) -->
@component('admin.components.content-header',['breadcrumb'=>['Dashboard'=>'admin/dashboard','Pages'=>'admin/pages']])
    @slot('title') Add Page @endslot
 <!--    @slot('add_btn')  @endslot -->
    @slot('active') Add Page @endslot
@endcomponent
<!-- /.content-header -->
<!-- Basic Validation -->
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>Page Details</h2>
            </div>
            <div class="body">
                <form class="form-horizontal" id="addPage" method="POST">
                   @csrf
                    <div class="row clearfix">
                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                            <label>Title</label>
                        </div>
                        <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" name="title" class="form-control" placeholder="Page Title">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row clearfix">
                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                            <label>Content</label>
                        </div>
                        <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                            <div class="form-group" >
                                <div class="form-line">
                                    <textarea name="content" id="editor" class="form-control" placeholder="Page Content"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row clearfix">
                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                            <label>Show in Header</label>
                        </div>
                        <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                            <div class="form-group" >
                                <div class="form-line">
                                    <select class="form-control" name="show_header">
                                        <option value="" selected disabled>-- Select --</option>
                                        <option value="1">Show</option>
                                        <option value="0">Hide</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row clearfix">
                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                            <label>Shiw in Footer</label>
                        </div>
                        <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                            <div class="form-group" >
                                <div class="form-line">
                                    <select class="form-control" name="show_footer">
                                        <option value="" selected disabled>-- Select --</option>
                                        <option value="1">Show</option>
                                        <option value="0">Hide</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row clearfix">
                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                            <label>Status</label>
                        </div>
                        <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                            <div class="form-group" >
                                <div class="form-line">
                                    <select class="form-control" name="status">
                                        <option value="" disabled>-- Select Status --</option>
                                        <option value="1">Active</option>
                                        <option value="0">Inactive</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row clearfix">
                        <div class="col-lg-offset-2 col-md-offset-2 col-sm-offset-4 col-xs-offset-5">
                            <button class="btn bg-red waves-effect" type="submit">SUBMIT</button>
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
    $('#editor').trumbowyg({
    btns: [
          ['undo', 'redo'],['strong', 'em','underline'],['formatting'],
          ['justifyLeft'],['justifyRight'],['justifyCenter'],['justifyFull'],['link'],
          ['highlight'],['horizontalRule'],['unorderedList'],['orderedList'],
          'fullscreen'
        ]
  });
</script>   
@stop 