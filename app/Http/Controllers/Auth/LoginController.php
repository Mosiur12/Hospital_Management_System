<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo;

    public function redirectTo()
    {
        if (Auth::user()->user_type == 'admin'){
            Toastr::success('Your are successfully Log In', 'Success');
            return 'admin/dashboard';
        }elseif(Auth::user()->user_type == 'instructor')
        {
            Toastr::success('Your are successfully Log In', 'Success');
            return 'instructor/dashboard';
        }elseif(Auth::user()->user_type == 'student')
        {
            Toastr::success('Your are successfully Log In', 'Success');
            return '/';
        }
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
