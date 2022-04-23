@extends('student.master')

@section('title', 'Event Details')

@section('main-content')
    <div class="row">
        <div class="col-sm-12">
            <div class="page-header-title">
                <h4 class="pull-left page-title">Event Details</h4>
                <ol class="breadcrumb pull-right">
                    <li><a href="{{route('student.dashboard')}}">Dashboard</a></li>
                    <li><a href="{{route('student.event.list')}}">Event</a></li>
                    <li class="active">Event Details</li>
                </ol>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">{{$event->title}}</h3>
                </div>

                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-4">
                            <img src="{{asset($event->img)}}" class="img-responsive" alt="Event image">
                        </div>
                        <div class="col-md-8">
                            <table class="table table-bordered">
                                <tbody>
                                <tr>
                                    <td>Title</td>
                                    <td>{{$event->title}}</td>
                                </tr>
                                <tr>
                                    <td>Place</td>
                                    <td>{{$event->place}}</td>
                                </tr>
                                <tr>
                                    <td>Location</td>
                                    <td>{{$event->location}}</td>
                                </tr>
                                <tr>
                                    <td>Total Seat</td>
                                    <td>{{$event->total_seat}}</td>
                                </tr>
                                <tr>
                                    <td>Event Short Description</td>
                                    <td>{!! $event->short_desc !!}</td>
                                </tr>
                                <tr>
                                    <td>Event Description</td>
                                    <td>{!! $event->desc !!}</td>
                                </tr>
                                <tr>
                                    <td>Event Date</td>
                                    <td>{{ \Carbon\Carbon::parse($event->event_date)->format("j S F Y")}}</td>
                                </tr>
                                <tr>
                                    <td>Event Time</td>
                                    <td>{{\Carbon\Carbon::parse($event->event_time)->format("h:i a")}}</td>
                                </tr>
                                <tr>
                                    <td>Event Speaker</td>
                                    <td>
                                        @php
                                            $speakers = json_decode($event->event_speaker);
                                            foreach ($speakers as $speaker)
                                            {
                                                  echo \App\User::where('id', $speaker)->pluck('name')->first().", ";
                                            }
                                        @endphp
                                    </td>
                                </tr>
                                <tr>
                                    <td>Status</td>
                                    <td>{{$event->status ? 'Active':'Inactive'}}</td>
                                </tr>

                                <tr>
                                    <td>Action</td>
                                    <td>
                                        <a href="{{route('student.event.list')}}" class="btn btn-success">Back</a>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
