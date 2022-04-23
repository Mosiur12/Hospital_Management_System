<div class="left side-menu">
    <div class="sidebar-inner slimscrollleft">
        <div class="user-details" style="border-bottom: 2px solid #262e37;">
            <div class="text-center">
                <img src="{{asset(\Illuminate\Support\Facades\Auth::user()->image)}}" alt="" class="img-circle">
            </div>
            <div class="user-info">
                <div class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">{{\Illuminate\Support\Facades\Auth::user()->name}}</a>
                    <ul class="dropdown-menu">
                        <li><a href="{{route('home')}}"> Home </a></li>
                        <li><a href="{{route('student.dashboard')}}"> Dashboard </a></li>
                        <li><a href="{{route('student.profile')}}"> Profile</a></li>
                        <li class="divider"></li>
                        <li>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </div>

                <p class="text-muted m-0"><i class="fa fa-dot-circle-o text-success"></i> Online</p>
            </div>
        </div>
        <!--- Divider -->
        <div id="sidebar-menu">
            <ul id="chapterNo" class="chapterName">
                @php
                    $chapters = \App\Chapter::where('course_id', session('course_id'))->get();
                    $stdId = \Illuminate\Support\Facades\Auth::user()->id;
                    $lectureCount = 0;
                    $lectureComplete = 0;
                @endphp

                @foreach($chapters as $key=>$chapter)
                <li class="has_sub">
                    <a href="javascript:void(0);" onclick="chapterActive({{$key}})" id="chapter-{{$key}}" class="waves-effect chapterNumber"><i class="fa fa-book"></i><span> {{$chapter->name}} </span><span class="pull-right"><i class="mdi mdi-plus"></i></span></a>
                    <ul class="list-unstyled">
                        @php
                            $lectures = \App\Lecture::where('chapter_id', $chapter->id)->get();
                        @endphp
                        @foreach($lectures as $key=>$lecture)
                            @php
                                $lecattend = \App\Courseview::where('student_id', $stdId)->where('lecture_id', $lecture->id)->first();
                                $lectureCount +=1;
                                if ($lecattend)
                                {
                                    $lectureComplete += 1;
                                }

                            @endphp
                            <li><a href="#" lectureLink="{{route('student.course.view', $lecture->id)}}" myLink="{{route('student.course.video', $lecture->id)}}" id="getVideo" lectureName="{{$lecture->name}}" lectureId="{{$lecture->id}}"><span class="text-info"><i class="{{ $lecattend ? 'fa fa-check':'' }}"></i></span> {{$lecture->name}}</a></li>
                        @endforeach

                        @php
                            $quizzes = \App\Quiz::where('chapter_id', $chapter->id)->where('status', "1")->get();
                        @endphp
                        <div class="divider"></div>
                        @foreach($quizzes as $key=>$quiz)
                            @php
                                $quizattend = \App\Mark::where('quiz_id', $quiz->id)->where('student_id', $stdId)->first();
                                $lectureCount +=1;
                                if ($quizattend)
                                {
                                    $lectureComplete += 1;
                                }
                            @endphp
<!--                            <li><a href="#" id="getQuiz" quizId="{{--{{$quiz->id}}--}}"> {{--{{$quiz->title}}--}}</a></li>-->
                            <li> <a href="{{route('student.course.quiz', [$quiz->id, $chapter->course_id])}}"><span class="text-info"> <i class="{{ $quizattend != null ? 'fa fa-check':'' }}"></i></span> {{$quiz->title}}</a></li>
                        @endforeach

                        @php
                            $mcqQuizzes = \App\McqQuiz::where('chapter_id', $chapter->id)->where('status', "1")->get();
                        @endphp
                        <div class="divider"></div>
                        @foreach($mcqQuizzes as $key=>$quiz)
                            @php
                                $lectureCount +=1;
                                $mcqattend = \App\Results::where('quiz_id', $quiz->id)->where('user_id', \Illuminate\Support\Facades\Auth::user()->id)->first();
                                if ($mcqattend)
                                {
                                    $lectureComplete += 1;
                                }
                            @endphp
                            <li>
                                <a href="{{route('student.myQuiz', $quiz->id)}}"><span class="text-info"><i class="{{ $mcqattend ? 'fa fa-check':'' }}"></i></span> {{$quiz->title}}</a>
                            </li>
                        @endforeach
                    </ul>
                </li>
                @endforeach

                @php
                    $final =  \App\FinalExam::where('course_id', session('course_id'))->first();
                    if ($final){
                        $lectureCount +=1;
                        $finalattend = \App\FinalMark::where('exam_id', $final->id)->where('student_id', \Illuminate\Support\Facades\Auth::user()->id)->first();
                        if ($finalattend)
                        {
                            $lectureComplete += 1;
                        }
                    }
                @endphp
                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect chapterNumber"><i class="fa fa-book"></i><span> Final Exam </span><span class="pull-right"><i class="mdi mdi-plus"></i></span></a>
                    <ul class="list-unstyled">
                        @if($final)
                            <li>
                                <a href="{{route('student.course.final', $final->id)}}"><span class="text-info"><i class="{{ $finalattend ? 'fa fa-check':'' }}"></i></span> {{$final->title}}</a>
                            </li>
                        @else
                            <li>No Exam Found</li>
                        @endif

                    </ul>
                </li>

                @if($lectureCount == $lectureComplete && $lectureCount > 0)
                <li>
                    <a href="{{route('student.course.finish', session('course_id'))}}" class="waves-effect"><i class="fa fa-book"></i><span> Course Complete </span></a>
                </li>
                @endif
            </ul>
        </div>
        <div class="clearfix"></div>
    </div> <!-- end sidebarinner -->
</div>
