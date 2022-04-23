@extends('instructor.master')

@section('title', 'MCQ Quiz Details')
@push('css')
    <link href="{{asset('/')}}assets/plugins/datatables/buttons.bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="{{asset('/')}}assets/plugins/datatables/fixedHeader.bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="{{asset('/')}}assets/plugins/datatables/scroller.bootstrap.min.css" rel="stylesheet" type="text/css" />
@endpush

@push('js_first')
    <script src="{{asset('/')}}assets/plugins/datatables/dataTables.buttons.min.js"></script>
    <script src="{{asset('/')}}assets/plugins/datatables/buttons.bootstrap.min.js"></script>
    <script src="{{asset('/')}}assets/plugins/datatables/jszip.min.js"></script>
    <script src="{{asset('/')}}assets/plugins/datatables/pdfmake.min.js"></script>
    <script src="{{asset('/')}}assets/plugins/datatables/vfs_fonts.js"></script>
    <script src="{{asset('/')}}assets/plugins/datatables/buttons.html5.min.js"></script>
    <script src="{{asset('/')}}assets/plugins/datatables/buttons.print.min.js"></script>
    <script src="{{asset('/')}}assets/plugins/datatables/dataTables.fixedHeader.min.js"></script>
    <script src="{{asset('/')}}assets/plugins/datatables/dataTables.keyTable.min.js"></script>
    <script src="{{asset('/')}}assets/plugins/datatables/dataTables.scroller.min.js"></script>

    <!-- Datatable init js -->
    <script src="{{asset('/')}}assets/pages/datatables.init.js"></script>
@endpush

@section('main-content')
    <div class="row">
        <div class="col-sm-12">
            <div class="page-header-title">
                <h4 class="pull-left page-title">MCQ Quiz Details</h4>
                <ol class="breadcrumb pull-right">
                    <li><a href="{{route('instructor.dashboard')}}">Dashboard</a></li>
                    <li class="active">MCQ Quiz Details</li>
                </ol>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">MCQ Quiz Details</h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Time</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{$mcqQuiz->title}}</td>
                                    <td>{{$mcqQuiz->time}}</td>
                                    <td>{{$mcqQuiz->status ? 'Active':'inactive'}}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>


                    <div class="row m-b-15">
                        <button type="button" class="btn btn-info waves-effect waves-light" data-toggle="modal" data-target="#createMcqQuestionModal"><i class="fa fa-plus"></i> Create New Question</button>
                    </div>

                    <div class="row">
                        <table id="datatable-buttons" class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th>#SL</th>
                                <th>Title</th>
                                <th>Option</th>
                                <th>Answer</th>
                                <th style="width: 25%;">Image</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(empty($questions) )
                                <tr>
                                    <td class="text-warning" style="font-size: 20px"><i class="fa fa-warning"></i> No question Found</td>
                                </tr>
                            @else
                                @foreach($questions as $key=>$question)
                                    @php
                                        $options = \App\Option::where('questions_id' ,$question->id)->inRandomOrder()->get();
                                    @endphp
                                    <tr>
                                        <td>{{$key+1}}</td>
                                        <td>{{$question->question}}</td>
                                        <td>
                                            @foreach($options as $option)
                                                {{$option->option}} <span>,</span>
                                            @endforeach
                                        </td>
                                        <td>{{$question->answer}}</td>
                                        <td>
                                            @if($question->image != null)
                                                <img style="width:100%; height: 100px;" src="{{asset($question->image)}}" alt="">
                                            @else
                                                <span>No image</span>
                                            @endif
                                        </td>
                                        <td><span class="label {{$question->status ? 'label-success':'label-warning'}}">{{$question->status ? 'Active':'Inactive'}}</span></td>
                                        <td>
                                            <a href="{{route('instructor.questions.edit', $question->id)}}" class="btn btn-success"><i class="fa fa-edit"></i></a>
                                            <button class="btn btn-danger" type="button" onclick="deleteQuestion({{$question->id}})">
                                                <i class="fa fa-trash-o"></i>
                                            </button>
                                            <form id="delete_from_{{$question->id}}" style="display: none" action="{{route('instructor.questions.destroy', $question->id)}}" method="post">
                                                @csrf
                                                @method('delete')
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('instructor.partial.question_create_modal')

@endsection

@push('js')
    <script type="text/javascript">
        function deleteQuestion(id)
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
    </script>
@endpush

@push('js_last')
    <script>
        $(document).ready(function(){
            $('input[type="checkbox"]').click(function(){
                if($(this).prop("checked") == true){
                    $("#textField").css("display","none");
                    $("#fileField").css("display","block");
                }
                else if($(this).prop("checked") == false){
                    $("#textField").css("display","block");
                    $("#fileField").css("display","none");
                }
            });
        });
    </script>
@endpush
