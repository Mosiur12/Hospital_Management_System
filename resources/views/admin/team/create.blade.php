@extends('admin.master')

@section('title', 'Team Member Crete')

@section('main-content')
    <div class="row">
        <div class="col-sm-12">
            <div class="page-header-title">
                <h4 class="pull-left page-title">Team Member Create</h4>
                <ol class="breadcrumb pull-right">
                    <li><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                    <li><a href="{{route('admin.teams.index')}}">All Team Member</a></li>
                    <li class="active">New Team Member Create</li>
                </ol>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">Create New Team Member</h3>
                </div>

                <div class="panel-body">
                    <div class="row">
                        <div class="col-xs-12">
                            <form role="form" action="{{route('admin.teams.store')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="name">Team Member Name</label>
                                    <input type="text" name="name" value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror" id="ex1" placeholder="Enter Category Name">
                                </div>
                                @error('name')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror

                                <div class="form-group">
                                    <label for="designation">Team Member Designation</label>
                                    <input type="text" name="designation" value="{{ old('designation') }}" class="form-control @error('designation') is-invalid @enderror" id="ex1" placeholder="Enter Member designation">
                                </div>
                                @error('designation')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror

                                <div class="form-group">
                                    <label for="image">Team Member Image</label>
                                    <input type="file" name="image" value="{{ old('image') }}" class="form-control @error('image') is-invalid @enderror">
                                </div>
                                @error('image')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror


                                <div class="form-group">
                                    <label for="status">Team Member Status</label>
                                    <br>
                                    @php
                                        if (old('status')){
                                            $status = old('status');
                                        }else {
                                                $status = 1;
                                        }
                                    @endphp
                                    <div class="radio radio-info radio-inline">
                                        <input type="radio" id="inlineRadio1" value="1" name="status" @if($status==1) {{'checked'}}@endif>
                                        <label for="inlineRadio1">Active</label>
                                    </div>
                                    <div class="radio radio-info radio-inline">
                                        <input type="radio" id="inlineRadio1" value="0" name="status"@if($status==0) {{'checked'}}@endif>
                                        <label for="inlineRadio1">Inactive</label>
                                    </div>
                                </div>
                                @error('status')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror

                                <button type="submit" class="btn btn-success waves-effect waves-light">Submit</button>
                                <a href="{{route('admin.teams.index')}}" class="btn btn-info waves-effect waves-light">Back</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
