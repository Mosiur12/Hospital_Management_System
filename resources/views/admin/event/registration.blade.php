@extends('admin.master')

@section('title', 'Event Registration List')
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
                <h4 class="pull-left page-title">Event Registration List</h4>
                <ol class="breadcrumb pull-right">
                    <li><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                    <li><a href="{{route('admin.events.index')}}">Event</a></li>
                    <li class="active">Event Registration List</li>
                </ol>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">Event Registration List</h3>
                </div>
                <div class="panel-body">
                    <table id="datatable-buttons" class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th>#SL</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Event Name</th>
                            <th>Phone</th>
                            <th>Registration Date</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($registrationUser as $key=>$registration)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{ $registration->name }}</td>
                                <td>{{ $registration->email }}</td>
                                <td>{{ $registration->event->title }}</td>
                                <td>{{ $registration->phone }}</td>
                                <td>{{ \Carbon\Carbon::parse($registration->created_at)->format("j S F Y")}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="row m-b-15 m-l-15">
                    <div class="col-sm-12 m-b-15">
                        <a class="btn btn-primary" href="{{route('admin.events.index')}}"> Back </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection


