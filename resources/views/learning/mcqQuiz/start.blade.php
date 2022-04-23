@extends('learning.master')

@section('title', 'Quiz Start')

@section('main-content')
    <div class="row">
        <div class="col-sm-12">
            <div class="page-header-title">
                <h4 class="pull-left page-title">Quiz Start</h4>
                <ol class="breadcrumb pull-right">
                    <li><a href="{{route('student.dashboard')}}">Dashboard</a></li>
                    <li><a href="{{route('student.courses.index')}}">All course</a></li>
                    <li class="active">Quiz Start</li>
                </ol>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-primary">
                <div class="panel-heading"><h3 class="panel-title">{{$quiz->title}}</h3></div>
                <div class="panel-body w-100" style="padding: 15%;">
                    <div class="row">
                        <div class="col-xs-12 text-center">
                            <h1>Quiz Time: {{date("H:i:s", $quiz->time*60)}}</h1>
                            <p>Be careful, You Can one time submit</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 text-center">
                            <a href="{{route('student.quiz.start.newQuiz', $id)}}" class="btn btn-primary w-md waves-effect waves-light" type="submit">Start Quiz Now</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
