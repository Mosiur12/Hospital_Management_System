@extends('admin.master')

@section('title', 'Event Details')

@section('main-content')
    <div class="row">
        <div class="col-sm-12">
            <div class="page-header-title">
                <h4 class="pull-left page-title">Event Details</h4>
                <ol class="breadcrumb pull-right">
                    <li><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                    <li><a href="{{route('admin.events.index')}}">Event</a></li>
                    <li class="active">Event Details</li>
                </ol>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">{{$event->title}}</h3>
                </div>

                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-4">
                            <img src="{{asset($event->img)}}" class="img-responsive" alt="Event image">
                        </div>
                        <div class="col-md-8">
                            <table class="table table-bordered">
                                <tbody>
                                <tr>
                                    <td>Title</td>
                                    <td>{{$event->title}}</td>
                                </tr>
                                <tr>
                                    <td>Place</td>
                                    <td>{{$event->place}}</td>
                                </tr>
                                <tr>
                                    <td>Location</td>
                                    <td>{{$event->location}}</td>
                                </tr>
                                <tr>
                                    <td>Total Seat</td>
                                    <td>{{$event->total_seat}}</td>
                                </tr>
                                <tr>
                                    <td>Event Short Description</td>
                                    <td>{!! $event->short_desc !!}</td>
                                </tr>
                                <tr>
                                    <td>Event Description</td>
                                    <td>{!! $event->desc !!}</td>
                                </tr>
                                <tr>
                                    <td>Event Date</td>
                                    <td>{{ \Carbon\Carbon::parse($event->event_date)->format("j S F Y")}}</td>
                                </tr>
                                <tr>
                                    <td>Event Time</td>
                                    <td>{{\Carbon\Carbon::parse($event->event_time)->format("h:i a")}}</td>
                                </tr>
                                <tr>
                                    <td>Event Speaker</td>
                                    <td>
                                        @php
                                            $speakers = json_decode($event->event_speaker);
                                            foreach ($speakers as $speaker)
                                            {
                                                  echo \App\User::where('id', $speaker)->pluck('name')->first().", ";
                                            }
                                        @endphp
                                    </td>
                                </tr>
                                <tr>
                                    <td>Status</td>
                                    <td>{{$event->status ? 'Active':'Inactive'}}</td>
                                </tr>

                                <tr>
                                    <td>Action</td>
                                    <td>
                                        <a href="{{route('admin.events.edit', $event->id)}}" class="btn btn-warning">Edit</a>
                                        <a href="{{route('admin.events.index')}}" class="btn btn-success">Back</a>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
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


        function featuredCourse(id) {
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
                    document.getElementById('featured_from_' + id).submit();
                    swalWithBootstrapButtons.fire(
                        'Deleted!',
                        'Your data has been update',
                        'success'
                    )
                } else if (result.dismiss === Swal.DismissReason.cancel) {
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
