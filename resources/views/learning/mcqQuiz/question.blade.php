@extends('learning.master')

@section('title', 'MCQ Quiz Question')

@section('main-content')
    <div class="row">
        <div class="col-sm-12">
            <div class="page-header-title">
                <h4 class="pull-left page-title">{{"question"}}</h4>
                <ol class="breadcrumb pull-right">
                    <li><a href="{{route('student.dashboard')}}">Dashboard</a></li>
                    <li><a href="{{route('student.courses.index')}}">All course</a></li>
                    <li class="active">MCQ Quiz Question</li>
                </ol>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>

    <div class="row" oncopy="return false;" oncut="return false;" onpaste="return false;" oncontextmenu="return false;">
        <div class="col-sm-12">
            <div class="panel panel-primary">
                <div class="panel-heading"><h3 class="panel-title">{{$quiz->title}}</h3></div>
                <div class="panel-body w-100">
                    <div class="row">
                        <div class="col-xs-12">
                            @if($questions->count()>0)
                                <div class="icon-bar" >
                                    <button class="btn btn-lg bg-primary">Exam Time CountDown : <span class="js-timeout" style="font-weight: bold"></span>  </button>
                                </div>
                            <form id="quizForm" role="form" action="{{route('student.quiz.exam')}}" method="post">
                                @csrf
                                @foreach($questions as $key=>$ques)
                                    <input type="hidden" name="questions_id{{$key+1}}" value="{{$ques->id}}">
                                    <input type="hidden" name="ans{{$key+1}}" value="emptyValue">
                                    @if($ques->image)
                                        {{$key+1}}. Question Image <br/>
                                        <img style="height: 200px; width: 500px;" src="{{asset($ques->image)}}" alt="">
                                    @else
                                        <h5 > {{$key+1}}. {{$ques->question}}</h5>
                                    @endif
                                    <ol   class="ul-list"  style="list-style-type: lower-alpha;" >
                                        @foreach($ques->options as $opt)
                                            <li><input type="radio" name="ans{{$key+1}}" value="{{$opt->option}}" /> {{$opt->option}}   </li>
                                        @endforeach
                                    </ol>
                                @endforeach
                                    <input type="hidden" name="index" value="<?php echo $key+1 ?>">
                                    <input type="hidden" name="quizes_id" value="{{$quiz->id}}">
                                    <button type="submit" class="btn btn-success waves-effect waves-light">Submit</button>
                            </form>
                            @else
                                <h2 style="color: red;"> Opps! No Data Found</h2>
                            @endif
                        </div>
                    </div>
                </div>
            </div> <!-- panel -->

        <!--            <div class="row">
                <div class="col-sm-12">
                    <a href="{{--{{route('student.course.quiz', 2)}}--}}" class="btn btn-primary">test </a>
                </div>
            </div>-->
        </div> <!-- col -->
    </div>
@endsection

@push('css_second')
    <style>
        .icon-bar {
            position: fixed;
            top: 50%;
            right: 20%;
            z-index: 9999;
            transform: translateY(-50%);
        }
        @media only screen and (max-width: 800px) {
            .icon-bar {
                position: fixed;
                top:95%;
                right:0;
                z-index: 9999;
                transform: translateY(-50%);
            }
        }

        .icon-bar a {
            display: block;
            text-align: center;
            padding: 16px;
            transition: all 0.3s ease;
            color: white;
            font-size: 20px;
        }

        .icon-bar a:hover {
            background-color: #000;
        }
    </style>
@endpush

@push('js_last')
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" ></script>
    <script type="text/javascript">
        var interval;
        var form=document.forms.exam;
        function countdown() {
            clearInterval(interval);

            interval = setInterval( function() {
                var timer = $('.js-timeout').html();
                timer = timer.split(':');
                var minutes = timer[0];
                var seconds = timer[1];
                seconds -= 1;
                if (minutes < 0) return;
                else if (seconds < 0 && minutes != 0) {
                    minutes -= 1;
                    seconds = 59;
                }
                else if (seconds < 10 && length.seconds != 2) seconds = '0' + seconds;

                $('.js-timeout').html(minutes + ':' + seconds);

                if (minutes == 0 && seconds == 0) { clearInterval(interval);  $('#quizForm').submit();}
            }, 1000);
        }

        $('.js-timeout').text("{{date("H:i:s", $quiz->time*60*60)}}");
        countdown();
    </script>
@endpush
