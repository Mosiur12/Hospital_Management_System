@extends('admin.master')

@section('title', 'Withdraw Request List')
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
                <h4 class="pull-left page-title">Withdraw Request List</h4>
                <ol class="breadcrumb pull-right">
                    <li><a href="{{route('instructor.dashboard')}}">Dashboard</a></li>
                    <li class="active">Withdraw History List</li>
                </ol>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">Withdraw Request List</h3>
                </div>
                <div class="panel-body">

                    <table id="datatable-buttons" class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th>#SL</th>
                            <th>Instructor Name</th>
                            <th>Bank Name</th>
                            <th>Account No.</th>
                            <th>Amount</th>
                            <th>Pay. Status</th>
                            <th style="width: 13%;">Date</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($withdrawRequests as $key=>$withdrawRequest)
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>{{$withdrawRequest->user->name}}</td>
                                    <td>{{$withdrawRequest->bank_name}}</td>
                                    <td>{{$withdrawRequest->account_no}}</td>
                                    <td>{{$withdrawRequest->amount}}</td>
                                    <td><span class="label {{$withdrawRequest->status ? 'label-success':'label-warning'}}">{{$withdrawRequest->status ? 'Paid':'Due'}}</span></td>
                                    <td>{{ \Carbon\Carbon::parse($withdrawRequest->created_at)->format("j S F Y")}} && {{\Carbon\Carbon::parse($withdrawRequest->created_at)->format("h:i a")}}</td>
                                    <td>
                                        @if($withdrawRequest->status == '1')
                                            <button class="btn btn-success" type="button">Done</button>
                                        @else
                                        <button class="btn btn-warning" type="button" onclick="approvedWithdrawRequest({{$withdrawRequest->id}})">
                                            Approve
                                        </button>
                                        <form id="approved_from_{{$withdrawRequest->id}}" style="display: none" action="{{route('admin.withdraw.request.update', $withdrawRequest->id)}}" method="post">
                                            <input type="hidden" name="user_id" value="{{$withdrawRequest->user_id}}">
                                            <input type="hidden" name="amount" value="{{$withdrawRequest->amount}}">
                                            <input type="hidden" name="" value="">
                                            @csrf
                                            @method('put')
                                        </form>
                                        @endif
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
        function approvedWithdrawRequest(id)
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
    </script>
@endpush

