@extends('admin.master')

@section('title', 'Change Password')

@section('main-content')
    <div class="row">
        <div class="col-sm-12">
            <div class="page-header-title">
                <h4 class="pull-left page-title">Change Password</h4>
                <ol class="breadcrumb pull-right">
                    <li><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                    <li class="active">Change Password</li>
                </ol>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">Change Password</h3>
                </div>

                <div class="panel-body">
                    <div class="row">
                        <div class="col-xs-12">
                            <form role="form" action="{{route('admin.password.change')}}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="name">Old Password</label>
                                    <input type="password" name="old_pass" value="{{old('old_pass')}}" class="form-control @error('old_pass') is-invalid @enderror" id="ex1" placeholder="Enter Your Old Password">
                                </div>
                                @error('old_pass')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror

                                <div class="form-group">
                                    <label for="name">New Password</label>
                                    <input type="password" name="password" value="{{old('password')}}" class="form-control @error('password') is-invalid @enderror" id="ex1" placeholder="Enter Your New Password">
                                </div>
                                @error('password')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror

                                <div class="form-group">
                                    <label for="name">Confirm Password</label>
                                    <input id="password-confirm" type="password" class="form-control  @error('password_confirmation') is-invalid @enderror" name="password_confirmation" required autocomplete="new-password" placeholder="Confirm password">
                                </div>
                                @error('password_confirmation')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror

                                <button type="submit" class="btn btn-success waves-effect waves-light">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

