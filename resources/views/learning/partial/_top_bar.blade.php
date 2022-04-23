<div class="topbar">
    <!-- LOGO -->
    <div class="topbar-left">
        <div class="text-center">
            <a href="{{route('student.dashboard')}}" class="logo"><img src="{{asset('/')}}assets/images/logo_white_2.png" height="28" style="width: 94%;height: 45px;"></a>
            <a href="{{route('student.dashboard')}}" class="logo-sm"><img src="{{asset('/')}}assets/images/logo_sm.png" height="36"></a>
        </div>
    </div>
    <!-- Button mobile view to collapse sidebar menu -->
    <div class="navbar navbar-default" role="navigation">
        <div class="container">
            <div class="">
                <div class="pull-left">
                    <button type="button" class="button-menu-mobile open-left waves-effect waves-light">
                        <i class="ion-navicon"></i>
                    </button>
                    <span class="clearfix"></span>
                </div>

                <ul class="nav navbar-nav navbar-right pull-right">
                    <li class="hidden-xs">
                        <a href="#" id="btn-fullscreen" class="waves-effect waves-light"><i class="fa fa-crosshairs"></i></a>
                    </li>
                    <li class="dropdown">
                        <a href="" class="dropdown-toggle profile waves-effect waves-light" data-toggle="dropdown" aria-expanded="true"><img src="{{asset(\Illuminate\Support\Facades\Auth::user()->image)}}" alt="user-img" class="img-circle"> </a>
                        <ul class="dropdown-menu">
                            <li><a href="{{route('home')}}"> Home </a></li>
                            <li><a href="{{route('student.dashboard')}}"> Dashboard </a></li>
                            <li><a href="{{route('student.profile')}}"> Profile</a></li>
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
                    </li>
                </ul>
            </div>
            <!--/.nav-collapse -->
        </div>
    </div>
</div>
