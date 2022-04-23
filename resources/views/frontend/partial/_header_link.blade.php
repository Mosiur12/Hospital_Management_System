<meta charset="utf-8">
<meta http-equiv="x-ua-compatible" content="ie=edge">
{{--<title>Welcome to Online Course</title>--}}
<title>@yield('title')</title>
<meta name="description" content="CourseWare - HTML5 Template By Jewel Theme">
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- favicon -->
<link rel="icon" href="{{asset($icon->favicon)}}" sizes="32x32">

<link rel="apple-touch-icon-precomposed" href="{{asset('frontend')}}/images/favicon-300x300.png">


<!-- Import Template Icons CSS Files -->
<link rel="stylesheet" href="{{asset('frontend')}}/assets/css/font-awesome.min.css">
<link rel="stylesheet" href="{{asset('frontend')}}/assets/css/simple-line-icons.css">

<!-- Import Bootstrap CSS File -->

<link rel="stylesheet" href="{{asset('frontend')}}/assets/css/bootstrap.min.css">

<!-- Import External CSS Files -->

<link rel="stylesheet" href="{{asset('frontend')}}/assets/css/owl.carousel.min.css">
<link rel="stylesheet" href="{{asset('frontend')}}/assets/css/magnific-popup.css">
<link rel="stylesheet" href="{{asset('frontend')}}/assets/css/selectric.css">

@stack('css')

<!-- Import Template's CSS Files -->

<link rel="stylesheet" href="{{asset('frontend')}}/assets/css/style.css">
<link rel="stylesheet" href="{{asset('frontend')}}/assets/css/responsive.css">


