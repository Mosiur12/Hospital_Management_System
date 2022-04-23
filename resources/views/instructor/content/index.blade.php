@extends('instructor.master')

@section('title', 'Course Content')

@section('main-content')
    <div class="row">
        <div class="col-sm-12">
            <div class="page-header-title">
                <h4 class="pull-left page-title">Course content</h4>
                <ol class="breadcrumb pull-right">
                    <li><a href="{{route('instructor.dashboard')}}">Dashboard</a></li>
                    <li><a href="{{route('instructor.courses.index')}}">Courses</a></li>
                    <li class="active">Course content</li>
                </ol>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">{{$course_name}}</h3>
                </div>

                <div class="row m-t-15 m-l-15 m-r-15">
                    <div class="col-lg-12">
                        <div class="panel-group" id="accordion-test-2">
                            @foreach($chapters as $key => $chapter)
                                <div class="panel panel-info panel-color">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a data-toggle="collapse" data-parent="#accordion-test-2" href="#collapse-{{$key}}" class="collapsed" aria-expanded="false" style="display: inline">
                                            {{$key+1}} <span>.</span> {{$chapter->name}}
                                            </a>
                                            <a style="display: inline">
                                                <button type="button" class="btn btn-sm btn-warning waves-effect waves-light" data-toggle="modal" data-target="#editChapterModal{{$key}}"><i class="fa fa-edit"></i></button>
                                            </a>
                                            <button class="btn btn-danger" type="button" onclick="deleteChapter({{$chapter->id}})" style="display: inline;">
                                                <i class="fa fa-trash-o"></i>
                                            </button>
                                            <form id="delete_from_{{$chapter->id}}" style="display: none" action="{{route('instructor.chapters.destroy', $chapter->id)}}" method="post">
                                                @csrf
                                                @method('delete')
                                            </form>
                                        </h4>
                                    </div>
                                    <div id="collapse-{{$key}}" class="panel-collapse collapse">
                                        <div class="panel-body">
                                            <table class="table table-bordered">
                                                <p>Course Lecture</p>
                                                <tbody>
                                                @php
                                                    $lectures = \App\Lecture::where('chapter_id', $chapter->id)->get();
                                                @endphp
                                                @if($lectures->count() > 0)
                                                    @foreach($lectures as $key=>$lecture)
                                                        <tr>
                                                            <td style="width: 80%;">{{$key+1}}. {{$lecture->name}}</td>
                                                            <td>
                                                                <a href="{{route('instructor.lectures.show', $lecture->id)}}" class="btn btn-success"><i class="fa fa-eye"></i></a>
                                                                <a href="{{route('instructor.lectures.edit', $lecture->id)}}" class="btn btn-warning"><i class="fa fa-edit"></i></a>
                                                                <button class="btn btn-danger" type="button" onclick="deleteLecture({{$lecture->id}})">
                                                                    <i class="fa fa-trash-o"></i>
                                                                </button>
                                                                <form id="lecture_delete_from_{{$lecture->id}}" style="display: none" action="{{route('instructor.lectures.destroy', $lecture->id)}}" method="post">
                                                                    @csrf
                                                                    @method('delete')
                                                                </form>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                @else
                                                    <span class="text-warning">No lectures found</span>
                                                @endif
                                                </tbody>
                                            </table>
                                            <table class="table table-bordered">
                                                <p>Course Quiz</p>
                                                <tbody>
                                                @php
                                                    $quizzes = \App\Quiz::where('chapter_id', $chapter->id)->get();
                                                @endphp
                                                @if($quizzes->count() > 0)
                                                    @foreach($quizzes as $key=>$quiz)
                                                    <tr>
                                                        <td style="width: 80%;">{{$key+1}}. {{$quiz->title}}</td>
                                                        <td>
                                                            <a href="{{route('instructor.quizzes.show', $quiz->id)}}" class="btn btn-success"><i class="fa fa-eye"></i></a>
                                                            <a href="{{route('instructor.quizzes.edit', $quiz->id)}}" class="btn btn-warning"><i class="fa fa-edit"></i></a>
                                                            <a href="{{route('instructor.course.quiz.participants', $quiz->id)}}" class="btn btn-info"><i class="fa fa-users"></i></a>
                                                            <button class="btn btn-danger" type="button" onclick="deleteQuiz({{$quiz->id}})">
                                                                <i class="fa fa-trash-o"></i>
                                                            </button>
                                                            <form id="quiz_delete_from_{{$quiz->id}}" style="display: none" action="{{route('instructor.quizzes.destroy', $quiz->id)}}" method="post">
                                                                @csrf
                                                                @method('delete')
                                                            </form>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                @else
                                                    <span class="text-warning">No Quiz found</span>
                                                @endif
                                                </tbody>
                                            </table>

                                            <table class="table table-bordered">
                                                <p>Course MCQ Quiz</p>
                                                <tbody>
                                                @php
                                                    $mcqQuizzes = \App\McqQuiz::where('chapter_id', $chapter->id)->get();
                                                @endphp
                                                @if($mcqQuizzes->count() > 0)
                                                    @foreach($mcqQuizzes as $k=>$quiz)
                                                        <tr>
                                                            <td style="width: 80%;">{{$key+1}}. {{$quiz->title}}</td>
                                                            <td>
                                                                <a href="{{route('instructor.mcqQuizzes.show', $quiz->id)}}" class="btn btn-success"><i class="fa fa-eye"></i></a>
                                                                <a href="{{route('instructor.mcqQuizzes.edit', $quiz->id)}}" class="btn btn-warning"><i class="fa fa-edit"></i></a>
                                                                <a href="{{route('instructor.course.quiz.participants', $quiz->id)}}" class="btn btn-info"><i class="fa fa-users"></i></a>
                                                                <button class="btn btn-danger" type="button" onclick="deleteMcqQuiz({{$quiz->id}})">
                                                                    <i class="fa fa-trash-o"></i>
                                                                </button>
                                                                <form id="mcq_quiz_delete_from_{{$quiz->id}}" style="display: none" action="{{route('instructor.mcqQuizzes.destroy', $quiz->id)}}" method="post">
                                                                    @csrf
                                                                    @method('delete')
                                                                </form>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                @else
                                                    <span class="text-warning">No MCQ Quiz found</span>
                                                @endif
                                                </tbody>
                                            </table>

                                            <div class="row m-r-15 m-b-15 p-b-10">
                                                <button type="button" class="btn btn-info waves-effect waves-light" data-toggle="modal" data-target="#createLectureModal-{{$chapter->id}}"><i class="fa fa-plus"></i> Create New Lecture</button>
                                                <button type="button" class="btn btn-info waves-effect waves-light" data-toggle="modal" data-target="#createQuizModal-{{$chapter->id}}"><i class="fa fa-plus"></i> Create New Quiz</button>
                                                <button type="button" class="btn btn-info waves-effect waves-light" data-toggle="modal" data-target="#createMCQQuizModal-{{$chapter->id}}"><i class="fa fa-plus"></i> Create New MCQ Quiz</button>
                                            </div>
                                            @include('instructor.partial.lecture_create_modal')
                                            @include('instructor.partial.quiz_create_modal')
                                            @include('instructor.partial.mcq_quiz_create_modal')
                                        </div>
                                    </div>
                            </div>
                            @endforeach
                                <div class="panel panel-info panel-color">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a data-toggle="collapse" data-parent="#accordion-test-2" href="#collapse-final" class="collapsed" aria-expanded="false" style="display: inline">
                                                 <span>1.</span> <span>Final Exam</span>
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="collapse-final" class="panel-collapse collapse">
                                        <div class="panel-body">
                                            <table class="table table-bordered">
                                                <p>Final Exam</p>
                                                <tbody>
                                                @php
                                                    $final =  \App\FinalExam::where('course_id', $course_id)->where('instructor_id', \Illuminate\Support\Facades\Auth::user()->id)->first();
                                                @endphp
                                                @if($final)
                                                    <tr>
                                                        <td style="width: 80%;">1. {{$final->title}}</td>
                                                        <td>
                                                            <a href="{{route('instructor.finals.show', $final->id)}}" class="btn btn-success"><i class="fa fa-eye"></i></a>
                                                            <a href="{{route('instructor.finals.edit', $final->id)}}" class="btn btn-warning"><i class="fa fa-edit"></i></a>
                                                            <a href="{{route('instructor.course.finals.participants', $final->id)}}" class="btn btn-info"><i class="fa fa-users"></i></a>
                                                            <button class="btn btn-danger" type="button" onclick="deleteFinal({{$final->id}})">
                                                                <i class="fa fa-trash-o"></i>
                                                            </button>
                                                            <form id="delete_final_exam_from_{{$final->id}}" style="display: none" action="{{route('instructor.finals.destroy', $final->id)}}" method="post">
                                                                @csrf
                                                                @method('delete')
                                                            </form>
                                                        </td>
                                                    </tr>
                                                @else
                                                    <span class="text-warning">No Exam found</span>
                                                @endif
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>

                <div class="row m-l-15 m-r-15 m-b-15 p-b-10">
                    <button type="button" class="btn btn-info waves-effect waves-light" data-toggle="modal" data-target="#createChapterModal"><i class="fa fa-plus"></i> Create New Chapter</button>
                    <button type="button" class="btn btn-info waves-effect waves-light" data-toggle="modal" data-target="#createFinalExamModal"><i class="fa fa-plus"></i> Create Final Exam</button>
                </div>

                {{--chapter Create model start--}}
                @include('instructor.partial.chapter_create_model')
                {{--chapter Create model end--}}

                {{--final exam Create model start--}}
                @include('instructor.partial.final_exam_create_model')
                {{--final exam Create model end--}}


                {{--Chapter edit model start--}}
                @include('instructor.partial.chapter_edit_model')
                {{--Chapter edit model end--}}

            </div>
        </div>
    </div>

@endsection

@push('js')
    <script type="text/javascript">
        function deleteChapter(id)
        {
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false
            })

            swalWithBootstrapButtons.fire({
                title: 'Are you sure?',
                text: "You won't be able to delete this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!',
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    event.preventDefault();
                    document.getElementById('delete_from_'+id).submit();
                    swalWithBootstrapButtons.fire(
                        'Deleted!',
                        'Your data has been deleted',
                        'success'
                    )
                } else if (
                    /* Read more about handling dismissals below */
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    swalWithBootstrapButtons.fire(
                        'Cancelled',
                        'Your data is safe :)',
                        'error'
                    )
                }
            })
        }

        function deleteLecture(id)
        {
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false
            })

            swalWithBootstrapButtons.fire({
                title: 'Are you sure?',
                text: "You won't be able to delete this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!',
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    event.preventDefault();
                    document.getElementById('lecture_delete_from_'+id).submit();
                    swalWithBootstrapButtons.fire(
                        'Deleted!',
                        'Your data has been deleted',
                        'success'
                    )
                } else if (
                    /* Read more about handling dismissals below */
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    swalWithBootstrapButtons.fire(
                        'Cancelled',
                        'Your data is safe :)',
                        'error'
                    )
                }
            })
        }

        function deleteQuiz(id)
        {
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false
            })

            swalWithBootstrapButtons.fire({
                title: 'Are you sure?',
                text: "You won't be able to delete this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!',
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    event.preventDefault();
                    document.getElementById('quiz_delete_from_'+id).submit();
                    swalWithBootstrapButtons.fire(
                        'Deleted!',
                        'Your data has been deleted',
                        'success'
                    )
                } else if (
                    /* Read more about handling dismissals below */
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    swalWithBootstrapButtons.fire(
                        'Cancelled',
                        'Your data is safe :)',
                        'error'
                    )
                }
            })
        }

        function deleteMcqQuiz(id)
        {
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false
            })

            swalWithBootstrapButtons.fire({
                title: 'Are you sure?',
                text: "You won't be able to delete this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!',
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    event.preventDefault();
                    document.getElementById('mcq_quiz_delete_from_'+id).submit();
                    swalWithBootstrapButtons.fire(
                        'Deleted!',
                        'Your data has been deleted',
                        'success'
                    )
                } else if (
                    /* Read more about handling dismissals below */
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    swalWithBootstrapButtons.fire(
                        'Cancelled',
                        'Your data is safe :)',
                        'error'
                    )
                }
            })
        }

        function deleteFinal(id)
        {
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false
            })

            swalWithBootstrapButtons.fire({
                title: 'Are you sure?',
                text: "You won't be able to delete this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!',
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    event.preventDefault();
                    document.getElementById('delete_final_exam_from_'+id).submit();
                    swalWithBootstrapButtons.fire(
                        'Deleted!',
                        'Your data has been deleted',
                        'success'
                    )
                } else if (
                    /* Read more about handling dismissals below */
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    swalWithBootstrapButtons.fire(
                        'Cancelled',
                        'Your data is safe :)',
                        'error'
                    )
                }
            })
        }


    </script>
@endpush


