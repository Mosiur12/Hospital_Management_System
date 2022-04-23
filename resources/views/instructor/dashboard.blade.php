
@extends('instructor.master')
@section('title', 'Welcome')

@section('main-content')
    <div class="row">
        <div class="col-sm-12">
            <div class="page-header-title">
                <h4 class="pull-left page-title">Instructor Dashboard</h4>
                <ol class="breadcrumb pull-right">
                    <li><a href="{{route('instructor.dashboard')}}">Home</a></li>
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
                    <h4 class="panel-title">Create Course</h4>
                </div>
                <div class="panel-body">
                    @php
                        $course = \App\Course::where('instructor_id', auth()->user()->id)->get();
                    @endphp
                    <h3 class=""><b>{{$course->count()}}</b></h3>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-lg-3">
            <div class="panel panel-primary text-center">
                <div class="panel-heading">
                    <h4 class="panel-title">Total Student</h4>
                </div>
                <div class="panel-body">
                    <h3 class=""><b>{{$students}}</b></h3>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-lg-3">
            <div class="panel panel-primary text-center">
                <div class="panel-heading">
                    <h4 class="panel-title">Total Review</h4>
                </div>
                <div class="panel-body">
                    <h3 class=""><b>{{$reviews}}</b></h3>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-lg-3">
            <div class="panel panel-primary text-center">
                <div class="panel-heading">
                    <h4 class="panel-title">Total withdraw</h4>
                </div>
                <div class="panel-body">
                    @php
                        $withdrow = \App\Withdraw::where('user_id', auth()->user()->id)->where('status', '1')->sum('withdraw');
                    @endphp
                    <h3 class=""><b>${{$withdrow}}</b></h3>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-lg-3">
            <div class="panel panel-primary text-center">
                <div class="panel-heading">
                    <h4 class="panel-title">Available Many</h4>
                </div>
                <div class="panel-body">
                    @php
                        $wallet = \App\Wallet::where('user_id', auth()->user()->id)->first();
                    @endphp
                    <h3 class=""><b>${{$wallet ? $wallet->available : '0'}}</b></h3>
                </div>
            </div>
        </div>
    </div>
@endsection
