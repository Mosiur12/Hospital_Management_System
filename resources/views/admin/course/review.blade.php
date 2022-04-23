@extends('admin.master')

@section('title', 'Review List')
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
                <h4 class="pull-left page-title">Review list</h4>
                <ol class="breadcrumb pull-right">
                    <li><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                    <li><a href="{{route('admin.courses.index')}}">Course</a></li>
                    <li class="active">Review list</li>
                </ol>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">Review List</h3>
                </div>
                <div class="panel-body">

                    <table id="datatable-buttons" class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th>#SL</th>
                            <th style="width: 17%;">Course Title</th>
                            <th>Student Name</th>
                            <th>Title</th>
                            <th style="width: 30%;">Comment</th>
                            <th style="width: 5%;">Rating</th>
                            <th style="width: 10%;">Date</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(empty($reviews) )
                            <tr>
                                <td class="text-warning" style="font-size: 20px"><i class="fa fa-warning"></i> No Review Found</td>
                            </tr>
                        @else
                            @foreach($reviews as $key=>$review)
                                @php
                                    $course = \App\Course::where('id', $review->course_id)->pluck('title')->first();
                                    $user = \App\User::where('id', $review->student_id)->pluck('name')->first();
                                @endphp
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>{{$course}}</td>
                                    <td>{{$user}}</td>
                                    <td>{{$review->title}}</td>
                                    <td>{{$review->comment}}</td>
                                    <td>{{$review->rating}}</td>
                                    <td>{{ \Carbon\Carbon::parse($review->created_at)->format("j S F Y")}}</td>
                                    <td><span class="label {{$review->status ? 'label-success':'label-warning'}}"> {{$review->status ? 'Active':'Inactive'}}</span></td>
                                    <td>
                                        <button class="btn btn-warning" type="button" onclick="updateReviewStatus({{$review->id}})">
                                            <i class="fa fa-edit"></i>
                                        </button>
                                        <form id="update_from_{{$review->id}}" style="display: none" action="{{route('admin.course.review.update', $review->id)}}" method="post">
                                            @csrf
                                            @method('put')
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

        function updateReviewStatus(id)
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
                text: "You won't be able to update this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, update it!',
                cancelButtonText: 'No, cancel!',
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    event.preventDefault();
                    document.getElementById('update_from_'+id).submit();
                    swalWithBootstrapButtons.fire(
                        'Updated!',
                        'Your data has been update',
                        'success'
                    )
                } else if (
                    /* Read more about handling dismissals below */
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    swalWithBootstrapButtons.fire(
                        'Cancelled',
                        'Your imaginary data is safe :)',
                        'error'
                    )
                }
            })
        }
    </script>
@endpush
