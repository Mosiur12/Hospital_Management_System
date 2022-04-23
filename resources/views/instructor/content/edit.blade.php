@extends('instructor.master')

@section('title', 'Lecture Edit')

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
                    <h3 class="panel-title">Edit Lecture</h3>
                </div>

                <div class="panel-body">
                    <div class="row">
                        <div class="col-xs-12">
                            <form role="form" action="{{route('instructor.lectures.update', $lecture->id)}}" method="post" enctype="multipart/form-data">
                                @csrf
                                @method('put')
                                <div class="form-group">
                                    <label for="title">Lecture name</label>
                                    <input type="text" name="name" value="{{$lecture->name ? $lecture->name : old('name') }}" class="form-control @error('name') is-invalid @enderror" id="ex1" placeholder="Enter Chapter name">
                                </div>
                                @error('name')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror

                                <div class="form-group">
                                    <label for="audio">Audio File</label>
                                    <div>
                                        <audio controls>
                                            @if($audio)
                                                <source src="{{asset($audio->file)}}">
                                            @else
                                                <span>No file found</span>
                                            @endif
                                        </audio>
                                    </div>
                                    <input type="file" name="audio" value="{{ old('audio') }}" class="form-control @error('audio') is-invalid @enderror">
                                </div>
                                @error('audio')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror

                                <div class="form-group">
                                    <label for="video">Video File</label>
                                    <div>
                                        <video width="320" height="240"muted controls>
                                            @if($video)
                                                <source src="{{asset($video->file)}}">
                                            @else
                                                <span>No file found</span>
                                            @endif
                                        </video>
                                    </div>
                                    <input type="file" name="video" value="{{ old('video') }}" class="form-control @error('video') is-invalid @enderror">
                                </div>
                                @error('video')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror

                                <div class="form-group">
                                    <label for="pdf">PDF File</label>
                                    <div>
                                        @if($pdf)
                                            <iframe width="1000" height="800" src="{{asset($pdf->file)}}" frameborder="0">Your browser does not support.</iframe>
                                        @else
                                            <span>No file found</span>
                                        @endif
                                    </div>
                                    <input type="file" name="pdf" value="{{ old('pdf') }}" class="form-control @error('pdf') is-invalid @enderror">
                                </div>
                                @error('pdf')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror

                                <div class="form-group">
                                    <label for="ppt">PPT File</label>
                                    <div>
                                        @if($ppt)
                                            <a class="btn btn-success" href="{{asset($ppt->file)}}" download> Download <i class="fa fa-download"></i> </a>
                                        @else
                                            <span>No file found</span>
                                        @endif
                                    </div>
                                    <input type="file" name="ppt" value="{{ old('ppt') }}" class="form-control @error('ppt') is-invalid @enderror">
                                </div>
                                @error('ppt')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror

                                <div class="form-group">
                                    <label for="resource">Extra Resource</label>
                                    <div class="m-b-10">
                                        @if($resource)
                                            <a class="btn btn-success" href="{{asset($resource->file)}}" download> Download <i class="fa fa-download"></i> </a>
                                        @else
                                            <span>No file found</span>
                                        @endif
                                    </div>
                                    <input type="file" name="resource" value="{{ old('resource') }}" class="form-control @error('resource') is-invalid @enderror">
                                </div>
                                @error('resource')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror

                                <input type="hidden" name="lecture_id" value="{{$lecture->id}}">

                                <div>
                                    <button type="submit" class="btn btn-primary waves-effect waves-light">Update</button>
                                    <a class="btn btn-info btn-default waves-effect" href="{{route('instructor.courses.content', $chapter->course_id)}}"> Back</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

