@extends('instructor.master')

@section('title', 'MCQ Quiz Edit')

@section('main-content')
    <div class="row">
        <div class="col-sm-12">
            <div class="page-header-title">
                <h4 class="pull-left page-title">Lecture Edit</h4>
                <ol class="breadcrumb pull-right">
                    <li><a href="{{route('instructor.dashboard')}}">Dashboard</a></li>
                    <li><a href="{{route('instructor.courses.index')}}">All Course</a></li>
                    <li class="active">MCQ Quiz Edit</li>
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
                            <form role="form" action="{{route('instructor.mcqQuizzes.update', $mcqQuiz->id)}}" method="post">
                                @csrf
                                @method('put')

                                <div class="form-group">
                                    <label for="title">MCQ Quiz name</label>
                                    <input type="text" name="title" value="{{$mcqQuiz->title ? $mcqQuiz->title : old('title') }}" class="form-control @error('title') is-invalid @enderror" id="ex1" placeholder="Enter Quiz Name">
                                </div>
                                @error('title')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror

                                <div class="form-group">
                                    <label for="time">MCQ Quiz Time</label>
                                    <input type="text" name="time" value="{{$mcqQuiz->time ? $mcqQuiz->time : old('time') }}" class="form-control @error('time') is-invalid @enderror" id="ex1" placeholder="Enter MCQ Quiz time">
                                </div>
                                @error('time')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror

                                <div class="form-group">
                                    <label for="status">MCQ Quiz Status</label>
                                    <br>
                                    @php
                                        if(old('status')){
                                            $status = old('status');
                                        }else{
                                            $status = $mcqQuiz->status;
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

                                <div>
                                    <button type="submit" class="btn btn-primary waves-effect waves-light">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

