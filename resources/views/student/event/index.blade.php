@extends('student.master')

@section('title', 'Event List')

@section('main-content')
    <div class="row">
        <div class="col-sm-12">
            <div class="page-header-title">
                <h4 class="pull-left page-title">Event List</h4>
                <ol class="breadcrumb pull-right">
                    <li><a href="{{route('student.dashboard')}}">Dashboard</a></li>
                    <li class="active">Event List</li>
                </ol>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">Event List</h3>
                </div>
                <div class="panel-body">

                    <table id="datatable-buttons" class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th style="width: 7%;">#SL</th>
                            <th>Event Title</th>
                            <th style="width: 10%;">Event Status</th>
                            <th style="width: 20%;">Date</th>
                            <th style="width: 10%;">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(empty($events) )
                            <tr>
                                <td class="text-warning" style="font-size: 20px"><i class="fa fa-warning"></i> No Event Registration</td>
                            </tr>
                        @else
                            @foreach($events as $key=>$event)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$event->event->title}}</td>
                                <td><span class="label {{$event->event->event_date > \Carbon\Carbon::now()->toDateTimeString() ? 'label-success':'label-warning'}}">{{$event->event->event_date > \Carbon\Carbon::now()->toDateTimeString() ? 'Active':'Inactive'}}</span></td>
                                <td>{{ \Carbon\Carbon::parse($event->event->event_date)->format("j S F Y")}} && {{\Carbon\Carbon::parse($event->event->event_date)->format("h:i a")}}</td>
                                <td>
                                    <a href="{{route('student.event.show', $event->event_id)}}" class="btn btn-sm btn-success"><i class="fa fa-eye"></i></a>
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
