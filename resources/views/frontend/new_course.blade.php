@extends('frontend.master')

@section('title', 'New || Course')

@section('main-content')
    <section class="page-name background-bg" data-image-src="{{asset('frontend')}}/images/breadcrumb.jpg">
        <div class="overlay">
            <div class="section-padding">
                <div class="container text-center">
                    <h2 class="section-title" style="color: #fff"> Course <i class="fa fa-angle-double-right"> </i> New Course </h2>
                </div><!-- /.container -->
            </div><!-- /.section-padding -->
        </div><!-- /.overlay -->
    </section>

    <section class="popular-courses no-slider">
        <div class="section-padding pb-0">
            <div class="container">
                <div class="course-items">
                    <div class="row">
                        @if($newCourses->count() > 0)
                            @foreach($newCourses as $course)
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
                                                    <input type="hidden" class="rating-tooltip-manual" data-filled="fas fa-star" data-empty="far fa-star" value="{{$course->rating}}" data-fractions="1"/>
                                                </div><!-- /.rating -->
                                            </div><!-- /.details-bottom -->
                                        </div><!-- /.item-details -->
                                    </div><!-- /.item -->
                                </div>
                            @endforeach
                        @else
                            <div class="col-lg-3 col-md-6">
                                <div class="item">
                                    <p class="text-warning" style="font-size: 20px;">There are No course found</p>
                                </div>
                            </div>
                        @endif
                    </div>
                    <div style="text-align: center;">
                        {{ $newCourses->links() }}
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="popular-courses no-slider">
        <div class="section-padding pb-5" style="margin-top: -55px;">
            <div class="container">
                <h2 class="section-title mb-4">Related Courses</h2>
                <div class="course-items">
                    <div class="row">
                        @foreach($randoms as $course)
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
                                                <input type="hidden" class="rating-tooltip-manual" data-filled="fas fa-star" data-empty="far fa-star" value="{{$course->rating}}" data-fractions="1"/>
                                            </div><!-- /.rating -->
                                        </div><!-- /.details-bottom -->
                                    </div><!-- /.item-details -->
                                </div><!-- /.item -->
                            </div>
                        @endforeach
                    </div><!-- /.row -->
                </div><!-- /.course-items -->
            </div>
        </div>
    </section>

    <div class="loadmore-contaner text-center my-5">
        <a href="{{route('course.all')}}" class="btn btn-lg">See all Course</a>
    </div>

@endsection
