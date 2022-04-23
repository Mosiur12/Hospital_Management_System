@extends('frontend.master')

@section('title', 'Event Registration')

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
                    <h2 class="section-title" style="color: #fff"> Event <i class="fa fa-angle-double-right"> </i> Event Registration </h2>
                </div><!-- /.container -->
            </div><!-- /.section-padding -->
        </div><!-- /.overlay -->
    </section>

    <section class="login-register">
        <div class="section-padding">
            <div class="container">
                <div class="contents text-center">

                    <h2 class="section-title">Event Register</h2>

                    <form class="register-form" id="register-form" action="{{route('event.registration')}}" method="post">
                        @csrf

                        <p class="form-input">
                            @if(\Illuminate\Support\Facades\Auth::check())
                            <input type="text" name="name" id="user_name" class="input @error('name') is-invalid @enderror"  value="{{\Illuminate\Support\Facades\Auth::user()->name}}" placeholder="Name" required="">
                            @else
                                <input type="text" name="name" id="user_name" class="input @error('name') is-invalid @enderror"  value="{{ old('name')}}" placeholder="Name" required="">
                            @endif
                        </p>

                        <p class="form-input">
                            @if(\Illuminate\Support\Facades\Auth::check())
                            <input type="email" name="email" id="user_email" class="input @error('email') is-invalid @enderror"  value="{{\Illuminate\Support\Facades\Auth::user()->email}}" placeholder="Email" required="">
                            @else
                                <input type="email" name="email" id="user_email" class="input @error('email') is-invalid @enderror"  value="{{ old('email') }}" placeholder="Email" required="">
                            @endif
                        </p>

                        <p class="form-input">
                            @if(\Illuminate\Support\Facades\Auth::check())
                                <input type="text" name="phone" id="phone" class="input @error('phone') is-invalid @enderror"  value="{{\Illuminate\Support\Facades\Auth::user()->phone}}" placeholder="Phone" required="">
                            @else
                                <input type="text" name="phone" id="phone" class="input @error('phone') is-invalid @enderror"  value="{{ old('phone') }}" placeholder="Phone" required="">
                            @endif
                        </p>

                        <input type="hidden" name="event_id" value="{{$event_id}}">

                        <p class="form-input">
                            <input type="submit" class="btn" value="Registration Now">
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
