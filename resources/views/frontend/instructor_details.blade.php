@extends('frontend.master')

@section('title', 'Instructor || Details')

@section('main-content')
    <section class="page-name background-bg" data-image-src="{{asset('frontend')}}/images/breadcrumb.jpg">
        <div class="overlay">
            <div class="section-padding">
                <div class="container text-center">
                    <h2 class="section-title" style="color: #fff"> Course <i class="fa fa-angle-double-right"> </i> Instructor <i class="fa fa-angle-double-right"> </i> {{$instructorDetails->name}} </h2>
                </div><!-- /.container -->
            </div><!-- /.section-padding -->
        </div><!-- /.overlay -->
    </section>

    <section class="instructor-details">
        <div class="section-padding">
            <div class="container">
                <div class="row">
                    <div class="col-md-4 pr-5">
                        <div class="avatar text-center">
                            <img src="{{asset($instructorDetails->image)}}" alt="Avatar Image">
                        </div>

                        <div class="social text-center">
                            <a href="{{$about->twitter}}"><i class="fab fa-twitter"></i></a>
                            <a href="{{$about->facebook}}"><i class="fab fa-facebook-f"></i></a>
                            <a href="{{$about->whatsapp}}"><i class="fab fa-whatsapp"></i></a>
                            <a href="{{$about->instagram}}"><i class="fab fa-instagram"></i></a>
                            <a href="{{$about->youtube}}"><i class="fab fa-youtube"></i></a>
                        </div><!-- /.social -->
                    </div>

                    <div class="col-md-8 pl-4">
                        <div class="meta">
                            <ul>
                                <li><span class="meta-id">Students</span> {{$data['students']}}</li>
                                <li><span class="meta-id">Courses</span> {{$data['course']}}</li>
                                <li><span class="meta-id">Reviews</span> {{$data['reviews']}}</li>
                            </ul>
                        </div><!-- /.meta -->
                        <div>
                            <p>{{$about->about_me}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="instructor-taught gray-bg">
        <div class="section-padding">
            <div class="container">
                <div class="top-content text-center">
                    <h2 class="section-title">Courses Taught by Margaret</h2>
                </div><!-- /.top-content -->

                <div class="course-items">
                    <div class="row">
                        @if($courses->count()> 0)
                        @foreach($courses as $course)
                            <div class="col-lg-3 col-md-6">
                                <div class="item">
                                    <div class="item-thumb"><img src="{{asset($course->image)}}" alt="Item Thumbnail"></div><!-- /.item-thumb -->
                                    <div class="item-details">
                                        <h3 class="item-title"><a href="{{route('course.details', $course->id)}}">{{$course->title}}</a></h3><!-- /.item-title -->
                                        @php
                                            $instructor = \App\User::where('id', $course->instructor_id)->first();
                                        @endphp
                                        <span class="instructor"><a href="{{route('course.instructor.details', $instructor->id)}}">{{ $instructor->name }}</a></span><!-- /.instructor -->
                                        <div class="details-bottom">
                                            <div class="course-price float-left"><span class="currency">$</span><span class="price">{{$course->offer_price}}</span></div><!-- /.course-price -->
                                            <div class="rating float-right">
                                                <input type="hidden" class="rating-tooltip-manual" data-filled="fas fa-star" data-empty="far fa-star" value="{{$course->rating}}" data-fractions="2"/>
                                            </div><!-- /.rating -->
                                        </div><!-- /.details-bottom -->
                                    </div><!-- /.item-details -->
                                </div><!-- /.item -->
                            </div>
                        @endforeach
                        @else
                            <div class="text-warning d-block w-100"><h3 class="text-center">No course found</h3></div>
                        @endif
                    </div><!-- /.row -->
                </div>
            </div>
        </div>
    </section>

@endsection
