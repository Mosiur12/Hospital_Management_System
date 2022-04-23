@extends('frontend.master')

@section('title', 'Terms and Condition')

@section('main-content')
    <section class="page-name background-bg" data-image-src="{{asset('frontend')}}/images/breadcrumb.jpg">
        <div class="overlay">
            <div class="section-padding">
                <div class="container text-center">
                    <h2 class="section-title" style="color: #fff"> Terms and Condition </h2>
                </div><!-- /.container -->
            </div><!-- /.section-padding -->
        </div><!-- /.overlay -->
    </section>

    <section class="about-us text-center">
        <div class="section-padding">
            <div class="container">

                <div class="top-content">
                    <h2 class="section-title">Terms and Condition</h2><!-- /.section-title -->
                    <p>
                        Something’s fallen down in there
                    </p>
                </div>

                <div>
                    {!! $term->terms !!}
                </div>
            </div><!-- /.container -->
        </div><!-- /.section-padding -->
    </section>

@endsection
