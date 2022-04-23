<script src="{{asset('/')}}assets/js/jquery.min.js"></script>
<script src="{{asset('/')}}assets/js/bootstrap.min.js"></script>
<script src="{{asset('/')}}assets/js/modernizr.min.js"></script>
<script src="{{asset('/')}}assets/js/detect.js"></script>
<script src="{{asset('/')}}assets/js/fastclick.js"></script>
<script src="{{asset('/')}}assets/js/jquery.slimscroll.js"></script>
<script src="{{asset('/')}}assets/js/jquery.blockUI.js"></script>
<script src="{{asset('/')}}assets/js/waves.js"></script>
<script src="{{asset('/')}}assets/js/wow.min.js"></script>
<script src="{{asset('/')}}assets/js/jquery.nicescroll.js"></script>
<script src="{{asset('/')}}assets/js/jquery.scrollTo.min.js"></script>

<script src="{{asset('/')}}assets/plugins/jquery-sparkline/jquery.sparkline.min.js"></script>

<!-- Datatables-->

<!-- Datatables-->
<script src="{{asset('assets')}}/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="{{asset('assets')}}/plugins/datatables/dataTables.bootstrap.js"></script>
<script src="{{asset('assets')}}/plugins/datatables/dataTables.responsive.min.js"></script>
<script src="{{asset('assets')}}/plugins/datatables/responsive.bootstrap.min.js"></script>

@stack('js_first')

<script src="{{asset('assets')}}/pages/dashborad.js"></script>

<script src="{{asset('assets')}}/js/app.js"></script>
<script src="{{asset('assets/js/toastr.min.js')}}"></script>
<script src="{{asset('assets/js/sweetalert2@10.js')}}"></script>

{!! Toastr::message() !!}

<script type="text/javascript">
    @if($errors->any())
        @foreach($errors->all() as $error)
            toastr.error('{{$error}}','Error', {closeButton:true, progressBar:true})
        @endforeach
    @endif
</script>


@stack('js_last')

