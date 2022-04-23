<div class="left side-menu">
    <div class="sidebar-inner slimscrollleft">
        <div class="user-details">
            <div class="text-center">
                <img src="{{asset(\Illuminate\Support\Facades\Auth::user()->image)}}" alt="" class="img-circle">
            </div>
            <div class="user-info">
                <div class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">{{\Illuminate\Support\Facades\Auth::user()->name}}</a>
                    <ul class="dropdown-menu">
                        <li><a href="{{route('instructor.profile')}}"> Profile</a></li>
                        <li><a href="{{route('home')}}"> Home</a></li>
                        <li class="divider"></li>
                        <li>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </div>

                <p class="text-muted m-0"><i class="fa fa-dot-circle-o text-success"></i> Online</p>
            </div>
        </div>
        <!--- Divider -->
        <div id="sidebar-menu">
            <ul>
                <li>
                    <a href="{{route('instructor.dashboard')}}" class="waves-effect {{\Illuminate\Support\Facades\Request::is('instructor/dashboard') ? 'active': ''}}"><i class="ti-home"></i><span> Dashboard </span></a>
                </li>
                <li>
                    <a href="{{route('instructor.courses.index')}}" class="waves-effect {{\Illuminate\Support\Facades\Request::is('instructor/courses/*') ? 'active': ''}}{{\Illuminate\Support\Facades\Request::is('instructor/content/*') ? 'active': ''}}{{\Illuminate\Support\Facades\Request::is('instructor/lectures/*') ? 'active': ''}}{{\Illuminate\Support\Facades\Request::is('instructor/course/review/*') ? 'active': ''}}"><i class="fa fa-book"></i><span> Courses </span></a>
                </li>

                <li>
                    <a href="{{route('instructor.withdraws.index')}}" class="waves-effect {{\Illuminate\Support\Facades\Request::is('instructor/withdraws/*') ? 'active': ''}}"><i class="fa fa-credit-card"></i><span> Withdraw </span></a>
                </li>
                <li>
                    <a href="{{route('instructor.payments.index')}}" class="waves-effect {{\Illuminate\Support\Facades\Request::is('instructor/payments/*') ? 'active': ''}}"><i class="fa fa-money"></i><span> Payment History </span></a>
                </li>
                <li>
                    <a href="{{route('instructor.profile')}}" class="waves-effect {{\Illuminate\Support\Facades\Request::is('instructor/profile/*') ? 'active': ''}}"><i class="fa fa-user"></i><span> Profile </span></a>
                </li>

                <li>
                    <a href="{{route('instructor.password.change')}}" class="waves-effect {{\Illuminate\Support\Facades\Request::is('instructor/password/change') ? 'active': ''}}"><i class="fa fa-key"></i><span> Change Password </span></a>
                </li>



                {{--
                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect"><i class="ti-map-alt"></i><span> Maps </span><span class="pull-right"><i class="mdi mdi-plus"></i></span></a>
                    <ul class="list-unstyled">
                        <li><a href="maps-google.html"> Google Map</a></li>
                        <li><a href="maps-vector.html"> Vector Map</a></li>
                    </ul>
                </li>

                <li>
                    <a href="calendar.html" class="waves-effect"><i class="ti-calendar"></i><span> Calendar <span class="badge badge-primary pull-right">NEW</span></span></a>
                </li>

                --}}
            </ul>
        </div>
        <div class="clearfix"></div>
    </div> <!-- end sidebarinner -->
</div>
