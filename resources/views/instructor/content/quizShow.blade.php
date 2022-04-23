@extends('instructor.master')

@section('title', 'Quiz Details')

@section('main-content')
    <div class="row">
        <div class="col-sm-12">
            <div class="page-header-title">
                <h4 class="pull-left page-title">Quiz Details</h4>
                <ol class="breadcrumb pull-right">
                    <li><a href="{{route('instructor.dashboard')}}">Dashboard</a></li>
                    <li><a href="{{route('instructor.courses.index')}}">All Course</a></li>
                    <li class="active">Quiz View</li>
                </ol>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">Quiz Details</h3>
                </div>

                <div class="panel-body">
                    <div class="row">
                        <div class="col-xs-12">
                            <form>
                                <div class="form-group">
                                    <label for="title">Quiz Title</label>
                                    <input type="text" name="name" value="{{$quiz->title}}" class="form-control" id="ex1" placeholder="Enter Chapter name">
                                </div>

                                <div class="form-group">
                                    <label for="title">Quiz Marks</label>
                                    <input type="text" name="name" value="{{$quiz->marks}}" class="form-control" id="ex1" placeholder="Enter Chapter name">
                                </div>

                                <div class="form-group">
                                    <label for="title">Quiz Time (Minutes)</label>
                                    <input type="text" name="name" value="{{$quiz->time}}" class="form-control" id="ex1" placeholder="Enter Chapter name">
                                </div>

                                <div class="form-group">
                                    <label for="audio">Quiz Question</label>
                                    <div>
                                        <a href="{{asset($quiz->file)}}" target="_blank">{{$quiz->title}}</a>
                                    </div>
                                    <div>
                                        <iframe width="1000" height="800" src="{{asset($quiz->file)}}">Your browser does not support</iframe>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="status">Quiz Status</label>
                                    <br>
                                    @php
                                        $status = $quiz->status;
                                    @endphp
                                    <div class="radio radio-info radio-inline">
                                        <input type="radio" id="inlineRadio1" value="1" name="status" @if($status==1) {{'checked'}}@endif>
                                        <label for="inlineRadio1">Active</label>
                                    </div>
                                    <div class="radio radio-info radio-inline">
                                        <input type="radio" id="inlineRadio1" value="0" name="status"@if($status==0) {{'checked'}}@endif>
                                        <label for="inlineRadio1">Inactive</label>
                                    </div>
                                </div>
                                @error('status')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror

                                @php
                                $chapter = \App\Chapter::where('id', $quiz->chapter_id)->first();
                                $course = \App\Course::where('id', $chapter->course_id)->first();
                                @endphp

                                <div>
                                    <a class="btn btn-info btn-default waves-effect" href="{{route('instructor.courses.content', $course->id)}}"> Back</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

