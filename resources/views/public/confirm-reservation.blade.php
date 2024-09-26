@extends('public.layout.master')
@section('title',$siteInfo->app_title)
@section('content')
<article id="main-content">
    <div class="page-header">
        <div class="container">
            <div class="row">
                <div class="col">
                    <h2 class="section-sub-heading">Confirm Reservation</h2>
                    <nav aria-label="breadcrumb" class="breadcrumb-nav">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{url('/reservation')}}">Reservation</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Confirm Reservation</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <form method="POST" class="p-0" id="create-reservation">
                        @csrf
                        <table class="table table-bordered">
                            <tr>
                                <th>Table No.</th>
                                <td>
                                    <b>{{App\Models\TableList::where('table_id',Request::get('table'))->pluck('table_name')->first()}}</b>
                                    <input type="text" name="table_no" value="{{Request::get('table')}}" hidden>
                                </td>
                            </tr>
                            <tr>
                                <th>Persons</th>
                                <td>
                                    <input type="number" class="form-control" name="no_person" value="{{Request::get('persons')}}" readonly>
                                </td>
                            </tr>
                            <tr>
                                <th>Date</th>
                                <td>
                                    <input type="date" class="form-control" name="date" value="{{Request::get('date')}}" readonly>
                                </td>
                            </tr>
                            <tr>
                                <th>Start Time</th>
                                <td>
                                    <input type="time" class="form-control" name="start_time" value="{{Request::get('time')}}" readonly>
                                </td>
                            </tr>
                            <tr>
                                <th>End Time</th>
                                <td>
                                    <input type="time" class="form-control" name="end_time" value="{{date('h:i',strtotime('+30 minutes',strtotime(Request::get('time'))))}}">
                                </td>
                            </tr>
                        </table>
                        <div class="text-center">
                            <input type="submit" class="btn link-button" value="Confirm Reservation">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <div class="available-tables py-5 position-relative">
        
    </div>
</article>
@stop