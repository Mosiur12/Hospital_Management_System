@extends('instructor.master')

@section('title', 'Withdraw List')
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
                <h4 class="pull-left page-title">Withdraw History</h4>
                <ol class="breadcrumb pull-right">
                    <li><a href="{{route('instructor.dashboard')}}">Dashboard</a></li>
                    <li class="active">Withdraw History</li>
                </ol>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>

    <div class="row m-b-15">
        <div class="col-sm-12">
            @if($availableWithdraws > 9)
                <button type="button" class="btn btn-primary waves-effect waves-light" data-toggle="modal" data-target="#withdrawRequestModal">Make Withdraw Request</button>
            @else
                <button type="button" class="btn btn-primary waves-effect waves-light">Make Withdraw Request Minimum 10$ && You have {{$availableWithdraws}}$</button>
            @endif
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">Withdraw List && Your Available Balance : {{$wallet->available}}$</h3>
                </div>
                <div class="panel-body">

                    <table id="datatable-buttons" class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th>#SL</th>
                            <th>Amount</th>
                            <th>Pay. Status</th>
                            <th style="width: 13%;">Date</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(empty($withdraws) )
                            <tr>
                                <td class="text-warning" style="font-size: 20px"><i class="fa fa-warning"></i> No payment Found</td>
                            </tr>
                        @else
                            @foreach($withdraws as $key=>$withdraw)
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>{{$withdraw->withdraw}}</td>
                                    <td><span class="label {{$withdraw->status ? 'label-success':'label-warning'}}">{{$withdraw->status ? 'Paid':'Due'}}</span></td>
                                    <td>{{ \Carbon\Carbon::parse($withdraw->created_at)->format("j S F Y")}} && {{\Carbon\Carbon::parse($withdraw->created_at)->format("h:i a")}}</td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div id="withdrawRequestModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title" id="myModalLabel">Withdraw Request && Maximum withdrew amount is {{$availableWithdraws}}$</h4>
                </div>
                <form role="form" action="{{route('instructor.withdraws.store')}}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="bank_name">Bank Name</label>
                            <input type="text" name="bank_name" value="{{ old('bank_name') }}" class="form-control @error('bank_name') is-invalid @enderror" id="ex1" placeholder="Enter Bank Name">
                        </div>
                        @error('bank_name')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror

                        <div class="form-group">
                            <label for="account_no">Account No.</label>
                            <input type="text" name="account_no" value="{{ old('account_no') }}" class="form-control @error('account_no') is-invalid @enderror" id="ex1" placeholder="Enter Account No.">
                        </div>
                        @error('account_no')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror

                        <div class="form-group">
                            <label for="amount">Amount</label>
                            <input type="number" min="10" max="{{$availableWithdraws}}" name="amount" value="{{ old('amount') }}" class="form-control @error('amount') is-invalid @enderror" id="ex1" placeholder="Enter amount">
                        </div>
                        @error('amount')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary waves-effect waves-light">Save changes</button>
                    </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>

@endsection

