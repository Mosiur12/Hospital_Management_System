@extends('frontend.master')

@section('title', 'About Us')

@section('main-content')
    <section class="page-name background-bg" data-image-src="{{asset('frontend')}}/images/breadcrumb.jpg">
        <div class="overlay">
            <div class="section-padding">
                <div class="container text-center">
                    <h2 class="section-title" style="color: #fff"> About us </h2>
                </div><!-- /.container -->
            </div><!-- /.section-padding -->
        </div><!-- /.overlay -->
    </section>




    <section class="about-us text-center">
        <div class="section-padding">
            <div class="container">

                <div class="top-content">
                    <h2 class="section-title">Our history</h2><!-- /.section-title -->
                    <p>
                        Something’s fallen down in there
                    </p>
                </div><!-- /.top-content -->

                <div>
                    {!! $aboutSettings->our_history !!}
                </div>

                <img src="{{asset($aboutSettings->featured_image)}}" alt="About Image">

                <div class="row">
                    <div class="col-md-6">
                        <h2 class="section-title">Our mission</h2>
                        <div>
                            {!! $aboutSettings->our_mission !!}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <h2 class="section-title">Our visioin</h2>
                        <div>
                            {!! $aboutSettings->our_vision !!}
                        </div>
                    </div>
                </div><!-- /.row -->
            </div><!-- /.container -->
        </div><!-- /.section-padding -->
    </section>

    <section class="facts facts-02 background-bg" data-image-src="{{asset('frontend')}}/images/ab-bg.jpg">
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

    <section class="team text-center">
        <div class="section-padding">
            <div class="container">
                <div class="top-content">
                    <h2 class="section-title">Our team</h2>
                    <p>
                        Donec rutrum congue leo eget malesuada
                    </p>
                </div>

                <div class="row">
                    @foreach($ourTeamMembers as $ourTeamMember)
                    <div class="col-md-3">
                        <div class="member">
                            <div class="member-avatar">
                                <img src="{{asset($ourTeamMember->image)}}" alt="Member Avatar">
                            </div>
                            <div class="member-details">
                                <h4 class="name"><a href="#">{{$ourTeamMember->name}}</a></h4><!-- /.name -->
                                <span class="designation">{{$ourTeamMember->designation}}</span>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

@endsection
