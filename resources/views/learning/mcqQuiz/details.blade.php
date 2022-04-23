@extends('learning.master')

@section('title', 'Quiz Details')

@section('main-content')
    <div class="row">
        <div class="col-sm-12">
            <div class="page-header-title">
                <h4 class="pull-left page-title">{{$quiz->title}}</h4>
                <ol class="breadcrumb pull-right">
                    <li><a href="{{route('student.dashboard')}}">Dashboard</a></li>
                    <li><a href="{{route('student.courses.index')}}">All course</a></li>
                    <li class="active">Quiz Details</li>
                </ol>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-primary">
                <div class="panel-heading"><h3 class="panel-title">{{$quiz->title}}</h3></div>
                <div class="panel-body w-100">
                    <div class="row">
                        <div class="col-xs-12">
                            <table class="table table-striped table-bordered">
                                <thead>
                                <tr>
                                    <th>Total Marks</th>
                                    <th>Your Marks</th>
                                    <th>Right answer</th>
                                    <th>Wrong answer</th>
                                    <th>Date</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>{{$result->yes_ans + $result->no_ans}}</td>
                                    <td>{{$result->yes_ans}}</td>
                                    <td>{{$result->yes_ans}}</td>
                                    <td>{{$result->no_ans}}</td>
                                    <td>{{$result->date}}</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12">
                            @foreach($questions as $key=>$ques)
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
                                <p><b>Answer:</b> {{$ques->answer}}</p>
                                <div class="alert alert-success" role="alert">
                                    Note: {{$ques->note}}
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
