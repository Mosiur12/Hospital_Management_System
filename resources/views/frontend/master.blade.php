<!doctype html>

<html class="no-js" lang="en-US">

<head>
    @include('frontend.partial._header_link')
</head>
<body>

@include('frontend.partial._header')

@yield('main-content')

@include('frontend.partial._footer')

@include('frontend.partial._footer_link')
</body>
</html>
