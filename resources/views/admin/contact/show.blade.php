@extends('admin.master')

@section('title', 'All Contact')

@section('main-content')
    <div class="row">
        <div class="col-sm-12">
            <div class="page-header-title">
                <h4 class="pull-left page-title">Contact's</h4>
                <ol class="breadcrumb pull-right">
                    <li><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                    <li class="active">All Contact's</li>
                </ol>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">All Contact's</h3>
                </div>

                <div class="panel-body">

                    @if($contact->count() == 0)
                        <p class="text-warning" style="font-size: 20px"><i class="fa fa-warning"></i> No course's Found</p>
                    @else

                            <div class="row">
                                <div class="col-md-12" style="display: inline">
                                    <table class="table table-bordered">
                                        <tbody>
                                        <tr>
                                            <td style="width: 15%;">Name</td>
                                            <td>{{$contact->name}}</td>
                                        </tr>
                                        <tr>
                                            <td style="width: 15%;">Email</td>
                                            <td>{{$contact->email}}</td>
                                        </tr>
                                        <tr>
                                            <td style="width: 15%;">Subject</td>
                                            <td>{{$contact->subject}}</td>
                                        </tr>
                                        <tr>
                                            <td>Message</td>
                                            <td>{{Str::limit(strip_tags($contact->message), 100)}}</td>
                                        </tr>
                                        <tr>
                                            <td>View Status</td>
                                            <td>{{$contact->view_status ? 'View':'New'}}</td>
                                        </tr>
                                        <tr>
                                            <td>Status</td>
                                            <td>{{$contact->status ? 'Active':'Inactive'}}</td>
                                        </tr>

                                        <tr>
                                            <td>Action</td>
                                            <td>
                                                <a href="{{route('admin.contacts.index')}}" class="btn btn-success">Back</a>

                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                    @endif
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
                        'Deleted!',
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
                        'Deleted!',
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
    </script>
@endpush
