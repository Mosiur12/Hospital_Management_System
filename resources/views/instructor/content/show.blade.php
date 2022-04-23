@extends('instructor.master')

@section('title', 'Lecture Details')

@section('main-content')
    <div class="row">
        <div class="col-sm-12">
            <div class="page-header-title">
                <h4 class="pull-left page-title">Lecture Details</h4>
                <ol class="breadcrumb pull-right">
                    <li><a href="{{route('instructor.dashboard')}}">Dashboard</a></li>
                    <li><a href="{{route('instructor.courses.index')}}">All Course</a></li>
                    <li class="active">Lecture View</li>
                </ol>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">Lecture Details</h3>
                </div>

                <div class="panel-body">
                    <div class="row">
                        <div class="col-xs-12">
                            <form>
                                <div class="form-group">
                                    <label for="title">Lecture name</label>
                                    <input type="text" name="name" value="{{$lecture->name}}" class="form-control" id="ex1" placeholder="Enter Chapter name">
                                </div>

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
                                </div>

                                <div class="form-group">
                                    <label for="video">Video File</label>
                                    <div>
                                        <video width="320" height="240" muted controls>
                                            @if($video)
                                                <source src="{{asset($video->file)}}">
                                            @else
                                                <span>No file found</span>
                                            @endif
                                        </video>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label for="pdf">PDF File</label>
                                    <div>
                                        @if($pdf)
                                            <iframe width="1000" height="800" src="{{asset($pdf->file)}}" frameborder="0">Your browser does not support.</iframe>
                                        @else
                                            <span>No file found</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="ppt">PPT File</label>
                                    <div>
                                        @if($ppt)
                                            <a class="btn btn-success" href="{{asset($ppt->file)}}" download> Download <i class="fa fa-download"></i> </a>
                                        @else
                                            <span>No file found</span>
                                        @endif
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label for="resource">Extra Resource</label>
                                    <div class="m-b-10">
                                        @if($resource)
                                            <a class="btn btn-success" href="{{asset($resource->file)}}" download> Download <i class="fa fa-download"></i> </a>
                                        @else
                                            <span>No file found</span>
                                        @endif
                                    </div>
                                </div>

                                <div>
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

