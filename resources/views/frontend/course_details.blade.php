@extends('frontend.master')

@section('title', 'Course Details')

@section('main-content')
    <section class="page-name background-bg" data-image-src="{{asset('frontend')}}/images/breadcrumb.jpg">
        <div class="overlay">
            <div class="section-padding">
                <div class="container text-center">
                    <h2 class="section-title" style="color: #fff"> Course <i class="fa fa-angle-double-right"> </i> Course Details</h2>
                </div>
            </div>
        </div>
    </section>

    <section class="courses">
        <div class="section-padding">
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <h2 class="course-title">{{$courseDetails->title}}</h2><!-- /.course-title -->
                        <div class="course-meta">
                            @php
                                $instructor = \App\User::where('id', $courseDetails->instructor_id)->first();
                                $about = \App\ContactInformation::where('user_id', $courseDetails->instructor_id)->first();
                                $category = \App\Category::where('id', $courseDetails->category_id)->first();
                            @endphp
                            <span class="meta-details">
                                <img class="rounded-circle float-left" src="{{asset($instructor->image)}}" alt="Avatar">
                                <span class="meta-id">Instructor</span>
                                <a class="name" href="{{route('course.instructor.details', $courseDetails->instructor_id)}}">{{$instructor->name}}</a>
                            </span>
                            <span class="meta-details">
                                <span class="meta-id">Category</span>
                                <span>{{$category->name}}</span>
                            </span>
                            <span class="meta-details">
                                <span class="meta-id">Reviews</span>
                                <span class="rating">
                                    <input type="hidden" class="rating-tooltip-manual" data-filled="fas fa-star" data-empty="far fa-star" value="{{$courseDetails->rating}}" data-fractions="5"/>
                                    <span>({{$courseDetails->rating}} Ratings)</span>
                                </span><!-- /.rating -->
                            </span>
                        </div>
                        <img class="radius" src="{{asset($courseDetails->image)}}" alt="Course Image">

                        <div class="course-single-details">
                            <h4 class="title">Course description</h4>
                            <div>
                                {!! $courseDetails->course_details !!}
                            </div>

                            <h4 class="title">Curriculum for this Course</h4>
                            <div class="curriculum-details">

                                @if($chapters->count() > 0)
                                    @php
                                        $i = 0;
                                    @endphp
                                    @foreach($chapters as $chapter)
                                        <div class="content-table">
                                            <span class="title">{{$chapter->name}}</span>
                                            <ul class="content-list">
                                                @php
                                                    $lectures = \App\Lecture::where('chapter_id', $chapter->id)->get();
                                                @endphp
                                                @foreach($lectures as $lecture)
                                                    @php
                                                        $video = \App\Video::where('lecture_id', $lecture->id)->get();
                                                    @endphp
                                                    <li>
                                                        @if($i < 2 )
                                                            <span class="float-left"><a href="#"><i class="fa fa-play-circle"></i> {{$lecture->name}}</a></span>
                                                            <a href="#" myTitleOne="{{$lecture->name}}" videoid="{{$lecture->id}}" id="getVideoId" class="btn btn-primary getVideoId">Demo</a>
                                                        @else
                                                            <span class="float-left"><a href="#"><i class="fa fa-play-circle"></i> {{$lecture->name}}</a></span>
                                                        @endif

                                                        @if($i >= 2 )
                                                            <span class="float-right"><i class="fa fa-lock"></i></span>
                                                        @endif
                                                    </li>
                                                @endforeach
                                                @php
                                                    $i += 1;
                                                @endphp
                                            </ul>
                                        </div><!-- /.content-table -->
                                    @endforeach
                                @else
                                    <p style="color: #f1ce6e"><i class="fa fa-exclamation-triangle"></i> No course content Found</p>
                                @endif

                            </div><!-- /.curriculum-details -->

                            <div class="author-bio">
                                <h3 class="title">About the Instructor</h3>
                                <div class="author-contents media">
                                    <div class="author-avatar float-left"><img class="radius" src="{{asset($instructor->image)}}" alt="Avatar"></div><!-- /.author-avatar -->
                                    <div class="author-details media-body">
                                        <h3 class="name"><a href="{{route('course.instructor.details', $courseDetails->instructor_id)}}">{{$instructor->name}}</a></h3>
                                        @php
                                         $designation = \App\ContactInformation::where('user_id', $courseDetails->instructor_id)->select('designation')->first();
                                        @endphp
                                        <span style="text-transform: capitalize;">{{$designation->designation == 'null' ? '' : $designation->designation}}</span>
                                        <p>
                                            {{$about->about_me}}
                                        </p>
                                        <a href="{{route('course.instructor.details', $courseDetails->instructor_id)}}" class="load-more">Learn more <i class="fa fa-angle-double-right"></i></a>
                                    </div>
                                </div>
                            </div>

                            <h3 class="title">Student Reviews</h3>

                            <div class="course-reviews">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="average-rating text-center">
                                            <div class="rating">
                                                <input type="hidden" class="rating-tooltip-manual" data-filled="fas fa-star" data-empty="far fa-star" value="4.5" data-fractions="5"/>
                                            </div><!-- /.rating -->
                                            <span>Average Rating</span>
                                        </div><!-- /.average-rating -->
                                    </div>
                                    <div class="col-lg-8">
                                        <div class="progress">
                                            <div class="progress-bar" role="progressbar" style="width: 54%" aria-valuenow="54" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                        <div class="rating-icons">
                                            <i class="far fa-star"></i>
                                            <i class="far fa-star"></i>
                                            <i class="far fa-star"></i>
                                            <i class="far fa-star"></i>
                                            <i class="far fa-star"></i>
                                            <span class="rating-value">54%</span><!-- /.rating-value -->
                                        </div><!-- /.rating-icons -->

                                        <div class="progress">
                                            <div class="progress-bar" role="progressbar" style="width: 30%" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                        <div class="rating-icons">
                                            <i class="far fa-star"></i>
                                            <i class="far fa-star"></i>
                                            <i class="far fa-star"></i>
                                            <i class="far fa-star"></i>
                                            <i class="far fa-star-o"></i>
                                            <span class="rating-value">30%</span><!-- /.rating-value -->
                                        </div><!-- /.rating-icons -->

                                        <div class="progress">
                                            <div class="progress-bar" role="progressbar" style="width: 12%" aria-valuenow="12" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                        <div class="rating-icons">
                                            <i class="far fa-star"></i>
                                            <i class="far fa-star"></i>
                                            <i class="far fa-star"></i>
                                            <i class="far fa-star-o"></i>
                                            <i class="far fa-star-o"></i>
                                            <span class="rating-value">12%</span><!-- /.rating-value -->
                                        </div><!-- /.rating-icons -->

                                        <div class="progress">
                                            <div class="progress-bar" role="progressbar" style="width: 3%" aria-valuenow="3" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                        <div class="rating-icons">
                                            <i class="far fa-star"></i>
                                            <i class="far fa-star"></i>
                                            <i class="far fa-star-o"></i>
                                            <i class="far fa-star-o"></i>
                                            <i class="far fa-star-o"></i>
                                            <span class="rating-value">3%</span><!-- /.rating-value -->
                                        </div><!-- /.rating-icons -->

                                        <div class="progress">
                                            <div class="progress-bar" role="progressbar" style="width: 1%" aria-valuenow="1" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                        <div class="rating-icons">
                                            <i class="far fa-star"></i>
                                            <i class="far fa-star-o"></i>
                                            <i class="far fa-star-o"></i>
                                            <i class="far fa-star-o"></i>
                                            <i class="far fa-star-o"></i>
                                            <span class="rating-value">1%</span><!-- /.rating-value -->
                                        </div><!-- /.rating-icons -->
                                    </div>
                                </div>

                                <div class="review-contents">
                                    <ol class="review-list">
                                        @foreach($reviews as $review)
                                        <li class="review">
                                            <div class="row">
                                                <div class="col-md-5">
                                                    <div class="media">
                                                        @php
                                                            $user = \App\User::where('id', $review->student_id)->select('name', 'image')->first();
                                                        @endphp
                                                        <img  class="rounded author-avatar" src="{{asset($user->image)}}" alt="Avatar">
                                                        <div class="author-details media-body">
                                                            <span class="time">{{ \Carbon\Carbon::parse($review->created_at)->format("j S F Y")}}</span>
                                                            <h3 class="name">{{$user->name}}</h3><!-- /.name -->
                                                        </div><!-- /.author-details -->
                                                    </div>
                                                </div>
                                                <div class="col-md-7">
                                                    <div class="review-details">
                                                        <h3 class="title">{{$review->title}}</h3><!-- /.title -->
                                                        <div class="rating">
                                                            <input type="hidden" class="rating-tooltip-manual" data-filled="fas fa-star" data-empty="far fa-star" value="{{$review->rating}}" data-fractions="{{$review->rating}}"/>
                                                        </div><!-- /.rating -->
                                                        <p>
                                                            {{$review->comment}}
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        @endforeach
                                    </ol><!-- /.review-list -->
                                </div><!-- /.review-contents -->
                            </div>

                            <div class="btn-container mt-3 text-center">
                               {{$reviews->links()}}
                            </div><!-- /.btn-container -->
                        </div><!-- /.course-single-details -->


                        <div class="related-courses">
                            <h2 class="section-title">Related Courses</h2>
                            <div class="course-items">
                                <div class="row">
                                    @foreach($randoms as $course)
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
                            </div><!-- /.course-items -->
                        </div><!-- /.related-courses -->
                    </div>

                    <div class="col-md-4">
                        <aside class="sidebar">
                            <a href="{{route('checkout', $courseDetails->id)}}" class="btn btn-lg enroll-btn">Enroll now</a>

                            <div class="info">
                                <ul class="info-list">
                                    <li><span class="price"><span class="current-price">${{$courseDetails->offer_price}}</span> <span class="previous-price">${{$courseDetails->course_fee}}</span></span></li>
                                    <li><span>{{$courseDetails->chapter}} Chapter</span></li>
                                    <li><span>{{$courseDetails->lecture}} Lectures</span></li>
                                    <li><span>{{$courseDetails->total_video}} Hours on-demand video</span></li>
                                    <li><span>{{$courseDetails->total_quiz}} Quizes</span></li>
                                    <li><span>{{$courseDetails->total_student}} Students enrolled</span></li>
                                    <li><span>Certificate on Completion</span></li>
                                </ul>
                            </div>
                        </aside><!-- /.sidebar -->
                    </div>
                </div><!-- /.row -->
            </div><!-- /.container -->
        </div><!-- /.section-padding -->
    </section>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><input class="modal-title" type="text" id="title" value="" style="border:none"></h5>
                </div>
                <div class="modal-body" id="myMainDiv">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script src="{{asset('frontend/assets/js/bootstrap.bundle.min.js')}}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script>
        jQuery(document).ready(function($){

            // get video
            $(".getVideoId").click(function (e) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                    }
                });
                e.preventDefault();
                let lectureId = $(this).attr("videoid");
                let myTitle = $(this).attr("myTitleOne");

                let myLink = 'http://127.0.0.1:8000/student/demo/video/'+lectureId;
                var type = "GET";
                let myData = "";

                $.ajax({
                    type: type,
                    url: myLink,
                    dataType: 'json',
                    success: function (data) {
                        myData = '<video  class="vidchaVideo" muted controls style="width: 100%" height="350px">';
                        myData += '<source src="{{asset('/')}}'+data.video+'">';
                        myData += '</video>';
                        $('#myMainDiv').html(myData);

                        $("#title").attr("value", myTitle);
                        $('#exampleModal').modal('show');
                    },
                    error: function (data) {
                        console.log(data);
                    }
                });
            });
        });
    </script>


@endpush
