
@extends('admin.master')
@section('title', 'Welcome')

@section('main-content')
    <div class="row">
        <div class="col-sm-12">
            <div class="page-header-title">
                <h4 class="pull-left page-title">Admin Dashboard</h4>
                <ol class="breadcrumb pull-right">
                    <li><a href="#">Xadmino</a></li>
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
                    <h4 class="panel-title">Admin Wallet</h4>
                </div>
                <div class="panel-body">
                    @php
                        $wallet = \App\Wallet::where('user_id', '3')->first();
                    @endphp
                    <h3 class=""><b>${{$wallet->available}}</b></h3>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-lg-3">
            <div class="panel panel-primary text-center">
                <div class="panel-heading">
                    <h4 class="panel-title">Total Instructor</h4>
                </div>
                <div class="panel-body">
                    @php
                        $ins = \App\User::where('user_type', 'instructor')->get();
                    @endphp
                    <h3 class=""><b>{{$ins->count()}}</b></h3>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-lg-3">
            <div class="panel panel-primary text-center">
                <div class="panel-heading">
                    <h4 class="panel-title">Total Student</h4>
                </div>
                <div class="panel-body">
                    @php
                        $std = \App\User::where('user_type', 'student')->get();
                    @endphp
                    <h3 class=""><b>{{$std->count()}}</b></h3>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-lg-3">
            <div class="panel panel-primary text-center">
                <div class="panel-heading">
                    <h4 class="panel-title">Total Category</h4>
                </div>
                <div class="panel-body">
                    @php
                        $category = \App\Category::where('status', '1')->get();
                    @endphp
                    <h3 class=""><b>{{$category->count()}}</b></h3>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-lg-3">
            <div class="panel panel-primary text-center">
                <div class="panel-heading">
                    <h4 class="panel-title">Total Course</h4>
                </div>
                <div class="panel-body">
                    @php
                        $course = \App\Course::where('status', '1')->get();
                    @endphp
                    <h3 class=""><b>{{$course->count()}}</b></h3>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-lg-3">
            <div class="panel panel-primary text-center">
                <div class="panel-heading">
                    <h4 class="panel-title">Total Review</h4>
                </div>
                <div class="panel-body">
                    @php
                        $review = \App\Review::where('status', '1')->get();
                    @endphp
                    <h3 class=""><b>{{$review->count()}}</b></h3>
                </div>
            </div>
        </div>


        <div class="col-sm-6 col-lg-3">
            <div class="panel panel-primary text-center">
                <div class="panel-heading">
                    <h4 class="panel-title">This month course sells</h4>
                </div>
                <div class="panel-body">
                    @php
                        use Carbon\Carbon;
                        $monthcourse = \App\Enroll::where('created_at', '>=', Carbon::now()->subDays(30)->toDateTimeString())->get();
                    @endphp
                    <h3 class=""><b>{{$monthcourse->count()}}</b></h3>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-lg-3">
            <div class="panel panel-primary text-center">
                <div class="panel-heading">
                    <h4 class="panel-title">Total Payment</h4>
                </div>
                <div class="panel-body">
                    @php
                        $totalPay = \App\Payment::sum('amount');
                    @endphp
                    <h3 class=""><b>{{$totalPay}}</b></h3>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-lg-3">
            <div class="panel panel-primary text-center">
                <div class="panel-heading">
                    <h4 class="panel-title">This month Total pay</h4>
                </div>
                <div class="panel-body">
                    @php
                        $monthPay = \App\Payment::where('created_at', '>=', Carbon::now()->subDays(30)->toDateTimeString())->sum('amount');
                    @endphp
                    <h3 class=""><b>{{$monthPay}}</b></h3>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-lg-3">
            <div class="panel panel-primary text-center">
                <div class="panel-heading">
                    <h4 class="panel-title">Total Event</h4>
                </div>
                <div class="panel-body">
                    @php
                        $event = \App\Event::where('status', '1')->get();
                    @endphp
                    <h3 class=""><b>{{$event->count()}}</b></h3>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-lg-3">
            <div class="panel panel-primary text-center">
                <div class="panel-heading">
                    <h4 class="panel-title">Total Subscribe</h4>
                </div>
                <div class="panel-body">
                    @php
                        $subscribe = \App\Subscription::where('status', '1')->get();
                    @endphp
                    <h3 class=""><b>{{$subscribe->count()}}</b></h3>
                </div>
            </div>
        </div>
    </div>
@endsection
