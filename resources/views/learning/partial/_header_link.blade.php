<meta charset="utf-8" />
<title>@yield('title')</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<meta content="Admin Dashboard" name="description" />
<meta content="ThemeDesign" name="author" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />

<link rel="shortcut icon" href="{{asset('/')}}assets/images/favicon.ico">

<!-- DataTables -->
<link href="{{asset('/')}}assets/plugins/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
<link href="{{asset('/')}}assets/plugins/datatables/responsive.bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="{{asset('/')}}assets/plugins/datatables/dataTables.bootstrap.min.css" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" href="{{asset('/')}}assets/css/toastr.min.css">

<meta name="csrf-token" content="{{ csrf_token() }}">

@stack('css')

<link href="{{asset('/')}}assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
<link href="{{asset('/')}}assets/css/icons.css" rel="stylesheet" type="text/css">
<link href="{{asset('/')}}assets/css/style.css" rel="stylesheet" type="text/css">

@stack('css_second')

