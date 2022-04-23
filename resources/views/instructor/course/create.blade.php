@extends('instructor.master')

@section('title', 'Course Crete')

@section('main-content')
    <div class="row">
        <div class="col-sm-12">
            <div class="page-header-title">
                <h4 class="pull-left page-title">Course Create</h4>
                <ol class="breadcrumb pull-right">
                    <li><a href="{{route('instructor.dashboard')}}">Dashboard</a></li>
                    <li><a href="{{route('instructor.courses.index')}}">All Course</a></li>
                    <li class="active">New Course Create</li>
                </ol>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">Create New Course</h3>
                </div>

                <div class="panel-body">
                    <div class="row">
                        <div class="col-xs-12">
                            <form role="form" action="{{route('instructor.courses.store')}}" method="post" enctype="multipart/form-data">
                                @csrf

                                <div class="form-group">
                                    <label for="title">Course Title</label>
                                    <input type="text" name="title" value="{{old('title')}}" class="form-control @error('title') is-invalid @enderror" id="ex1" placeholder="Enter course title">
                                </div>
                                @error('title')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror

                                <div class="form-group">
                                    <label for="short_desc">Short Description</label>
                                    <input type="text" name="short_desc" value="{{old('short_desc')}}" class="form-control @error('short_desc') is-invalid @enderror" id="ex1" placeholder="Enter course short description">
                                </div>
                                @error('short_desc')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror


                                <div class="form-group">
                                    <label for="course_details">Course Outline</label>
                                    <textarea id="tinymce" name="course_details">
                                        {{old('course_details')}}
                                   </textarea>
                                </div>
                                @error('course_details')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror



                                <div class="form-group" style="margin-left: -10px;">
                                    <label class="col-sm-12 control-label">Category</label>
                                    <div class="col-sm-12">
                                        <select name="category_id" class="form-control m-b-10 @error('category_id') is-invalid @enderror">
                                            @php
                                                if (old('category_id')){
                                                    $c = old('category_id');
                                                }else {
                                                        $c = '';
                                                }
                                            @endphp
                                            <option>Select Category</option>
                                            @foreach($categories as $category)
                                                <option value="{{$category->id}}" {{$c==$category->id ? 'selected':''}}>{{$category->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                @error('category_id')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror


                                <div class="form-group">
                                    <label for="price">Course Fee</label>
                                    <input type="number" min="0" name="course_fee" value="{{old('course_fee')}}" class="form-control @error('course_fee') is-invalid @enderror" id="ex1" placeholder="Enter Course Fee">
                                </div>
                                @error('course_fee')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror

                                <div class="form-group">
                                    <label for="offer_price">Offer Fee</label>
                                    <input type="number" min="0" name="offer_price" value="{{old('offer_price')}}" class="form-control @error('offer_price') is-invalid @enderror" id="ex1" placeholder="Enter Course Offer Fee">
                                </div>
                                @error('offer_price')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror

                                <div class="form-group">
                                    <label for="image">Course Thumbnail</label>
                                    <input type="file" name="image" value="{{ old('image') }}" class="form-control @error('image') is-invalid @enderror">
                                </div>
                                @error('image')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror

                                <div class="form-group">
                                    <label for="status">Status</label>
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
                                <a href="{{route('instructor.courses.index')}}" class="btn btn-info waves-effect waves-light">Back</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js_last')
    <script src="{{asset('/')}}assets/tinymce/tinymce.js"></script>
    <script>
        $(function () {
            tinymce.init({
                selector: "textarea#tinymce",
                theme: "modern",
                height: 300,
                plugins: [
                    'advlist autolink lists link image charmap print preview hr anchor pagebreak',
                    'searchreplace wordcount visualblocks visualchars code fullscreen',
                    'insertdatetime media nonbreaking save table contextmenu directionality',
                    'emoticons template paste textcolor colorpicker textpattern imagetools'
                ],
                toolbar1: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
                toolbar2: 'print preview media | forecolor backcolor emoticons',
                image_advtab: true
            });
            tinymce.suffix = ".min";
            tinyMCE.baseURL = '{{asset('/')}}assets/tinymce';
        });
    </script>
@endpush
