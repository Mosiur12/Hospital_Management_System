@extends('student.master')

@section('title', 'Course Complete List')

@section('main-content')
    <div class="row">
        <div class="col-sm-12">
            <div class="page-header-title">
                <h4 class="pull-left page-title">Course Complete List</h4>
                <ol class="breadcrumb pull-right">
                    <li><a href="{{route('student.dashboard')}}">Dashboard</a></li>
                    <li class="active">Course Complete List</li>
                </ol>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">Course Complete List</h3>
                </div>
                <div class="panel-body">

                    <table id="datatable-buttons" class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th>#SL</th>
                            <th style="width: 30%;">Course Name</th>
                            <th>Status</th>
                            <th style="width: 13%;">Date</th>
                            <th>Certificate</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(empty($complete) )
                            <tr>
                                <td class="text-warning" style="font-size: 20px"><i class="fa fa-warning"></i> No course's Complete</td>
                            </tr>
                        @else
                            @foreach($complete as $key=>$certificate)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$certificate->course->title}}</td>
                                <td><span class="label {{$certificate->status ? 'label-success':'label-warning'}}">{{$certificate->status ? 'Active':'Inactive'}}</span></td>
                                <td>{{ \Carbon\Carbon::parse($certificate->created_at)->format("j S F Y")}} && {{\Carbon\Carbon::parse($certificate->created_at)->format("h:i a")}}</td>
                                <td>
                                    <a href="{{route('student.course.certificate', $certificate->id)}}" class="btn btn-sm btn-success"><i class="fa fa-download"></i></a>
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
        function deleteRole(id)
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
