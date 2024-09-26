@extends('public.layout.master')
@section('title',$siteInfo->app_title)
@section('content')
<article id="main-content">
    <div class="page-header">
        <div class="container">
            <div class="row">
                <div class="col">
                    <h2 class="section-sub-heading">My Profile</h2>
                    <nav aria-label="breadcrumb" class="breadcrumb-nav">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">My Profile</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div class="page-content">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">My Info</h5>
                        </div>
                        <div class="card-body">
                            <ul class="list-group mb-3">
                                <li class="list-group-item"><b>Name :</b> {{$customer->customer_name}}</li>
                                <li class="list-group-item"><b>Email :</b> {{$customer->email}}</li>
                                <li class="list-group-item"><b>Phone :</b> {{$customer->phone}}</li>
                                <li class="list-group-item"><b>Address :</b> {{$customer->address}}</li>
                            </ul>
                            <button class="btn link-button w-100 show-edit-profile">Edit Profile</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">My Reservations</h5>
                        </div>
                        <div class="card-body">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Table</th>
                                        <th>Date</th>
                                        <th>Time</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if($reservations->isNotEmpty())
                                        @foreach($reservations as $res)    
                                            <tr>
                                                <td>{{$res->table_name}}</td>
                                                <td>{{date('d M, Y',strtotime($res->date))}}</td>
                                                <td>{{date('h:i a',strtotime($res->start_time))}}</td>
                                                <td>
                                                    @if($res->status == '1')
                                                        <span class="label label-danger">Active</span>
                                                    @else
                                                        <span class="label label-danger">Expired</span>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="4" align="center">No Reservations Found</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</article>
<div class="modal fade" id="profileModal" data-bs-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="profileModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="profileModalLabel">Edit Profile</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="POST" id="updateProfile" class="p-0">
            @csrf
            <div class="form-group mb-3">
                <label for="">Name</label>
                <input type="text" class="form-control" name="name" value="{{$customer->customer_name}}">
            </div>
            <div class="form-group mb-3">
                <label for="">Phone</label>
                <input type="number" class="form-control" name="phone" value="{{$customer->phone}}">
            </div>
            <div class="form-group mb-3">
                <label for="">Address</label>
                <textarea name="address" class="form-control">{{$customer->address}}</textarea>
            </div>
            <input type="submit" class="btn link-button" name="submit" value="Update">
        </form>
      </div>
    </div>
  </div>
</div>
@stop