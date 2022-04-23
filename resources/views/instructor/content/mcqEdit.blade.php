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
                    <h3 class="panel-title">Edit Quiz Option</h3>
                </div>

                <div class="panel-body">
                    <div class="row">
                        <div class="col-xs-12">
                            <form role="form" action="{{route('instructor.questions.update', $question->id)}}" method="post" enctype="multipart/form-data">
                                @csrf
                                @method('put')

                                @if($question->question)
                                    <div class="form-group" id="textField">
                                        <label for="question">Question Title</label>
                                        <input type="text" name="question" value="{{$question->question}}" class="form-control @error('question') is-invalid @enderror" id="ex1" placeholder="Enter Quiz title">
                                    </div>
                                    @error('question')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                @endif


                                @if($question->image)
                                    <div>
                                        <img style="width: 200px; height: 100px;" src="{{asset($question->image)}}" alt="">
                                    </div>
                                    <div class="form-group" id="fileField">
                                        <label for="audio">Question File</label>
                                        <input type="file" name="file" value="{{ old('file') }}" class="form-control @error('file') is-invalid @enderror">
                                    </div>
                                @endif

                                @foreach($options as $key=>$option)
                                    <input type="hidden" name="option_id[]" value="{{$option->id}}">
                                    <div class="form-group">
                                        <label for="form-field-2">Option {{$key+1}} </label>
                                        <div>
                                            <input type="text" id="form-field-2" placeholder="Option" value="{{$option->option}}" class="form-control" name="option[]" required="" />
                                        </div>
                                    </div>
                                @endforeach


                                <div class="form-group">
                                    <label for="form-field-2">Right Answer</label>
                                    <div>
                                        <input type="text" id="form-field-2" value="{{$question->answer}}" placeholder="Right Answer" class="form-control" name="answer" required="" />
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="form-field-2">Note : </label>
                                    <div>
                                        <input type="text" value="{{$question->note}}" id="form-field-2" placeholder=" Note " class="form-control" name="note"   />
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="status">Mcq Quiz Status</label>
                                    <br>
                                    @php
                                        if(old('status')){
                                            $status = old('status');
                                        }else{
                                            $status = $question->status;
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

