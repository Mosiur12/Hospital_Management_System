@extends('frontend.master')

@section('title', 'Instructor')

@section('main-content')

    <section class="page-name background-bg" data-image-src="{{asset('frontend')}}/images/breadcrumb.jpg">
        <div class="overlay">
            <div class="section-padding">
                <div class="container text-center">
                    <h2 class="section-title" style="color: #fff"> Instructors </h2>
                </div><!-- /.container -->
            </div><!-- /.section-padding -->
        </div><!-- /.overlay -->
    </section>

    <section class="instructors text-center">
        <div class="section-padding">
            <div class="container">
                <div class="row">

                    @if($instructors->count() > 0)
                        @foreach($instructors as $instructor)
                            <div class="col-md-3 col-sm-6">
                                <div class="instructor">
                                    <div class="avatar radius"><img style="background: #cfcfcf8c;" src="{{asset($instructor->image)}}" alt="Avatar Image"></div><!-- /.avatar -->
                                    <div class="instructor-details">
                                        <h3 class="name"><a href="{{route('course.instructor.details', $instructor->id)}}">{{$instructor->name}}</a></h3><!-- /.name -->
                                        @php
                                            $designation = \App\ContactInformation::where('user_id', $instructor->id)->select('designation')->first();
                                        @endphp
                                        <span class="designation" style="text-transform: capitalize;">{{$designation->designation == 'null' ? '' : $designation->designation}}</span><!-- /.designation -->
                                    </div><!-- /.instructor-details -->
                                </div><!-- /.instructor -->
                            </div>
                        @endforeach
                    @else
                        <div class="col-lg-3 col-md-6">
                            <div class="item">
                                <p class="text-warning" style="font-size: 20px;">There are No Instructor found</p>
                            </div>
                        </div>
                    @endif
                </div>

                <nav aria-label="Page navigation example">
                    <div style="text-align: center;">
                        {{ $instructors->links() }}
                    </div>
                </nav>
            </div>
        </div>
    </section>

@endsection
