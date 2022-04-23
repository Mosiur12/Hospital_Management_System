@extends('instructor.master')

@section('title', 'Quiz Edit')

@section('main-content')
    <div class="row">
        <div class="col-sm-12">
            <div class="page-header-title">
                <h4 class="pull-left page-title">Lecture Edit</h4>
                <ol class="breadcrumb pull-right">
                    <li><a href="{{route('instructor.dashboard')}}">Dashboard</a></li>
                    <li><a href="{{route('instructor.courses.index')}}">All Course</a></li>
                    <li class="active">Lecture Edit</li>
                </ol>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">Edit Quiz</h3>
                </div>

                <div class="panel-body">
                    <div class="row">
                        <div class="col-xs-12">
                            <form role="form" action="{{route('instructor.quizzes.update', $quiz->id)}}" method="post" enctype="multipart/form-data">
                                @csrf
                                @method('put')


                                <div class="form-group">
                                    <label for="title">Quiz Title</label>
                                    <input type="text" name="title" value="{{$quiz->title ? $quiz->title : old('title') }}" class="form-control @error('title') is-invalid @enderror" id="ex1" placeholder="Enter Quiz title">
                                </div>
                                @error('title')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror

                                <div class="form-group">
                                    <label for="marks">Quiz Marks</label>
                                    <input type="text" name="marks" value="{{$quiz->marks ? $quiz->marks : old('marks') }}" class="form-control @error('marks') is-invalid @enderror" id="ex1" placeholder="Enter Quiz marks">
                                </div>
                                @error('marks')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror

                                <div class="form-group">
                                    <label for="marks">Quiz Time (Minutes)</label>
                                    <input type="text" name="time" value="{{$quiz->time ? $quiz->time : old('time') }}" class="form-control @error('time') is-invalid @enderror" id="ex1" placeholder="Enter Quiz time in minutes">
                                </div>
                                @error('time')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror

                                <div class="form-group">
                                    <label for="audio">Question File</label>
                                    <div>
                                        <a href="{{asset($quiz->file)}}" target="_blank">{{$quiz->title}}</a>
                                    </div>
                                    <input type="file" name="file" value="{{ old('file') }}" class="form-control @error('file') is-invalid @enderror">
                                </div>
                                @error('file')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror

                                <div class="form-group">
                                    <label for="status">Quiz Status</label>
                                    <br>
                                    @php
                                        if(old('status')){
                                            $status = old('status');
                                        }else{
                                            $status = $quiz->status;
                                        }
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
                                    <button type="submit" class="btn btn-primary waves-effect waves-light">Update</button>
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

