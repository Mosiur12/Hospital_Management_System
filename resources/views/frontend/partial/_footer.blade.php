<footer class="site-footer">
    <div class="footer-top light-black">
        <div class="section-padding" style="padding: 50px 0px 12px 0px;">
            <div class="container">
                <div class="row">
                    <div class="col-lg-5 col-md-6">
                        <div class="widget widget_about_us">
                            <!-- <h4>Courseware</h4> -->
                            <img class="footer-logo" src="{{asset('assets/images/logo_white_2.png')}}" alt="Site Logo">
                            <div class="widget-details">
                                <p>
                                    {{$settings->short_desc}}
                                </p>
                                <ul>
                                    <li> <i class="fa fa-phone-square"></i>{{$settings->phone}}</li>
                                    <li> <i class="fa fa-location-arrow"></i> {{$settings->address}}</li>
                                    <li> <i class="fa fa-envelope-square"></i> <a href="#"> <span class="__cf_email__" data-cfemail="{{$settings->email}}">{{$settings->email}}</span></a></li>
                                </ul>
                                <div class="widget-social text-center">
                                    <a href="{{$settings->facebook_url}}" target="_blank"><i class="fab fa-facebook-f"></i></a>
                                    <a href="{{$settings->twitter_url}}" target="_blank"><i class="fab fa-twitter"></i></a>
                                    <a href="{{$settings->google_plus_url}}" target="_blank"><i class="fab fa-google-plus-square"></i></a>
                                    <a href="{{$settings->youtube_url}}" target="_blank"><i class="fab fa-youtube"></i></a>
                                </div><!-- /.widget-social -->
                            </div><!-- /.widget-details -->
                        </div><!-- /.widget -->
                    </div>

                    <div class="col-lg-3 col-md-6">
                        <div class="widget widget_nav_menu">
                            <h4>Quick Links</h4>
                            <div class="widget-details">
                                <ul class="menu">
                                    <li class="menu-item"><a href="{{route('home')}}"><i class="fa fa-angle-double-right"></i>Home</a></li>
                                    <li class="menu-item"><a href="{{route('course.all')}}"><i class="fa fa-angle-double-right"></i>All Courses</a></li>
                                    {{--<li class="menu-item"><a href="#"><i class="fa fa-angle-double-right"></i> Events</a></li>--}}
                                    <li class="menu-item"><a href="{{route('about')}}"><i class="fa fa-angle-double-right"></i> About Us</a></li>
                                    {{--<li class="menu-item"><a href="#"><i class="fa fa-angle-double-right"></i> Gallery</a></li>
                                    <li class="menu-item"><a href="#"><i class="fa fa-angle-double-right"></i> Become a Teacher</a></li>--}}
                                    <li class="menu-item"><a href="{{route('contact')}}"><i class="fa fa-angle-double-right"></i> Contact</a></li>
                                    <li class="menu-item"><a href="{{route('course.instructor')}}"><i class="fa fa-angle-double-right"></i> Our Instructor</a></li>
                                </ul>
                            </div><!-- /.widget-details -->
                        </div><!-- /.widget -->
                    </div>


                    <div class="col-lg-3 col-md-6">
                        <div class="widget widget_recnt_news">
                            <h4>Events</h4>
                            <div class="widget-details">
                                @if($events->count() > 0)
                                @foreach($events as $event)
                                <article class="post type-post media">
                                    <div class="entry-thumbnail float-left"><img src="{{asset($event->img)}}" alt="Entry Thumbnail"></div><!-- /.entry-thumbnail -->
                                    <div class="entry-content media-body">
                                        <h3 class="entry-title"><a href="{{route('event.details', $event->id)}}">{{$event->title}}</a></h3><!-- /.entry-thumbnail -->
                                    </div><!-- /.entry-content -->
                                </article><!-- /.post -->
                                @endforeach
                                <div class="widget-details text-center">
                                    <ul class="menu">
                                        <li class="menu-item"><a href="{{route('event.list')}}"><i class="fa fa-angle-double-right"></i>View all</a></li>
                                    </ul>
                                </div>
                                @else
                                    <article class="post type-post media">
                                        <div class="text-warning">No Event Available</div>
                                    </article>
                                @endif

                            </div><!-- /.widget-details -->
                        </div><!-- /.widget -->
                    </div>
                </div><!-- /.row -->
            </div><!-- /.container -->
        </div><!-- /.section-padding -->
    </div><!-- /.footer-top -->

    <div class="footer-bottom black-bg">
        <div class="section-padding" style="padding: 35px;">
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <div class="copy-right float-left">
                            <span> Copyright © {{date("Y")}} <a href="{{route('home')}}" target="_blank" rel="nofollow">{{$settings->platform_name}}</a>, All rights reservs   && Developed By <a href="{{$settings->developer_link}}" target="_blank" rel="nofollow">{{$settings->developer_name}}</a></span>
                        </div><!-- /.copy-right -->
                    </div>
                    <div class="col-md-4">
                        <ul class="menu float-left">
                            <li class="menu-item"><a href="{{route('setting.privacy')}}"> Privacy</a></li>
                            <li class="menu-item"><a href="{{route('setting.terms')}}"> Terms</a></li>
                            {{--<li class="menu-item"><a href="#"> Sitemap</a></li>--}}
                        </ul>
                    </div>
                </div><!-- /.row -->
            </div><!-- /.container -->
        </div><!-- /.section-padding -->
    </div><!-- /.footer-bottom -->
</footer>
