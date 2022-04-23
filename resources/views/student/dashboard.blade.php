
@extends('student.master')
@section('title', 'Welcome')

@section('main-content')
    <div class="row">
        <div class="col-sm-12">
            <div class="page-header-title">
                <h4 class="pull-left page-title">Student Dashboard</h4>
                <ol class="breadcrumb pull-right">
                    <li><a href="{{route('home')}}">Home</a></li>
                    <li class="active">Dashboard</li>
                </ol>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-6 col-lg-3">
            <div class="panel panel-primary text-center">
                <div class="panel-heading">
                    <h4 class="panel-title">Enrolled Course</h4>
                </div>
                <div class="panel-body">
                    @php
                        $enroll = \App\Enroll::where('student_id', auth()->user()->id)->where('status', '1')->count();
                    @endphp
                    <h3 class=""><b>{{$enroll}}</b></h3>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-lg-3">
            <div class="panel panel-primary text-center">
                <div class="panel-heading">
                    <h4 class="panel-title">Complete Course</h4>
                </div>
                <div class="panel-body">
                    @php
                        $completeCourse = \App\Certificate::where('student_id', auth()->user()->id)->where('status', '1')->count();
                    @endphp
                    <h3 class=""><b>{{$completeCourse}}</b></h3>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-lg-3">
            <div class="panel panel-primary text-center">
                <div class="panel-heading">
                    <h4 class="panel-title">UnComplete Course</h4>
                </div>
                <div class="panel-body">
                    <h3 class=""><b>{{$enroll - $completeCourse}}</b></h3>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3">
            <div class="panel panel-primary text-center">
                <div class="panel-heading">
                    <h4 class="panel-title">Total pay</h4>
                </div>
                <div class="panel-body">
                    @php
                        $pay = \App\Payment::where('user_id', auth()->user()->id)->sum('amount');
                    @endphp
                    <h3 class=""><b>${{$pay}}</b></h3>
                </div>
            </div>
        </div>
    </div>
@endsection
