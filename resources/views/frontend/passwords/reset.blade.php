@extends('frontend.master')

@section('title', 'Password Reset From')

@push('css')
    <link rel="stylesheet" href="{{asset('frontend')}}/assets/css/woocommerce.css">
    <link rel="stylesheet" href="{{asset('frontend')}}/assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="{{asset('frontend')}}/assets/css/magnific-popup.css">
    <link rel="stylesheet" href="{{asset('frontend')}}/assets/css/timeTo.css">
@endpush

@section('main-content')
    <section class="page-name background-bg" data-image-src="{{asset('frontend')}}/images/breadcrumb.jpg">
        <div class="overlay">
            <div class="section-padding">
                <div class="container text-center">
                    <h2 class="section-title" style="color: #fff"> Password Reset From</h2>
                </div><!-- /.container -->
            </div><!-- /.section-padding -->
        </div><!-- /.overlay -->
    </section>

    <section class="login-register">
        <div class="section-padding">
            <div class="container">
                <div class="contents text-center">

                    <h2 class="section-title">Password Reset Form</h2>

                    <form class="register-form" id="register-form" action="{{ route('password.update') }}" method="post">
                        @csrf

                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="form-group">
                            <div class="col-xs-12">
                                <input value="{{ $email ?? old('email') }}" class="form-control @error('email') is-invalid @enderror" name="email" type="email" required="" placeholder="Enter Your email">
                            </div>
                        </div>
                        @error('email')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror

                        <div class="form-group">
                            <div class="col-xs-12">
                                <input value="{{old('password')}}" class="form-control @error('password') is-invalid @enderror" name="password" type="password" required="" placeholder="New password">
                            </div>
                        </div>
                        @error('password')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror

                        <div class="form-group">
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="Confirm password">
                        </div>


                        <div class="form-group m-t-30 m-b-0">
                            <div class="row">
                                <div class="col-sm-5">
                                    <a href="{{route('student.registration')}}" class="text-muted">Create an account</a>
                                </div>
                                <div class="col-sm-5 text-right">
                                    <a href="{{route('student.login')}}" class="text-muted"><i class="fa fa-lock m-r-5"></i> Login</a>
                                </div>
                            </div>
                        </div>

                        <p class="form-input">
                            <input type="submit" class="btn" value="Update Password">
                        </p>
                    </form>
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


