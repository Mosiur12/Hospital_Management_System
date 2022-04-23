@extends('student.master')

@section('title', 'Create Review')

@section('main-content')
    <div class="row">
        <div class="col-sm-12">
            <div class="page-header-title">
                <h4 class="pull-left page-title">Create Review</h4>
                <ol class="breadcrumb pull-right">
                    <li><a href="{{route('student.dashboard')}}">Dashboard</a></li>
                    <li class="active">Create Review</li>
                </ol>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-primary">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-xs-12">
                            <form role="form" action="{{route('student.reviews.store')}}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="name">Comment Title</label>
                                    <input type="text" name="title" value="{{ old('title') }}" class="form-control @error('title') is-invalid @enderror" id="ex1" placeholder="Enter Comment Title">
                                </div>
                                @error('title')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror

                                <div class="form-group">
                                    <label for="comment">Comment</label>
                                    <input type="text" name="comment" value="{{ old('comment') }}" class="form-control @error('comment') is-invalid @enderror" id="ex1" placeholder="Enter course comment">
                                </div>
                                @error('comment')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror

                                <div class="form-group">
                                    <label for="rating">Course Rating (Out of 5)</label>
                                    <input type="text" name="rating" value="{{ old('rating') }}" class="form-control @error('rating') is-invalid @enderror" id="ex1" placeholder="Enter course rating out of five">
                                </div>
                                @error('rating')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror

                                <input type="hidden" name="course_id" value="{{$course_id}}"/>

                                <button type="submit" class="btn btn-success waves-effect waves-light">Submit</button>
                                <a href="{{route('student.courses.index')}}" class="btn btn-info waves-effect waves-light">Back</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
