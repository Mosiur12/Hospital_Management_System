<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Registration</title>
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
            <h4 class="text-muted text-center m-t-0"><b>Sign Up</b></h4>

            <form class="form-horizontal m-t-20" action="{{route('register')}}" method="post">

                @csrf
                <div class="form-group">
                    <div class="col-xs-12">
                        <input value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror" name="name" type="text" required="" placeholder="Enter Your Name">
                    </div>
                </div>
                @error('name')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror

                @csrf
                <div class="form-group">
                    <div class="col-xs-12">
                        <input value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror" name="email" type="email" required="" placeholder="Enter Your email">
                    </div>
                </div>
                @error('email')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror

                <div class="form-group">
                    <div class="col-xs-12">
                        <input name="password" class="form-control @error('password') is-invalid @enderror" type="password" required="" placeholder="Enter Your Password">
                    </div>
                </div>

                @error('password')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror

                <div class="form-group">
                    <div class="col-xs-12">
                        <div class="checkbox checkbox-primary">
                            <input id="checkbox-signup" type="checkbox" checked="checked">
                            <label for="checkbox-signup">
                                I accept <a href="#">Terms and Conditions</a>
                            </label>
                        </div>

                    </div>
                </div>

                <div class="form-group text-center m-t-20">
                    <div class="col-xs-12">
                        <button class="btn btn-primary w-md waves-effect waves-light" type="submit">Register</button>
                    </div>
                </div>

                <div class="form-group m-t-30 m-b-0">
                    <div class="col-sm-12 text-center">
                        <a href="{{route('login')}}" class="text-muted">Already have account?</a>
                    </div>
                </div>

            </form>
        </div>

    </div>
</div>

</body>
</html>
