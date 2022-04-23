@extends('frontend.master')

@section('title', 'All Course')

@section('main-content')
    <section class="page-name background-bg" data-image-src="{{asset('frontend')}}/{{asset('frontend')}}/images/breadcrumb.jpg">
        <div class="overlay">
            <div class="section-padding">
                <div class="container">
                    <form action="{{route('course.search')}}" class="course-search-form" method="post">
                        @csrf
                        <input type="text" name="search" id="search" class="search" placeholder="Find a course or tutorial ">
                        <input type="submit" name="submit" id="search-submit" class="sreach-submit">
                    </form>
                </div>
            </div>
        </div>
    </section>

    <section class="courses">
        <div class="section-padding">
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <div class="filters">
                            <div class="row">
                                <div class="col-lg-6">
                                </div>
                                <div class="col-lg-6">
                                    <div class="layout-switcher">
                                        <span class="grid"><i class="fa fa-th"></i></span>
                                        <span class="list"><i class="fa fa-list"></i></span>
                                    </div><!-- /.layout-switcher -->
                                </div>
                            </div>
                        </div><!-- /.filters -->

                        <div class="course-items">
                            <div class="row">
                                @foreach($courses as $course)
                                    <div class="col-lg-4 col-md-6">
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

                            <nav aria-label="Page navigation example">
                                {{ $courses->links()}}
                            </nav>

                        </div><!-- /.course-items -->
                    </div>

                    <div class="col-md-4">
                        <aside class="sidebar">
                            <div class="category-list">
                                <ul>
                                    <li class="active"><a href="{{route('course.all')}}">All Courses</a></li>
                                    @foreach($categories as $category)
                                        <li><a href="{{route('course.category', $category->id)}}">{{$category->name}}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                        </aside>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@push('js')
    <script src="{{asset('frontend')}}/assets/js/jquery.selectric.js"></script>

    <script>
        $(function() {
            $('.filter-select').selectric();
        });
    </script>
@endpush
