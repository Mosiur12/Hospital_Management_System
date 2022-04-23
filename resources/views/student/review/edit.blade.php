@extends('student.master')

@section('title', 'Review Edit')

@section('main-content')
    <div class="row">
        <div class="col-sm-12">
            <div class="page-header-title">
                <h4 class="pull-left page-title">Review Edit</h4>
                <ol class="breadcrumb pull-right">
                    <li><a href="{{route('student.dashboard')}}">Dashboard</a></li>
                    <li class="active">Review Edit</li>
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
                            <form role="form" action="{{route('student.reviews.update', $review->id)}}" method="post">
                                @csrf
                                @method('put')
                                <div class="form-group">
                                    <label for="name">Comment Title</label>
                                    <input type="text" name="title" value="{{$review->title ? $review->title : old('title') }}" class="form-control @error('title') is-invalid @enderror" id="ex1" placeholder="Enter Comment Title">
                                </div>
                                @error('title')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror

                                <div class="form-group">
                                    <label for="comment">Comment</label>
                                    <input type="text" name="comment" value="{{$review->comment ? $review->comment : old('comment') }}" class="form-control @error('comment') is-invalid @enderror" id="ex1" placeholder="Enter course comment">
                                </div>
                                @error('comment')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror

                                <div class="form-group">
                                    <label for="rating">Course Rating (Out of 5)</label>
                                    <input type="text" name="rating" value="{{$review->rating ? $review->rating : old('rating') }}" class="form-control @error('rating') is-invalid @enderror" id="ex1" placeholder="Enter course rating out of five">
                                </div>
                                @error('rating')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror

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
