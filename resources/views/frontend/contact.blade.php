@extends('frontend.master')

@section('title', 'Contact With Us')

@section('main-content')

    <section class="page-name background-bg" data-image-src="{{asset('frontend')}}/images/breadcrumb.jpg">
        <div class="overlay">
            <div class="section-padding">
                <div class="container text-center">
                    <h2 class="section-title" style="color: #fff"> Contact us </h2>
                </div><!-- /.container -->
            </div><!-- /.section-padding -->
        </div><!-- /.overlay -->
    </section>

    <section class="contact text-center">
        <div class="section-padding">
            <div class="container">
                <div class="row">
                    <div class="col-md-4">
                        <div class="item">
                            <div class="item-icon">
                                <i class="icon icon-call-out"></i>
                            </div><!-- /.item-icon -->
                            <h3 class="item-title">Phone</h3><!-- /.item-title -->
                            <span>(+88) {{$setting->phone}}</span>
                        </div><!-- /.item -->
                    </div><!-- /.col-md-4 -->

                    <div class="col-md-4">
                        <div class="item">
                            <div class="item-icon">
                                <i class="icon icon-location-pin"></i>
                            </div><!-- /.item-icon -->
                            <h3 class="item-title">Address</h3><!-- /.item-title -->
                            <span>{{$setting->address}}</span>
                        </div><!-- /.item -->
                    </div><!-- /.col-md-4 -->

                    <div class="col-md-4">
                        <div class="item">
                            <div class="item-icon">
                                <i class="icon icon-envelope-open"></i>
                            </div><!-- /.item-icon -->
                            <h3 class="item-title">Email</h3><!-- /.item-title -->
                            <span><a href="#"><span class="__cf_email__" data-cfemail="">{{$setting->email}}</span></a></span>
                        </div><!-- /.item -->
                    </div><!-- /.col-md-4 -->
                </div><!--/.row-->


                <form action="{{route('contact.submit')}}" class="wpcf7-form" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{old('name')}}" placeholder="Your Name*" required>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{old('email')}}" placeholder="Your Email*" required>
                    <input type="text" class="form-control @error('subject') is-invalid @enderror" name="subject" value="{{old('subject')}}" placeholder="Subject" required>
                    <textarea name="message" class="form-control @error('message') is-invalid @enderror" cols="30" rows="7" placeholder="Your Message">{{old('message')}}</textarea>
                    <input type="submit" class="btn" value="Send Message">
                </form>
                <div id="googleMaps" class="google-map-container"></div>
            </div>
        </div>
    </section>

    <section class="subscribe text-center gray-bg">
        <div class="section-padding">
            <div class="container">
                <h4>Subscribe For Update</h4>

                <form class="mc4wp-form mc4wp-form-1971" action="{{route('subscription')}}" method="post">
                    @csrf
                    <input type="email" class="subscribe-email form-control @error('email') is-invalid @enderror" name="email" value="{{old('email')}}" placeholder="Enter Email Address Here" required>
                    <input class="subscribe-submit" type="submit" id="subscribe-submit" name="submit" value="Subscribe now">
                </form>
            </div>
        </div>
    </section>
@endsection

@push('css')
    <link rel="stylesheet" href="{{asset('/')}}assets/css/toastr.min.css">
@endpush
@push('js')
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD2jlT6C_to6X1mMvR9yRWeRvpIgTXgddM"></script>

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
