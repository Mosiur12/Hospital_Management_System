@extends('frontend.master')

@section('title', 'Welcome to Online course')

@section('main-content')

    <section class="banner-section banner-02 background-bg" data-image-src="{{asset('frontend')}}/images/banner/2.jpg">
        <div class="overlay">
            <div class="section-padding">
                <div class="container">
                    <div class="banner-texts text-center">
                        <h4>Take the World’s Best Courses</h4>
                        <p>Complete the course and Get Cirtificate</p>

                        <form action="{{route('course.search')}}" class="course-search-form" method="post">
                            @csrf
                            <input type="text" name="search" id="search" class="search" placeholder="Find a course or tutorial ">
                            <input type="submit" name="submit" id="search-submit" class="sreach-submit">
                        </form><!-- /.course-search-form -->
                    </div><!-- /.banner-texts -->
                </div><!-- /.container -->
            </div><!-- /.section-padding -->
        </div><!-- /.overlay -->
    </section><!-- /.banner-section -->


    <section class="course-category category-01 gray-bg">
        <div class="section-padding">
            <div class="container">
                <div class="category-slider owl-carousel">
                    @foreach($categories as $category)
                        <div class="item radius text-center">
                            <div class="item-thumb"><img class="radius" src="{{asset($category->image)}}" alt="Item Thumbnail"></div><!-- /.item-thumb -->
                            <div class="item-details">
                                <a href="{{route('course.category', $category->id)}}">
                                    <div class="item-texts">
                                        <i class="{{$category->icon}}"></i><span class="item-title">{{$category->name}}</span>
                                    </div><!-- /.item-texts -->
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>


    <section class="popular-courses no-slider">
        <div class="section-padding pb-0">
            <div class="container">

                <div class="top-content">
                    <div class="left-content float-left">
                        <h2 class="section-title section-title-02">Popular Course</h2>
                        <p>Donec rutrum congue leo eget malesuada</p>
                    </div><!-- /.left-content -->
                    <div class="right-content float-right"><a href="{{route('course.popular')}}" class="btn">View all</a></div><!-- /.right-content -->
                </div><!-- /.top-content -->

                <div class="course-items">
                    <div class="row">
                        @foreach($populars as $course)
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
                        @endforeach<!-- /.row -->
                    </div>
                </div><!-- /.course-items -->
            </div><!-- /.container -->
        </div><!-- /.section-padding -->
    </section><!-- /.popular-courses -->


    <section class="popular-courses no-slider">
        <div class="section-padding pb-0">
            <div class="container">

                <div class="top-content">
                    <div class="left-content float-left">
                        <h2 class="section-title section-title-02">Featured Course</h2>
                        <p>Donec rutrum congue leo eget malesuada</p>
                    </div><!-- /.left-content -->
                    <div class="right-content float-right"><a href="{{route('course.featured')}}" class="btn">View all</a></div><!-- /.right-content -->
                </div><!-- /.top-content -->

                <div class="course-items">
                    <div class="row">
                        @foreach($featuredCourses as $course)
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
                    </div><!-- /.row -->
                </div><!-- /.course-items -->
            </div><!-- /.container -->
        </div><!-- /.section-padding -->
    </section><!-- /.popular-courses -->


    <section class="popular-courses no-slider">
        <div class="section-padding pb-0">
            <div class="container">

                <div class="top-content">
                    <div class="left-content float-left">
                        <h2 class="section-title section-title-02">New Course</h2>
                        <p>Donec rutrum congue leo eget malesuada</p>
                    </div><!-- /.left-content -->
                    <div class="right-content float-right"><a href="{{route('course.new')}}" class="btn">View all</a></div><!-- /.right-content -->
                </div><!-- /.top-content -->

                <div class="course-items">
                    <div class="row">
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
                                                <input type="hidden" class="rating-tooltip-manual" data-filled="fas fa-star" data-empty="far fa-star" value="{{$course->rating}}" data-fractions="2"/>
                                            </div><!-- /.rating -->
                                        </div><!-- /.details-bottom -->
                                    </div><!-- /.item-details -->
                                </div><!-- /.item -->
                            </div>
                        @endforeach
                    </div><!-- /.row -->
                </div><!-- /.course-items -->
            </div><!-- /.container -->
        </div><!-- /.section-padding -->
    </section><!-- /.popular-courses -->


    <div class="loadmore-contaner text-center my-5">
        <a href="{{route('course.all')}}" class="btn btn-lg">See all Course</a>
    </div>

    <section class="facts background-bg" data-image-src="{{asset('frontend')}}/images/bg2.jpg" style="background-image: url(&quot;images/bg2.jpg&quot;);">
        <div class="overlay">
            <div class="section-padding">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-3 col-md-6">
                            <div class="item media">
                                <div class="item-icon mr-3"><i class="icons icon-book-open"></i></div><!-- /.item-icon -->
                                <div class="item-details">
                                    <span class="count">765</span><!-- /.count -->
                                    <h3 class="item-title">Courses Published</h3><!-- /.item-title -->
                                </div><!-- /.item-details -->
                            </div><!-- /.item -->
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="item media">
                                <div class="item-icon mr-3"><i class="icons icon-eyeglass"></i></div><!-- /.item-icon -->
                                <div class="item-details">
                                    <span class="count">249</span><!-- /.count -->
                                    <h3 class="item-title">Expert Instructors</h3><!-- /.item-title -->
                                </div><!-- /.item-details -->
                            </div><!-- /.item -->
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="item media">
                                <div class="item-icon mr-3"><i class="icons icon-people"></i></div><!-- /.item-icon -->
                                <div class="item-details">
                                    <span class="count">8348</span><!-- /.count -->
                                    <h3 class="item-title">Happy Learners</h3><!-- /.item-title -->
                                </div><!-- /.item-details -->
                            </div><!-- /.item -->
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="item media">
                                <div class="item-icon mr-3"><i class="icons icon-trophy"></i></div><!-- /.item-icon -->
                                <div class="item-details">
                                    <span class="count">99</span><!-- /.count -->
                                    <h3 class="item-title">Awards Achieved</h3><!-- /.item-title -->
                                </div><!-- /.item-details -->
                            </div><!-- /.item -->
                        </div>
                    </div><!-- /.row -->
                </div><!-- /.container -->
            </div><!-- /.section-padding -->
        </div><!-- /.overlay -->
    </section>

    <section class="subscribe text-center gray-bg">
        <div class="section-padding">
            <div class="container">
                <h4>Subscribe For Update</h4>
                <form class="mc4wp-form mc4wp-form-1971" action="{{route('subscription')}}" method="post">
                    @csrf
                    <input type="email" class="subscribe-email form-control @error('email') is-invalid @enderror" name="email" value="{{old('email')}}" placeholder="Enter Email Address Here" required>
                    <input class="subscribe-submit" type="submit" id="subscribe-submit" name="submit" value="Subscribe now">
                </form>
            </div><!-- /.container -->
        </div><!-- /.section-padding -->
    </section>
@endsection
@push('css')
    <link rel="stylesheet" href="{{asset('/')}}assets/css/toastr.min.css">
@endpush

@push('js')
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD2jlT6C_to6X1mMvR9yRWeRvpIgTXgddM"></script>

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
