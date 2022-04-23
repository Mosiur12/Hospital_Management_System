<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Xadmino - Responsive Admin Dashboard Template</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta content="Admin Dashboard" name="description" />
    <meta content="ThemeDesign" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <link rel="shortcut icon" href="{{asset('/')}}assets/images/favicon.ico">

    <link href="{{asset('/')}}assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="{{asset('/')}}assets/css/icons.css" rel="stylesheet" type="text/css">
    <link href="{{asset('/')}}assets/css/style.css" rel="stylesheet" type="text/css">

</head>


<body>

<!-- Begin page -->
<div class="accountbg"></div>
<div class="wrapper-page">
    <div class="panel panel-color panel-primary panel-pages">

        <div class="panel-body">
            <h3 class="text-center m-t-0 m-b-30">
                <span class=""><img src="{{asset('/')}}assets/images/logo_dark.png" alt="logo" height="32"></span>
            </h3>
            <h4 class="text-muted text-center m-t-0"><b>Reset Password</b></h4>

            <form class="form-horizontal m-t-20" action="{{route('password.email')}}" method="post">

                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    Enter your <b>Email</b> and instructions will be sent to you!
                </div>

                @csrf
                <div class="form-group">
                    <div class="col-xs-12">
                        <input value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror" name="email" type="email" required="" placeholder="Enter Your email">
                    </div>
                </div>
                @error('email')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror

                <div class="form-group text-center m-t-20">
                    <div class="col-xs-12">
                        <button class="btn btn-primary w-md waves-effect waves-light" type="submit">Send Mail</button>
                    </div>
                </div>

                <div class="form-group m-t-30 m-b-0">
                    <div class="col-sm-5">
                        <a href="{{route('register')}}" class="text-muted">Create an account</a>
                    </div>
                    <div class="col-sm-5 text-right">
                        <a href="{{route('login')}}" class="text-muted"><i class="fa fa-lock m-r-5"></i> Login</a>
                    </div>
                </div>

            </form>
        </div>

    </div>
</div>


</body>
</html>
