@extends('admin.master')

@section('title', 'All Courses')

@section('main-content')
    <div class="row">
        <div class="col-sm-12">
            <div class="page-header-title">
                <h4 class="pull-left page-title">All Course's</h4>
                <ol class="breadcrumb pull-right">
                    <li><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                    <li class="active">All Course's</li>
                </ol>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">All Course's</h3>
                </div>

                <div class="panel-body">

                    @if($courses->count() == 0)
                        <p class="text-warning" style="font-size: 20px"><i class="fa fa-warning"></i> No course's Found</p>
                    @else
                        @foreach($courses as $key=>$course)
                            <div class="row">
                                <div class="col-md-3">
                                    <img src="{{asset($course->image)}}" class="img-responsive" style="height: 300px; width: 100%;" alt="">
                                </div>
                                <div class="col-md-9" style="display: inline">
                                    <table class="table table-bordered">
                                        <tbody>
                                            <tr>
                                                <td style="width: 15%;">Title</td>
                                                <td>{{$course->title}}</td>
                                            </tr>
                                            <tr>
                                                <td>Short Description</td>
                                                <td>{{Str::limit(strip_tags($course->short_desc), 30)}}</td>
                                            </tr>
                                            <tr>
                                                <td>Course Fee</td>
                                                <td>{{$course->course_fee ? $course->course_fee:'Free'}}</td>
                                            </tr>
                                            <tr>
                                                <td>Offer Fee</td>
                                                <td>{{$course->offer_price ? $course->offer_price:'Free'}}</td>
                                            </tr>
                                            <tr>
                                                <td>Status</td>
                                                <td>{{$course->status ? 'Active':'Inactive'}}</td>
                                            </tr>
                                            <tr>
                                                <td>Approve</td>
                                                <td>{{$course->is_approve ? 'Approve':'Pending'}}</td>
                                            </tr>
                                            <tr>
                                                <td>Is Featured</td>
                                                <td>{{$course->is_featured ? 'Featured':'No'}}</td>
                                            </tr>
                                            <tr>
                                                <td>Total Student</td>
                                                <td>{{$course->total_student}}</td>
                                            </tr>
                                            <tr>
                                                <td>Created At</td>
                                                <td>{{ \Carbon\Carbon::parse($course->created_at)->format("j S F Y")}} && {{\Carbon\Carbon::parse($course->created_at)->format("h:i a")}}</td>
                                            </tr>
                                            <tr>
                                                <td>Action</td>
                                                <td>
                                                    <a href="{{route('admin.courses.show', $course->id)}}" class="btn btn-success">Details</a>
                                                    @if($course->is_approve)
                                                        <button class="btn btn-warning" type="button" onclick="approvedCourse({{$course->id}})">
                                                            Unapproved
                                                        </button>
                                                        <form id="approved_from_{{$course->id}}" style="display: none" action="{{route('admin.courses.update', $course->id)}}" method="post">
                                                            <input type="hidden" name="update" value="approved">
                                                            @csrf
                                                            @method('put')
                                                        </form>
                                                    @else
                                                        <button class="btn btn-info" type="button" onclick="approvedCourse({{$course->id}})">
                                                            Approved
                                                        </button>
                                                        <form id="approved_from_{{$course->id}}" style="display: none" action="{{route('admin.courses.update', $course->id)}}" method="post">
                                                            <input type="hidden" name="update" value="approved">
                                                            @csrf
                                                            @method('put')
                                                        </form>
                                                    @endif

                                                    @if($course->is_featured)
                                                        <button class="btn btn-warning" type="button" onclick="featuredCourse({{$course->id}})">
                                                            Un Featured
                                                        </button>
                                                        <form id="featured_from_{{$course->id}}" style="display: none" action="{{route('admin.courses.update', $course->id)}}" method="post">
                                                            <input type="hidden" name="update" value="featured">
                                                            @csrf
                                                            @method('put')
                                                        </form>
                                                    @else
                                                        <button class="btn btn-info" type="button" onclick="featuredCourse({{$course->id}})">
                                                            Featured
                                                        </button>
                                                        <form id="featured_from_{{$course->id}}" style="display: none" action="{{route('admin.courses.update', $course->id)}}" method="post">
                                                            <input type="hidden" name="update" value="featured">
                                                            @csrf
                                                            @method('put')
                                                        </form>
                                                    @endif
                                                    <a href="{{route('admin.course.review', $course->id)}}" class="btn btn-success">Review</a>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <hr>
                        @endforeach
                    @endif
                    <div style="text-align: center;">
                        {{ $courses->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection



@push('js')
    <script type="text/javascript">
        function approvedCourse(id)
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
                    document.getElementById('approved_from_'+id).submit();
                    swalWithBootstrapButtons.fire(
                        'Approve!',
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


        function featuredCourse(id)
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
                    document.getElementById('featured_from_'+id).submit();
                    swalWithBootstrapButtons.fire(
                        'Featured!',
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
