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
                        <li><a href="{{route('admin.profile')}}"> Profile</a></li>
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
                    <a href="{{route('admin.dashboard')}}" class="waves-effect {{\Illuminate\Support\Facades\Request::is('admin.dashboard') ? 'active': ''}}"><i class="ti-home"></i><span> Dashboard </span></a>
                </li>
<!--                <li>
                    <a href="{{--{{route('admin.roles.index')}}--}}" class="waves-effect {{--{{\Illuminate\Support\Facades\Request::is('admin/roles/*') ? 'active': ''}}--}}"><i class="fa fa-tasks"></i><span> Roles </span></a>
                </li>-->
                <li>
                    <a href="{{route('admin.categories.index')}}" class="waves-effect {{\Illuminate\Support\Facades\Request::is('admin/categories/*') ? 'active': ''}}"><i class="fa fa-list-alt"></i><span> Categories </span></a>
                </li>
                <li>
                    <a href="{{route('admin.instructors.index')}}" class="waves-effect {{\Illuminate\Support\Facades\Request::is('admin/instructors/*') ? 'active': ''}}"><i class="fa fa-users"></i><span> Instructors </span></a>
                </li>
                <li>
                    <a href="{{route('admin.students.index')}}" class="waves-effect {{\Illuminate\Support\Facades\Request::is('admin/students/*') ? 'active': ''}}"><i class="fa fa-users"></i><span> Students </span></a>
                </li>

                <li>
                    <a href="{{route('admin.courses.index')}}" class="waves-effect {{\Illuminate\Support\Facades\Request::is('admin/courses/*') ? 'active': ''}}{{\Illuminate\Support\Facades\Request::is('admin/course/review/*') ? 'active': ''}}{{\Illuminate\Support\Facades\Request::is('admin/search-course') ? 'active': ''}}"><i class="fa fa-book"></i><span> Course's </span></a>
                </li>
                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect {{\Illuminate\Support\Facades\Request::is('admin/withdraw/*') ? 'active subdrop': ''}}"><i class="fa fa-credit-card"></i> <span> Withdraw </span> <span class="pull-right"><i class="mdi mdi-plus"></i></span></a>
                    <ul class="list-unstyled">
                        <li><a href="{{route('admin.withdraw.request')}}" class="waves-effect {{\Illuminate\Support\Facades\Request::is('admin/withdraw/request') ? 'active': ''}}"><i class="fa fa-arrow-circle-right"></i><span> Withdraw Request </span></a></li>
                        <li><a href="{{route('admin.withdraw.history')}}" class="waves-effect {{\Illuminate\Support\Facades\Request::is('admin/withdraw/history') ? 'active': ''}}"><i class="fa fa-arrow-circle-right"></i><span> Withdraw History </span></a></li>
                    </ul>
                </li>
                <li>
                    <a href="{{route('admin.payments.index')}}" class="waves-effect {{\Illuminate\Support\Facades\Request::is('admin/payments/*') ? 'active': ''}}"><i class="fa fa-money"></i><span> Payment History </span></a>
                </li>
                <li>
                    <a href="{{route('admin.profile')}}" class="waves-effect {{\Illuminate\Support\Facades\Request::is('admin/profile/*') ? 'active': ''}}"><i class="fa fa-user"></i><span> Profile </span></a>
                </li>
                <li>
                    <a href="{{route('admin.password.change')}}" class="waves-effect {{\Illuminate\Support\Facades\Request::is('admin/password/change') ? 'active': ''}}"><i class="fa fa-key"></i><span> Change Password </span></a>
                </li>
                <li>
                    <a href="{{route('admin.subscriptions.index')}}" class="waves-effect {{\Illuminate\Support\Facades\Request::is('admin/subscriptions/*') ? 'active': ''}}"><i class="fa fa-align-justify"></i><span> Subscriptions </span></a>
                </li>
                <li>
                    <a href="{{route('admin.events.index')}}" class="waves-effect {{\Illuminate\Support\Facades\Request::is('admin/events/*') ? 'active': ''}}"><i class="fa fa-calendar"></i><span> Event </span></a>
                </li>
                <li>
                    <a href="{{route('admin.contacts.index')}}" class="waves-effect {{\Illuminate\Support\Facades\Request::is('admin/contacts/*') ? 'active': ''}}"><i class="fa fa-user"></i><span> Contacts </span></a>
                </li>
                <li>
                    <a href="{{route('admin.teams.index')}}" class="waves-effect {{\Illuminate\Support\Facades\Request::is('admin/teams/*') ? 'active': ''}}"><i class="fa fa-users"></i><span> Team Member </span></a>
                </li>
                <li>
                    <a href="{{route('admin.settings.index')}}" class="waves-effect {{\Illuminate\Support\Facades\Request::is('admin/settings/*') ? 'active': ''}}"><i class="fa fa-cog"></i><span> Settings </span></a>
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
