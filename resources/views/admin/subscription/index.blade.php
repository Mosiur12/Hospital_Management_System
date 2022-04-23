@extends('admin.master')

@section('title', 'Subscription List')
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
                <h4 class="pull-left page-title">All Subscription</h4>
                <ol class="breadcrumb pull-right">
                    <li><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                    <li class="active">All Students</li>
                </ol>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">Subscription List</h3>
                </div>
                <div class="panel-body">

                    <table id="datatable-buttons" class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th>#SL</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th width="10%">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($subscriptions as $key=>$subscription)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{ $subscription->email }}</td>
                                <td><span class="label {{ $subscription->status ? 'label-success':'label-warning' }}">{{ $subscription->status ? 'Active':'Inactive' }}</span></td>
                                <td>
                                    <button class="btn btn-warning" type="button" onclick="updateStatus({{$subscription->id}})">
                                        <i class="fa fa-edit"></i>
                                    </button>
                                    <form id="update_from_{{$subscription->id}}" style="display: none" action="{{route('admin.subscriptions.update', $subscription->id)}}" method="post">>
                                        @csrf
                                        @method('put')
                                    </form>

                                    <button class="btn btn-danger" type="button" onclick="deleteSubscription({{$subscription->id}})">
                                        <i class="fa fa-trash-o"></i>
                                    </button>
                                    <form id="delete_from_{{$subscription->id}}" style="display: none" action="{{route('admin.subscriptions.destroy', $subscription->id)}}" method="post">
                                        @csrf
                                        @method('delete')
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('js')
    <script type="text/javascript">
        function deleteSubscription(id)
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

        function updateStatus(id) {
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
                    document.getElementById('update_from_' + id).submit();
                    swalWithBootstrapButtons.fire(
                        'Update!',
                        'Your data has been updated',
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
