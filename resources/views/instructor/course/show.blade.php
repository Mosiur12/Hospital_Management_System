@extends('instructor.master')

@section('title', 'Courses Details')

@section('main-content')
    <div class="row">
        <div class="col-sm-12">
            <div class="page-header-title">
                <h4 class="pull-left page-title">Course Details</h4>
                <ol class="breadcrumb pull-right">
                    <li><a href="{{route('instructor.dashboard')}}">Dashboard</a></li>
                    <li><a href="{{route('instructor.courses.index')}}">All Course's</a></li>
                    <li class="active">Course Details</li>
                </ol>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>

    <div class="row m-b-15">
        <div class="col-sm-12">
            <a class="btn btn-primary" href="{{route('instructor.courses.create')}}"><i class="fa fa-plus"></i> Create New Course</a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">{{$course->title}}</h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-4"><img src="{{asset($course->image)}}" class="img-responsive" alt=""></div>
                        <div class="col-md-8">
                            <div class="panel panel-primary">
                                <div class="panel-heading"><h3 class="panel-title">Course Details</h3></div>

                                <div class="panel-body">
                                    <form class="form-horizontal" role="form">
                                        <div class="form-group">
                                            <label class="control-label">Name</label>
                                            <div>
                                                <input type="text" class="form-control" value="{{$course->title}}" readonly>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label">Release Date</label>
                                            <div>
                                                <input type="text" class="form-control" value="{{ \Carbon\Carbon::parse($course->created_at)->format("j S F Y")}}  && {{\Carbon\Carbon::parse($course->created_at)->format("h:i a")}}" readonly>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label">Approved Status</label>
                                            <div>
                                                <input type="text" class="form-control" value="{{$course->is_approve ? 'Approve':'Pending'}}" readonly>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label">Status</label>
                                            <div>
                                                <input type="text" class="form-control" value="{{$course->status ? 'Active':'Inactive'}}" readonly>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label">Short Description</label>
                                            <div class="text-justify">
                                                    {{$course->short_desc}}
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label">Course Details</label>
                                            <div class="text-justify">
                                                {!! $course->course_details !!}
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label" for="example-email">Category</label>
                                            <div>
                                                <input type="text" id="example-email" name="example-email" class="form-control" value="{{$course->category_id}}" readonly>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label" for="example-email">Instructor</label>
                                            <div>
                                                <input type="text" id="example-email" name="example-email" class="form-control" value="{{$course->instructor_id}}" readonly>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label" for="example-email">Course Fee</label>
                                            <div>
                                                <input type="text" id="example-email" name="example-email" class="form-control" value="{{$course->course_fee}}" readonly>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label" for="example-email">Offer Fee</label>
                                            <div>
                                                <input type="text" id="example-email" name="example-email" class="form-control" value="{{$course->offer_price}}" readonly>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label" for="example-email">Total student</label>
                                            <div>
                                                <input type="text" id="example-email" name="example-email" class="form-control" value="{{$course->total_student}}" readonly>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label" for="example-email">Total Chapter</label>
                                            <div>
                                                <input type="text" id="example-email" name="example-email" class="form-control" value="{{$course->chapter}}" readonly>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label" for="example-email">Total Lecture</label>
                                            <div>
                                                <input type="text" id="example-email" name="example-email" class="form-control" value="{{$course->lecture}}" readonly>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label" for="example-email">Total Video</label>
                                            <div>
                                                <input type="text" id="example-email" name="example-email" class="form-control" value="{{$course->total_video}}" readonly>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label" for="example-email">Total Quiz</label>
                                            <div>
                                                <input type="text" id="example-email" name="example-email" class="form-control" value="{{$course->total_quiz}}" readonly>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div>
                                                <a href="{{route('instructor.courses.index')}}" class="btn btn-info waves-effect waves-light">Back</a>
                                                <a href="{{route('instructor.courses.edit', $course->id)}}" class="btn btn-warning">Edit</a>
                                                <a href="{{route('instructor.courses.content', $course->id)}}" class="btn btn-success waves-effect waves-light">Continue course</a>
                                            </div>
                                        </div>
                                    </form>
                                </div> <!-- panel-body -->
                            </div> <!-- panel -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection



@push('js')
    <script type="text/javascript">
        function deleteCourse(id)
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
                text: "You won't be able to revert this!",
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
                        'Your imaginary data is safe :)',
                        'error'
                    )
                }
            })
        }
    </script>
@endpush
