@extends('student.master')

@section('title', 'Payment History')

@section('main-content')
    <div class="row">
        <div class="col-sm-12">
            <div class="page-header-title">
                <h4 class="pull-left page-title">Payment History</h4>
                <ol class="breadcrumb pull-right">
                    <li><a href="{{route('student.dashboard')}}">Dashboard</a></li>
                    <li class="active">Payment History</li>
                </ol>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">Payment List</h3>
                </div>
                <div class="panel-body">

                    <table id="datatable-buttons" class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th>#SL</th>
                            <th>Order Id</th>
                            <th>Transaction Id</th>
                            <th style="width: 30%;">Course Name</th>
                            <th>Ins. Name</th>
                            <th>Amount</th>
                            <th>Pay. Status</th>
                            <th style="width: 13%;">Date</th>
                            <th>Invoice</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(empty($payments) )
                            <tr>
                                <td class="text-warning" style="font-size: 20px"><i class="fa fa-warning"></i> No course's Found</td>
                            </tr>
                        @else
                            @foreach($payments as $key=>$payment)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>#{{$payment->id}}</td>
                                <td>{{$payment->transaction_id}}</td>
                                <td>{{$payment->title}}</td>
                                <td>{{$payment->name}}</td>
                                <td>{{$payment->amount}}</td>
                                <td><span class="label {{$payment->status ? 'label-success':'label-warning'}}">{{$payment->status ? 'Paid':'Due'}}</span></td>
                                <td>{{ \Carbon\Carbon::parse($payment->created_at)->format("j S F Y")}} && {{\Carbon\Carbon::parse($payment->created_at)->format("h:i a")}}</td>
                                <td>
                                    <a href="{{route('student.payment.invoice', $payment->id)}}" class="btn btn-sm btn-success"><i class="fa fa-download"></i></a>
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
