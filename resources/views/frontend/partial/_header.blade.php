<header class="masthead">
    <div class="container">
        <div class="row">
            <div class="col-md-10">
                <nav class="navbar navbar-expand-md">
                    <a class="navbar-brand" href="{{route('home')}}"><img src="{{asset($logo->logo)}}" alt="Logo"></a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-menu" aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"><i class="fas fa-bars"></i></span>
                    </button>
                    <div class="collapse navbar-collapse" id="main-menu">
                        <ul class="navbar-nav">
                            <li class="nav-item menu-item-has-children dropdown {{\Illuminate\Support\Facades\Request::is('/') ? 'active': ''}}">
                                <a class="nav-link" href="{{route('home')}}" aria-haspopup="true" aria-expanded="false">Home</a>
                            </li>

                            <li class="nav-item menu-item-has-children dropdown {{\Illuminate\Support\Facades\Request::is('category-course/*') ? 'active': ''}} {{\Illuminate\Support\Facades\Request::is('all-course') ? 'active': ''}} {{\Illuminate\Support\Facades\Request::is('search-course') ? 'active': ''}} {{\Illuminate\Support\Facades\Request::is('course-details/*') ? 'active': ''}}">
                                <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Courses</a>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="{{route('course.all')}}">All Courses</a>
                                    @foreach($categories as $category)
                                        <a class="dropdown-item" href="{{route('course.category', $category->id)}}">{{$category->name}}</a>
                                    @endforeach
                                </div>
                            </li>

                            <li class="nav-item menu-item-has-children dropdown {{\Illuminate\Support\Facades\Request::is('about') ? 'active': ''}}">
                                <a class="nav-link" href="{{route('about')}}" aria-haspopup="true" aria-expanded="false">About Us</a>
                            </li>

                            <li class="nav-item menu-item-has-children dropdown {{\Illuminate\Support\Facades\Request::is('contact') ? 'active': ''}}">
                                <a class="nav-link" href="{{route('contact')}}" aria-haspopup="true" aria-expanded="false">Contact</a>
                            </li>

                            <li class="nav-item menu-item-has-children dropdown {{\Illuminate\Support\Facades\Request::is('instructor') ? 'active': ''}}{{\Illuminate\Support\Facades\Request::is('instructor-details/*') ? 'active': ''}}">
                                <a class="nav-link" href="{{route('course.instructor')}}" aria-haspopup="true" aria-expanded="false">Instructor</a>
                            </li>

                            <li class="nav-item menu-item-has-children dropdown {{\Illuminate\Support\Facades\Request::is('event/*') ? 'active': ''}}">
                                <a class="nav-link" href="{{route('event.list')}}" aria-haspopup="true" aria-expanded="false">Event</a>
                            </li>


                            @if(Auth::check())
                                @php
                                    $user_type = \Illuminate\Support\Facades\Auth::user()->user_type;
                                @endphp
                                <li class="nav-item menu-item-has-children dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{\Illuminate\Support\Facades\Auth::user()->name}}</a>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="{{route($user_type.'.dashboard')}}">Dashboard</a>
                                        {{--<a class="dropdown-item" href="">Log Out</a>--}}
                                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                            @csrf
                                        </form>
                                    </div>
                                </li>
                            @else
                                <li class="nav-item menu-item-has-children dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Login</a>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="{{route('student.login')}}">Login</a>
                                        <a class="dropdown-item" href="{{route('student.registration')}}">Registration</a>
                                    </div>
                                </li>
                            @endif
                        </ul>
                    </div>
                </nav>
            </div>

            <div class="col-md-2">
                <div class="menu-search-form dropdown float-right">
                    <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-search"></i>
                    </a>
                    <div class="dropdown-menu">
                        <form action="{{route('course.search')}}" class="course-search-form" method="post">
                            @csrf
                            <input type="text" name="search" id="search" class="search" placeholder="Find a course or tutorial ">
                            <input type="submit" name="submit" id="search-submit" class="sreach-submit">
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div><!-- /.container -->
</header>
