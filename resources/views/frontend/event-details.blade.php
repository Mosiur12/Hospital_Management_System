@extends('frontend.master')

@section('title', 'Event Details')

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
                    <h2 class="section-title" style="color: #fff"> Event <i class="fa fa-angle-double-right"> </i> Event Details </h2>
                </div><!-- /.container -->
            </div><!-- /.section-padding -->
        </div><!-- /.overlay -->
    </section>

    <section class="events">
        <div class="section-padding">
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <div class="event-single-contents">
                            <div class="event-banner background-bg text-center" data-image-src="{{asset($event->img)}}">
                                <div class="overlay" style="height: 30%">
<!--                                    <div id="countdown"></div>-->
                                </div>
                            </div>

                            <div>{!! $event->desc !!}</div>

                            <h2>Event Speakers</h2>

                            <div class="row">
                                @php
                                    $speakers = json_decode($event->event_speaker);
                                @endphp
                                @foreach($speakers as $speaker)
                                    @php
                                        $user = \App\User::where('id', $speaker)->select('image', 'name')->first();
                                    @endphp

                                <div class="col-md-3 col-sm-6">
                                    <div class="speaker">
                                        <div class="avatar radius"><img style="background: #e8e8e8;" src="{{asset($user->image)}}" alt="Avatar Image"></div><!-- /.avatar -->
                                        <div class="speaker-details">
                                            <h3 class="name"><a href="{{route('course.instructor.details', $speaker)}}">{{$user->name}}</a></h3><!-- /.name -->
<!--                                            <span class="designation">Web Designer</span>&lt;!&ndash; /.designation &ndash;&gt;-->
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>

                            <h2 class="mt-4">Event Location</h2>

                            <div id="googleMaps" class="google-map-container" style="height: 400px;">
                                <iframe src="{{$event->location}}" width="100%" height="500" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                            </div>

                        </div><!-- /.event-single-contents -->
                    </div>

                    <div class="col-md-4">
                        <aside class="sidebar">
                            <a href="{{route('event.registration.form', $event->id)}}" class="btn btn-lg enroll-btn">Join the event</a>

                            <div class="widget widget_event_meta">

                                <div class="meta-info">
                                    <ul class="info-list">
                                        <li><span class="price">Free</span></li>
                                        <li><span class="meta-id">Date</span> {{ \Carbon\Carbon::parse($event->event_date)->format("j S F Y")}}</li>
                                        <li><span class="meta-id">Time</span> {{\Carbon\Carbon::parse($event->event_time)->format("h:i a")}}</li>
                                        <li><span class="meta-id">Place</span> {{$event->place}}</li>
                                        <li><span class="meta-id">Total Seats</span> {{$event->total_seat}}</li>
<!--                                        <li>
                                            <span class="meta-id">Share</span>
                                            <a href="#"><i class="fab fa-twitter"></i></a>
                                            <a href="#"><i class="fab fa-facebook-f"></i></a>
                                            <a href="#"><i class="fab fa-google-plus"></i></a>
                                            <a href="#"><i class="fab fa-pinterest"></i></a>
                                        </li>-->
                                    </ul>
                                </div>
                            </div><!-- /.widget -->
                        </aside><!-- /.sidebar -->
                    </div>
                </div><!-- /.row -->
            </div><!-- /.container -->
        </div><!-- /.section-padding -->
    </section>

@endsection

@push('css')
    <link rel="stylesheet" href="{{asset('/')}}assets/css/toastr.min.css">
@endpush
@push('js')
    <script src="{{$event->location}}"></script>

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
