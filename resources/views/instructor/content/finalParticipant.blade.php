@extends('instructor.master')

@section('title', 'Final Exam Participant List')
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
                <h4 class="pull-left page-title">Final Exam Participant</h4>
                <ol class="breadcrumb pull-right">
                    <li><a href="{{route('instructor.dashboard')}}">Dashboard</a></li>
                    <li class="active">Final Exam Participant</li>
                </ol>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">Final Exam Participant</h3>
                </div>
                <div class="panel-body">

                    <table id="datatable-buttons" class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th>#SL</th>
                            <th>Exam Title</th>
                            <th>Exam Mark</th>
                            <th>Exam Time</th>
                            <th>Student Name</th>
                            <th>Answer Script</th>
                            <th>Mark</th>
                            <th>Submission Date</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(empty($answerScripts) )
                            <tr>
                                <td class="text-warning" style="font-size: 20px"><i class="fa fa-warning"></i> No Answer Script Found</td>
                            </tr>
                        @else
                            @foreach($answerScripts as $key=>$answerScript)
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>{{$exam->title}}</td>
                                    <td>{{$exam->marks}}</td>
                                    <td>{{$exam->time}}</td>
                                    @php
                                    $std = \App\User::where('id', $answerScript->student_id)->pluck('name')->first();
                                    @endphp
                                    <td>{{$std}}</td>
                                    <td><a href="{{asset($answerScript->file)}}" class="btn btn-success" download> <i class="fa fa-download"></i> Answer Script</a></td>
                                    <td>{{$answerScript->marks ? $answerScript->marks : 'Marks Not Upload'}}</td>
                                    <td>{{ \Carbon\Carbon::parse($answerScript->updated_at)->format("j S F Y")}} && {{\Carbon\Carbon::parse($answerScript->updated_at)->format("h:i a")}}</td>
                                    <td><button type="button" class="btn btn-primary waves-effect waves-light" data-toggle="modal" data-target="#finalMarkModel-{{$key}}">Upload Mark</button></td>
                                </tr>
                                @include('instructor.content._final_answer_script_modal')
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('js')
    <script type="text/javascript">
        function deleteInstructor(id)
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
