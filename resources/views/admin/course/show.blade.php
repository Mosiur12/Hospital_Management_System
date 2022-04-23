@extends('admin.master')

@section('title', 'Courses Details')

@section('main-content')
    <div class="row">
        <div class="col-sm-12">
            <div class="page-header-title">
                <h4 class="pull-left page-title">Course Details</h4>
                <ol class="breadcrumb pull-right">
                    <li><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                    <li><a href="{{route('admin.courses.index')}}">All Course's</a></li>
                    <li class="active">Course Details</li>
                </ol>
                <div class="clearfix"></div>
            </div>
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
                                            <label class="col-md-2 control-label">Name</label>
                                            <div class="col-md-10">
                                                <input type="text" class="form-control" value="{{$course->title}}" readonly>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-2 control-label">Release Date</label>
                                            <div class="col-md-10">
                                                <input type="text" class="form-control" value="{{ \Carbon\Carbon::parse($course->created_at)->format("j S F Y")}}  && {{\Carbon\Carbon::parse($course->created_at)->format("h:i a")}}" readonly>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-2 control-label">Approved Status</label>
                                            <div class="col-md-10">
                                                <input type="text" class="form-control" value="{{$course->is_approve ? 'Approve':'Pending'}}" readonly>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-2 control-label">Is Featured</label>
                                            <div class="col-md-10">
                                                <input type="text" class="form-control" value="{{$course->is_featured ? 'Featured':'Un Featured'}}" readonly>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-2 control-label">Status</label>
                                            <div class="col-md-10">
                                                <input type="text" class="form-control" value="{{$course->status ? 'Active':'Inactive'}}" readonly>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-2 control-label">Short Description</label>
                                            <div class="col-md-10 text-justify">
                                                    {{$course->short_desc}}
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-2 control-label">Course Details</label>
                                            <div class="col-md-10 text-justify">
                                                {!! $course->course_details !!}
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-2 control-label" for="example-email">Instructor</label>
                                            <div class="col-md-10">
                                                <input type="text" id="example-email" name="example-email" class="form-control" value="{{$course->instructor_id}}" readonly>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-2 control-label" for="example-email">Course Fee</label>
                                            <div class="col-md-10">
                                                <input type="text" id="example-email" name="example-email" class="form-control" value="{{$course->course_fee}}" readonly>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-2 control-label" for="example-email">Offer Fee</label>
                                            <div class="col-md-10">
                                                <input type="text" id="example-email" name="example-email" class="form-control" value="{{$course->offer_price}}" readonly>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-2 control-label" for="example-email">Total student</label>
                                            <div class="col-md-10">
                                                <input type="text" id="example-email" name="example-email" class="form-control" value="{{$course->total_student}}" readonly>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-2 control-label" for="example-email">Total Chapter</label>
                                            <div class="col-md-10">
                                                <input type="text" id="example-email" name="example-email" class="form-control" value="{{$course->chapter}}" readonly>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-2 control-label" for="example-email">Total Lecture</label>
                                            <div class="col-md-10">
                                                <input type="text" id="example-email" name="example-email" class="form-control" value="{{$course->lecture}}" readonly>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-2 control-label" for="example-email">Total Video</label>
                                            <div class="col-md-10">
                                                <input type="text" id="example-email" name="example-email" class="form-control" value="{{$course->total_video}}" readonly>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-2 control-label" for="example-email">Total Quiz</label>
                                            <div class="col-md-10">
                                                <input type="text" id="example-email" name="example-email" class="form-control" value="{{$course->total_quiz}}" readonly>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-2 control-label" for="example-email"></label>
                                            <div class="col-md-10">
                                                <a href="{{route('admin.courses.index')}}" class="btn btn-info waves-effect waves-light">Back</a>
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
