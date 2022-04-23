@extends('frontend.master')

@section('title', 'Student Registration')

@section('main-content')

    <section class="page-name background-bg" data-image-src="{{asset('frontend')}}/images/breadcrumb.jpg">
        <div class="overlay">
            <div class="section-padding">
                <div class="container text-center">
                    <h2 class="section-title" style="color: #fff"> Course <i class="fa fa-angle-double-right"> </i> Registration</h2>
                </div>
            </div>
        </div>
    </section>

    <section class="login-register">
        <div class="section-padding">
            <div class="container">
                <div class="contents text-center">

                    <h2 class="section-title">Register</h2>

                    <form class="register-form" id="register-form" action="{{route('register')}}" method="post">
                        @csrf

                        <p class="form-input">
                            <input type="text" name="name" id="user_name" class="input @error('name') is-invalid @enderror"  value="{{ old('name') }}" placeholder="Username">
                        </p>
                        <p class="form-input">
                            <input type="email" name="email" id="user_email" class="input @error('email') is-invalid @enderror"  value="{{ old('email') }}" placeholder="Email">
                        </p>


                        <p class="form-input">
                            <input type="password" name="password" id="password" class="input @error('password') is-invalid @enderror" value="" placeholder="Password" autocomplete="new-password">
                        </p>


                        <p class="form-input">
                            <input type="password" name="password_confirmation" id="password-confirm" class="input @error('password_confirmation') is-invalid @enderror" placeholder="Confirm Password" autocomplete="new-password">
                        </p>


                        <div class="row">
                            <div class="col-sm-8">
                                <p class="checkbox">
                                    <input name="remember" type="checkbox" class="rememberme float-left" value="Remember Me">
                                    I agree to the
                                    <a href="{{route('setting.terms')}}" class="" title="Recover Your Lost Password">Terms & Conditions</a>
                                </p>
                            </div>
                            <div class="col-sm-4 text-center">
                                <a href="{{route('student.login')}}" class="text-muted"><i class="fa fa-lock m-r-5"></i> Login</a>
                            </div>
                        </div>



                        <input type="hidden" name="user_type" value="student">

                        <p class="form-input">
                            <input type="submit" class="btn" value="Sign In">
                        </p>
                    </form>

<!--                    <div class="login-social">
                        <h2 class="section-title">Or Sign up using</h2>
                        <button class="btn facebook"><i class="fab fa-facebook"></i> Facebook</button>
                        <button class="btn twitter"><i class="fab fa-twitter"></i> Twitter</button>
                        <button class="btn google"><i class="fab fa-google-plus"></i> Google</button>
                    </div>&lt;!&ndash; /.login-social &ndash;&gt;-->

                    <p class="register">
                        Already have an account? <a href="{{route('student.login')}}">Sign in now</a>
                    </p>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('css')
    <link rel="stylesheet" href="{{asset('/')}}assets/css/toastr.min.css">
@endpush

@push('js')

    <script src="{{asset('assets/js/toastr.min.js')}}"></script>

    {!! Toastr::message() !!}

    <script type="text/javascript">
        @if($errors->any())
        @foreach($errors->all() as $error)
        toastr.error('{{$error}}','Error', {closeButton:true, progressBar:true})
        @endforeach
        @endif
    </script>
@endpush
