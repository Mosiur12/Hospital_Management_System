@extends('frontend.master')

@section('title', 'login')

@section('main-content')
    <section class="page-name background-bg" data-image-src="{{asset('frontend')}}/images/breadcrumb.jpg">
        <div class="overlay">
            <div class="section-padding">
                <div class="container text-center">
                    <h2 class="section-title" style="color: #fff"> Login</h2>
                </div>
            </div>
        </div>
    </section>


    <section class="login-register">
        <div class="section-padding">
            <div class="container">
                <div class="contents text-center">

                    <h2 class="section-title">Log in to your account</h2>

                    <form class="sign-in-form" id="sign-in-form" action="{{route('login')}}" method="post">
                        @csrf

                        <p class="form-input">
                            <input type="email" name="email" id="user_email" class="input @error('email') is-invalid @enderror"  value="{{ old('email') }}" placeholder="Email" required="">
                        </p>
                        <p class="form-input">
                            <input type="password" name="password" id="password" class="input @error('password') is-invalid @enderror" value="" placeholder="Password" required="" autocomplete="new-password">
                        </p>

                        <p class="checkbox">
                            <input name="rememberme" type="checkbox" class="rememberme float-left" value="Remember Me">
                            Remember Me
                            <a href="{{ route('password.request') }}" class="float-right" title="Recover Your Lost Password">Forgot password?</a>
                        </p>

                        <p class="form-input">
                            <input type="submit" class="btn" value="Sign In">
                        </p>

                    </form>

<!--                    <div class="login-social">
                        <h2 class="section-title">Or login using</h2>
                        <button class="btn facebook"><i class="fab fa-facebook"></i> Facebook</button>
                        <button class="btn twitter"><i class="fab fa-twitter"></i> Twitter</button>
                        <button class="btn google"><i class="fab fa-google-plus"></i> Google</button>
                    </div>&lt;!&ndash; /.login-social &ndash;&gt;-->

                    <p class="register">
                        Don’t have an account? <a href="{{route('student.registration')}}">Register now</a>
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

