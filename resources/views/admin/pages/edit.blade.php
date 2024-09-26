@extends('admin.layout')
@section('title','Edit Page')
@section('content')

<!-- Content Header (Page header) -->
@component('admin.components.content-header',['breadcrumb'=>['Dashboard'=>'admin/dashboard','Pages'=>'admin/pages']])
    @slot('title') Edit Page @endslot
 <!--    @slot('add_btn')  @endslot -->
    @slot('active') Edit Page @endslot
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
                <form class="form-horizontal" id="updatePage" method="POST">
                   @csrf
                   {{ method_field('PUT') }}
                    <div class="row clearfix">
                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                            <label>Title</label>
                        </div>
                        <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" name="title" value="{{$page->title}}" class="form-control" placeholder="Page Title">
                                    <input type="text" hidden class="id" value="{{$page->id}}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row clearfix">
                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                            <label>Slug</label>
                        </div>
                        <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" name="slug" value="{{$page->slug}}" class="form-control" placeholder="Page Slug">
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
                                    <textarea name="content" id="editor" class="form-control" placeholder="Page Content">{!!$page->content!!}</textarea>
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
                                        <option value="" disabled>-- Select --</option>
                                        <option value="1" @if($page->show_in_header == '1') selected @endif>Show</option>
                                        <option value="0" @if($page->show_in_header == '0') selected @endif >Hide</option>
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
                                        <option value="" disabled>-- Select --</option>
                                        <option value="1" @if($page->show_in_footer == '1') selected @endif >Show</option>
                                        <option value="0" @if($page->show_in_footer == '0') selected @endif >Hide</option>
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
                                        <option value="1" @if($page->status == '1') selected @endif >Active</option>
                                        <option value="0" @if($page->status == '0') selected @endif>Inactive</option>
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