@extends('learning.master')

@section('title', 'Course Content | Final Exam')

@section('main-content')
    <div class="row">
        <div class="col-sm-12">
            <div class="page-header-title">
                <h4 class="pull-left page-title">{{$course->title}}</h4>
                <ol class="breadcrumb pull-right">
                    <li><a href="{{route('student.dashboard')}}">Dashboard</a></li>
                    <li><a href="{{route('student.courses.index')}}">All course</a></li>
                    <li class="active">Final Exam</li>
                </ol>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">{{$course->title}} || Final Exam</h3>
                </div>

                <div class="panel-body">
                    <div id="myMainDiv">
                        <div class="row">
                            <div class="col-md-8">
                                <embed width="100%" height="600px" src="{{asset($final->file)}}">
                            </div>
                            <div class="col-md-4" style="display: inline">
                                <table class="table table-bordered">
                                    <tbody>
                                    <tr>
                                        <td style="width: 30%;">Course Name</td>
                                        <td>{{$course->title}}</td>
                                    </tr>
                                    <tr>
                                        <td style="width: 15%;">Quiz Title</td>
                                        <td>{{$final->title}}</td>
                                    </tr>
                                    <tr>
                                        <td style="width: 15%;">Quiz Marks</td>
                                        <td>{{$final->marks}}</td>
                                    </tr>
                                    <tr>
                                        <td style="width: 15%;">Quiz Time (In Minutes)</td>
                                        <td>{{$final->time}}</td>
                                    </tr>
                                    <tr>
                                        <td>Question Paper</td>
                                        <td><a href="{{asset($final->file)}}" class="btn btn-success" download> <i class="fa fa-download"></i> Question Paper</a></td>
                                    </tr>
                                    <tr>
                                        <td>Submit Answer</td>
                                        <td>
                                            <form role="form" action="{{route('student.course.final.upload')}}" method="post" enctype="multipart/form-data">
                                                @csrf

                                                <input type="file" name="file" value="{{ old('file') }}" class="form-control @error('file') is-invalid @enderror">

                                                @error('file')
                                                <span class="alert alert-danger">{{ $message }}</span>
                                                @enderror
                                                <input type="hidden" name="exam_id" value="{{$final->id}}">
                                                <input type="hidden" name="instructor_id" value="{{$final->instructor_id}}">
                                                <input type="hidden" name="course_id" value="{{$course->id}}">
                                                <button type="submit" class="btn btn-success waves-effect waves-light m-t-10">Submit</button>
                                            </form>

                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Action</td>
                                        <td>
                                            <a href="{{--{{route('student.courses.show', $course->id)}}--}}" class="btn btn-success">Back</a>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="text-center m-t-5" id="divShow" style="display: none">
                        <a href="#" videoid="" id="getVideoId" class="btn btn-primary">Video </a>
                        <a href="#" audioid="" id="getAudio" class="btn btn-success">Audio </a>
                        <a href="#" pdfid="" id="getPdf" class="btn btn-info">PDF </a>
                        <a href="#" id="getppt" class="btn btn-primary" download><i class="fa fa-download"></i> PPT </a>
                        <a href="#" id="resource" class="btn btn-success" download> Resource <i class="fa fa-download"></i></a>
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection

@push('css_second')
    <style>
        .subdrop {
            background: #03a9f4 !important;
        }
        #sidebar-menu > ul > li > a {
            color: #fff;
        }
    </style>
@endpush

@push('js_last')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script>
        jQuery(document).ready(function($){


            // get video
            $("#getVideo").click(function (e) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                    }
                });
                e.preventDefault();

                $("#divShow").css("display", "block");

                let myLink = $(this).attr("myLink");
                let lectureId = $(this).attr("lectureId");

                let lectureLink = $(this).attr("lectureLink");

                let lectureName = $(this).attr("lectureName");
                $('#lectureTitle').html(lectureName);
                $("#courseView").attr("href", lectureLink);





                $("#getAudio").attr("audioid", lectureId);
                $("#getPdf").attr("pdfid", lectureId);
                $("#getPpt").attr("pptid", lectureId);
                $("#getVideoId").attr("videoid", lectureId);

                //let url = 'video/'+lectureId;
                var type = "GET";
                let myData = "";

                $.ajax({
                    type: type,
                    url: myLink,
                    dataType: 'json',
                    success: function (data) {
                        myData = '<video  class="vidchaVideo" muted controls style="width: 100%" height="600px">';
                        myData += '<source src="{{asset('/')}}'+data.video+'">';
                        myData += '</video>';
                        $('#myMainDiv').html(myData);
                        $("#resource").attr("href", '{{asset('/')}}'+data.resource);
                        $("#getppt").attr("href", '{{asset('/')}}'+data.ppt);

                    },
                    error: function (data) {
                        console.log(data);
                    }
                });
            });



            // get audio
            $("#getAudio").click(function (e) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                    }
                });
                e.preventDefault();
                let lectureId = $(this).attr("audioId");
                let myLink = 'http://127.0.0.1:8000/student/audio/'+lectureId;
                var type = "GET";
                let myData = "";

                $.ajax({
                    type: type,
                    url: myLink,
                    dataType: 'json',
                    success: function (data) {
                        myData = '<audio muted controls style="width: 100%">';
                        myData += '<source src="{{asset('/')}}'+data+'">';
                        myData += '</audio>';
                        $('#myMainDiv').html(myData);
                    },
                    error: function (data) {
                        console.log(data);
                    }
                });
            });

            // get pdf
            $("#getPdf").click(function (e) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                    }
                });
                e.preventDefault();
                let lectureId = $(this).attr("pdfid");
                let myLink = 'http://127.0.0.1:8000/student/pdf/'+lectureId;
                var type = "GET";
                let myData = "";

                $.ajax({
                    type: type,
                    url: myLink,
                    dataType: 'json',
                    success: function (data) {
                        myData = '<embed type="application/pdf" width="100%" height="1000px" src="{{asset('/')}}'+data+'">' ;
                        $('#myMainDiv').html(myData);
                    },
                    error: function (data) {
                        console.log(data);
                    }
                });
            });

            // get ppt
            $("#getPpt").click(function (e) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                    }
                });
                e.preventDefault();
                let lectureId = $(this).attr("pptid");
                let myLink = 'http://127.0.0.1:8000/student/ppt/'+lectureId;
                var type = "GET";
                let myData = "";

                $.ajax({
                    type: type,
                    url: myLink,
                    dataType: 'json',
                    success: function (data) {
                        myData = '<embed width="100%" height="100px" src="{{asset('/')}}'+data+'">' ;
                        $('#myMainDiv').html(myData);
                    },
                    error: function (data) {
                        console.log(data);
                    }
                });
            });

            // get video
            $("#getVideoId").click(function (e) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                    }
                });
                e.preventDefault();
                let lectureId = $(this).attr("videoid");
                let myLink = 'http://127.0.0.1:8000/student/video/'+lectureId;
                var type = "GET";
                let myData = "";

                $.ajax({
                    type: type,
                    url: myLink,
                    dataType: 'json',
                    success: function (data) {
                        myData = '<video  class="vidchaVideo" muted controls style="width: 100%" height="600px">';
                        myData += '<source src="{{asset('/')}}'+data.video+'">';
                        myData += '</video>';
                        $('#myMainDiv').html(myData);
                    },
                    error: function (data) {
                        console.log(data);
                    }
                });
            });


            // get pdf
            $("#getQuiz").click(function (e) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                    }
                });
                e.preventDefault();
                let  quizId= $(this).attr("quizId");
                let myLink = 'http://127.0.0.1:8000/student/quiz/'+quizId;
                var type = "GET";
                let myData = "";

                $.ajax({
                    type: type,
                    url: myLink,
                    dataType: 'json',
                    success: function (data) {
                        console.log(data.file)
                        myData = '<embed width="100%" height="2100px" src="{{asset('/')}}'+data.file+'">' ;
                        $('#myMainDiv').html(myData);
                    },
                    error: function (data) {
                        console.log(data);
                    }
                });
            });

            // Lecture Complete
            $("#courseView").click(function (e) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                    }
                });
                e.preventDefault();

                let lectureLink = $(this).attr("href");
                var type = "GET";
                let myData = "";

                $.ajax({
                    type: type,
                    url: lectureLink,
                    dataType: 'json',
                    success: function (data) {
                        alert(data);
                    },
                    error: function (data) {
                        console.log(data);
                    }
                });
            });

        });
    </script>
@endpush
