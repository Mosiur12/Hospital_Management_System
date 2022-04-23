@extends('admin.master')

@section('title', 'Edit Category')

@section('main-content')
    <div class="row">
        <div class="col-sm-12">
            <div class="page-header-title">
                <h4 class="pull-left page-title">Edit Category</h4>
                <ol class="breadcrumb pull-right">
                    <li><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                    <li><a href="{{route('admin.roles.index')}}">All Category</a></li>
                    <li class="active">Edit Category</li>
                </ol>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">Edit Category</h3>
                </div>

                <div class="panel-body">
                    <div class="row">
                        <div class="col-xs-12">
                            <form role="form" action="{{route('admin.categories.update', $category->id)}}" method="post" enctype="multipart/form-data">
                                @csrf
                                @method('put')
                                <div class="form-group">
                                    <label for="name">Category Name</label>
                                    <input type="text" name="name" value="{{$category->name ? $category->name : old('name') }}" class="form-control @error('name') is-invalid @enderror" id="ex1" placeholder="Enter Category Name">
                                </div>
                                @error('name')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror

                                <div class="form-group">
                                    <label for="image">Category Icon</label>
                                    <span class="btn btn-success"><i class="{{$category->icon}}"></i></span>
                                </div>

                                <div class="form-group">
                                    <label for="name">Category Icon</label>
                                    <input type="text" name="icon" value="{{$category->icon ? $category->icon : old('icon') }}" class="form-control @error('icon') is-invalid @enderror" id="ex1" placeholder="Ex. fa fax">
                                </div>
                                @error('icon')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror

                                <div class="form-group">
                                    <label for="image">Category Image</label>
                                    <img src="{{asset($category->image)}}" alt="course thumbnail" class="img-responsive w-lg" style="height: 200px;">
                                </div>

                                <div class="form-group">
                                    <input type="file" name="image" value="{{$category->image ? $category->image : old('image') }}" class="form-control @error('image') is-invalid @enderror">
                                </div>
                                @error('image')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror


                                <div class="form-group">
                                    <label for="status">Category Status</label>
                                    <br>
                                    @php
                                        if(old('status')){
                                            $status = old('status');
                                        }else{
                                            $status = $category->status;
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
                                <a href="{{route('admin.categories.index')}}" class="btn btn-info waves-effect waves-light">Back</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
