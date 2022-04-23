@extends('frontend.master')

@section('title', 'Event List')

@push('css')
    <link rel="stylesheet" href="{{asset('frontend')}}/assets/css/woocommerce.css">
    <link rel="stylesheet" href="{{asset('frontend')}}/assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="{{asset('frontend')}}/assets/css/magnific-popup.css">
    <link rel="stylesheet" href="{{asset('frontend')}}/assets/css/timeTo.css">
@endpush

@section('main-content')
    <section class="page-name background-bg" data-image-src="{{asset('frontend')}}/images/breadcrumb.jpg">
        <div class="overlay">
            <div class="section-padding">
                <div class="container text-center">
                    <h2 class="section-title" style="color: #fff"> Event <i class="fa fa-angle-double-right"> </i> Event List </h2>
                </div><!-- /.container -->
            </div><!-- /.section-padding -->
        </div><!-- /.overlay -->
    </section>

    <section class="events">
        <div class="section-padding">
            <div class="container">
                <div class="row">
                    @foreach($events as $event)
                    <div class="col-md-6">
                        <div class="event media">
                            <div class="event-time media-left">
                                <time datetime="2017-07-28"><span class="date">{{ \Carbon\Carbon::parse($event->event_date)->format("j")}}</span> {{ \Carbon\Carbon::parse($event->event_date)->format("F")}}</time>
                            </div>
                            <div class="event-details media-body">
                                <div class="event-thumb radius"><img src="{{asset($event->img)}}" alt="Event Thumbnail"></div><!-- /.enent-thumb -->
                                <h2 class="event-title"><a href="{{route('event.details', $event->id)}}">{{$event->title}}</a></h2><!-- /.event-title -->
                                <div class="event-meta">
                                    <span class="time"><i class="icon-clock"></i> {{\Carbon\Carbon::parse($event->event_time)->format("h:i a")}}</span><!-- /.time -->
                                    <span class="place"><i class="icon-location-pin"></i> {{$event->place}}</span><!-- /.place -->
                                </div><!-- /.event-meta -->

                                {!! $event->short_desc !!}

                            </div>
                        </div>
                    </div>
                    @endforeach
                </div><!-- /.row -->
            </div><!-- /.container -->
        </div><!-- /.section-padding -->
    </section>

@endsection

@push('css')
    <link rel="stylesheet" href="{{asset('/')}}assets/css/toastr.min.css">
@endpush
@push('js')

    <script src="{{asset('assets/js/toastr.min.js')}}"></script>

    {!! Toastr::message() !!}

    <script type="text/javascript">
        @if($errors->any())
        @foreach($errors->all() as $error)
        toastr.error('{{$error}}','Error', {closeButton:true, progressBar:true})
        @endforeach
        @endif
    </script>
@endpush
