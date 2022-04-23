@extends('learning.master')

@section('title', 'Quiz Result')

@section('main-content')
    <div class="row">
        <div class="col-sm-12">
            <div class="page-header-title">
                <h4 class="pull-left page-title">{{$name}}</h4>
                <ol class="breadcrumb pull-right">
                    <li><a href="{{route('student.dashboard')}}">Dashboard</a></li>
                    <li><a href="{{route('student.courses.index')}}">All course</a></li>
                    <li class="active">Quiz Result</li>
                </ol>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
@endsection
