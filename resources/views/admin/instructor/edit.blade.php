@extends('admin.master')

@section('title', 'Edit Instructor')

@section('main-content')
    <div class="row">
        <div class="col-sm-12">
            <div class="page-header-title">
                <h4 class="pull-left page-title">Edit Instructor</h4>
                <ol class="breadcrumb pull-right">
                    <li><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                    <li><a href="{{route('admin.instructors.index')}}">All Instructors</a></li>
                    <li class="active">Edit Instructor</li>
                </ol>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">Edit Instructor</h3>
                </div>

                <div class="panel-body">
                    <div class="row">
                        <div class="col-xs-12">
                            <form role="form" action="{{route('admin.instructors.update', $user->id)}}" method="post">
                                @csrf
                                @method('put')
                                <div class="form-group">
                                    <label for="name">Instructor Name</label>
                                    <input type="text" name="name" value="{{$user->name ? $user->name : old('name') }}" class="form-control @error('name') is-invalid @enderror" id="ex1" placeholder="Enter Category Name">
                                </div>
                                @error('name')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror

                                <div class="form-group">
                                    <label for="email">Instructor Email</label>
                                    <input type="text" name="email" value="{{ old('email') ? old('email'):$user->email }}" class="form-control @error('email') is-invalid @enderror" id="ex1" placeholder="Enter Instructor Email">
                                </div>
                                @error('email')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror

                                <div class="form-group">
                                    <label for="password">Instructor Password</label>
                                    <input type="password" name="password" value="{{ old('password') }}" class="form-control @error('password') is-invalid @enderror" id="ex1" placeholder="Enter Instructor password">
                                </div>
                                @error('email')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror


                                <div class="form-group">
                                    <label for="status">Instructor Status</label>
                                    <br>
                                    @php
                                        if(old('status')){
                                            $status = old('status');
                                        }else{
                                            $status = $user->status;
                                        }
                                    @endphp

                                    <div class="radio radio-info radio-inline">
                                        <input type="radio" id="inlineRadio1" value="1" name="status" @if($status==1) {{'checked'}}@endif>
                                        <label for="inlineRadio1">Active</label>
                                    </div>
                                    <div class="radio radio-info radio-inline">
                                        <input type="radio" id="inlineRadio1" value="0" name="status" @if($status==0) {{'checked'}}@endif>
                                        <label for="inlineRadio1">Inactive</label>
                                    </div>
                                </div>
                                @error('status')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror

                                <button type="submit" class="btn btn-success waves-effect waves-light">Update</button>
                                <a href="{{route('admin.instructors.index')}}" class="btn btn-info waves-effect waves-light">Back</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
