<!DOCTYPE html>
<html>
<head>
    @include('instructor.partial._header_link')
</head>


<body class="fixed-left">

<!-- Begin page -->
<div id="wrapper">

    <!-- Top Bar Start -->
    @include('instructor.partial._top_bar')
    <!-- Top Bar End -->


    <!-- ========== Left Sidebar Start ========== -->

    @include('instructor.partial._left_side_menu')
    <!-- Left Sidebar End -->

    <!-- Start right Content here -->

    <div class="content-page">
        <!-- Start content -->
        <div class="content">
            <div class="container">
                @yield('main-content')
            </div> <!-- container -->

        </div> <!-- content -->

        @include('instructor.partial._footer')

    </div>
    <!-- End Right content here -->

</div>
<!-- END wrapper -->


<!-- jQuery  -->
@include('instructor.partial._footer_link')
@stack('js')
</body>
</html>
