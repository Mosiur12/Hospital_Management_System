@extends('admin.master')

@section('title', 'Edit Instructor')

@section('main-content')
    <div class="row">
        <div class="col-sm-12">
            <div class="page-header-title">
                <h4 class="pull-left page-title">Edit Instructor</h4>
                <ol class="breadcrumb pull-right">
                    <li><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                    <li><a href="{{route('admin.instructors.index')}}">All Instructors</a></li>
                    <li class="active">Edit Instructor</li>
                </ol>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">Edit Instructor</h3>
                </div>

                <div class="panel-body">
                    <div class="row">
                        <div class="col-xs-12">
                            <form role="form" action="{{route('admin.events.update', $event->id)}}" method="post" enctype="multipart/form-data">
                                @csrf
                                @method('put')
                                <div class="form-group">
                                    <label for="title">Event Title</label>
                                    <input required type="text" name="title" value="{{$event->title ? $event->title : old('title') }}" class="form-control @error('title') is-invalid @enderror" id="ex1" placeholder="Enter event title">
                                </div>
                                @error('title')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror

                                <div class="form-group">
                                    <label for="place">Place</label>
                                    <input required type="text" name="place" value="{{$event->place ? $event->place : old('place') }}" class="form-control @error('place') is-invalid @enderror" id="ex1" placeholder="Enter Event place">
                                </div>
                                @error('place')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror

                                <div class="form-group">
                                    <label for="location">Location link</label>
                                    <input required type="url" name="location" value="{{$event->location ? $event->location : old('location') }}" class="form-control @error('location') is-invalid @enderror" id="ex1" placeholder="Enter event location link">
                                </div>
                                @error('location')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror

                                <div class="form-group">
                                    <label for="total_seat">Total Seat</label>
                                    <input required type="number" min="5" name="total_seat" value="{{$event->total_seat ? $event->total_seat : old('total_seat') }}" class="form-control @error('total_seat') is-invalid @enderror" id="ex1" placeholder="Enter event total seat">
                                </div>
                                @error('total_seat')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror

                                <div class="form-group">
                                    <label for="event_date">Event Date</label>
                                    <input required type="date" name="event_date" class="form-control @error('event_date') is-invalid @enderror" value="{{$event->event_date ? $event->event_date : old('event_date') }}" placeholder="mm/dd/yyyy" id="datepicker">
                                </div>
                                @error('event_date')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror

                                <div class="form-group">
                                    <label for="event_time">Event Time</label>
                                    <div class="input-group m-b-15">
                                        <div class="bootstrap-timepicker"><input id="timepicker2" type="text" name="event_time" value="{{$event->event_time ? $event->event_time : old('event_time') }}" class="form-control @error('event_time') is-invalid @enderror"></div>
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span>
                                    </div>
                                </div>
                                @error('event_time')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror

                                <div>
                                    {{--@php
                                        $speakersaljdf = json_decode($event->event_speaker);
                                        foreach($speakersaljdf as $speakersfa)
                                            {
                                                echo $speakersfa.",";
                                            }
                                    @endphp--}}
                                </div>

                                <div class="form-group">
                                    <label for="event_date">Event Speaker</label>
                                    <select name="event_speaker[]" multiple="multiple" class="form-control @error('event_speaker') is-invalid @enderror">
                                        <option>Select One</option>
                                        @foreach($speakers as $speaker)
                                            <option value="{{$speaker->id}}">{{$speaker->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('event_speaker')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror

                                <div class="form-group">
                                    <label for="short_desc">Event Short Description</label>
                                    <textarea id="tinymce" name="short_desc">
                                        {{$event->short_desc ? $event->short_desc : old('short_desc') }}
                                   </textarea>
                                </div>
                                @error('short_desc')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror

                                <div class="form-group">
                                    <label for="event_date">Event Description</label>
                                    <textarea id="tinymce" name="desc">
                                        {{$event->desc ? $event->desc : old('desc') }}
                                   </textarea>
                                </div>
                                @error('desc')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror

                                <div class="form-group">
                                    <label for="img">Event Image</label>
                                    <div>
                                        <img style="width: 300px; height: 300px;" src="{{asset($event->img)}}" alt="">
                                    </div>
                                    <input type="file" name="img" value="{{ old('img') }}" class="form-control @error('img') is-invalid @enderror">
                                </div>
                                @error('img')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror

                                <div class="form-group">
                                    <label for="status">Event Status</label>
                                    <br>
                                    @php
                                        if (old('status')){
                                            $status = old('status');
                                        }else {
                                                $status = $event->status;
                                        }
                                    @endphp
                                    <div class="radio radio-info radio-inline">
                                        <input type="radio" id="inlineRadio1" value="1" name="status" @if($status==1) {{'checked'}}@endif>
                                        <label for="inlineRadio1">Active</label>
                                    </div>
                                    <div class="radio radio-info radio-inline">
                                        <input type="radio" id="inlineRadio1" value="0" name="status" @if($status==0) {{'checked'}}@endif>
                                        <label for="inlineRadio1">Inactive</label>
                                    </div>
                                </div>
                                @error('status')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror

                                <button type="submit" class="btn btn-success waves-effect waves-light">Update</button>
                                <a href="{{route('admin.instructors.index')}}" class="btn btn-info waves-effect waves-light">Back</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('css')
    <link href="{{asset('/')}}assets/plugins/timepicker/bootstrap-timepicker.min.css" rel="stylesheet">
    <link href="{{asset('/')}}assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet">
@endpush

@push('js_last')
    <script src="{{asset('/')}}assets/plugins/timepicker/bootstrap-timepicker.js"></script>
    <script src="{{asset('/')}}assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
    <script src="{{asset('/')}}assets/pages/form-advanced.js"></script>

    <script src="{{asset('/')}}assets/tinymce/tinymce.js"></script>

    <script>
        $(function () {
            tinymce.init({
                selector: "textarea#tinymce",
                theme: "modern",
                height: 300,
                plugins: [
                    'advlist autolink lists link image charmap print preview hr anchor pagebreak',
                    'searchreplace wordcount visualblocks visualchars code fullscreen',
                    'insertdatetime media nonbreaking save table contextmenu directionality',
                    'emoticons template paste textcolor colorpicker textpattern imagetools'
                ],
                toolbar1: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
                toolbar2: 'print preview media | forecolor backcolor emoticons',
                image_advtab: true
            });
            tinymce.suffix = ".min";
            tinyMCE.baseURL = '{{asset('/')}}assets/tinymce';
        });
    </script>
@endpush
