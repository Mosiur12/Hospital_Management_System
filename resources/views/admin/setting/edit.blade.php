@extends('admin.master')

@section('title', 'Edit Setting')

@section('main-content')
    <div class="row">
        <div class="col-sm-12">
            <div class="page-header-title">
                <h4 class="pull-left page-title">Edit Setting</h4>
                <ol class="breadcrumb pull-right">
                    <li><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                    <li class="active">Edit Setting</li>
                </ol>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">Edit Setting</h3>
                </div>

                <div class="panel-body">
                    <div class="row">
                        <div class="col-xs-12">
                            <form role="form" action="{{route('admin.settings.update', $setting->id)}}" method="post" enctype="multipart/form-data">
                                @csrf
                                @method('put')
                                <div class="form-group">
                                    <label>Facebook Link</label>
                                    <input type="url" name="facebook_url" value="{{$setting->facebook_url ? $setting->facebook_url : old('facebook_url') }}" class="form-control " id="ex1" placeholder="Enter facebook link">
                                </div>
                                @error('facebook_url')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror

                                <div class="form-group">
                                    <label>Youtube Link</label>
                                    <input type="url" name="youtube_url" value="{{$setting->youtube_url ? $setting->youtube_url : old('youtube_url') }}" class="form-control " id="ex1" placeholder="Enter Youtube link">
                                </div>
                                @error('youtube_url')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror

                                <div class="form-group">
                                    <label>Twitter Link</label>
                                    <input type="url" name="twitter_url" value="{{$setting->twitter_url ? $setting->twitter_url : old('twitter_url') }}" class="form-control " id="ex1" placeholder="Enter Twitter link">
                                </div>
                                @error('twitter_url')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror

                                <div class="form-group">
                                    <label>Google+ Link</label>
                                    <input type="url" name="google_plus_url" value="{{$setting->google_plus_url ? $setting->google_plus_url : old('google_plus_url') }}" class="form-control " id="ex1" placeholder="Enter Google+ link">
                                </div>
                                @error('google_plus_url')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror

                                <div class="form-group">
                                    <label>Address</label>
                                    <input type="text" name="address" value="{{$setting->address ? $setting->address : old('address') }}" class="form-control " id="ex1" placeholder="Enter Address">
                                </div>
                                @error('address')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror

                                <div class="form-group">
                                    <label>Phone</label>
                                    <input type="text" name="phone" value="{{$setting->phone ? $setting->phone : old('phone') }}" class="form-control " id="ex1" placeholder="Enter Phone No.">
                                </div>
                                @error('phone')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror

                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" name="email" value="{{$setting->email ? $setting->email : old('our_history') }}" class="form-control " id="ex1" placeholder="Enter your Email address">
                                </div>
                                @error('email')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror

                                <div class="form-group">
                                    <label>Platform Name</label>
                                    <input type="text" name="platform_name" value="{{$setting->platform_name ? $setting->platform_name : old('platform_name') }}" class="form-control " id="ex1" placeholder="Enter Phone No.">
                                </div>
                                @error('platform_name')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror

                                <div class="form-group">
                                    <label>Developer Name</label>
                                    <input type="text" name="developer_name" value="{{$setting->developer_name ? $setting->developer_name : old('developer_name') }}" class="form-control " id="ex1" placeholder="Enter Phone No.">
                                </div>
                                @error('developer_name')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror

                                <div class="form-group">
                                    <label>Developer Link</label>
                                    <input type="url" name="developer_link" value="{{$setting->developer_link ? $setting->developer_link : old('developer_link') }}" class="form-control " id="ex1" placeholder="Enter Phone No.">
                                </div>
                                @error('developer_link')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror

                                <div class="form-group">
                                    <label>Google Map Link</label>
                                    <input type="url" name="google_map" value="{{$setting->google_map ? $setting->google_map : old('google_map') }}" class="form-control " id="ex1" placeholder="Enter Phone No.">
                                </div>
                                @error('google_map')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror

                                <div class="form-group">
                                    <label>Short Description</label>
                                    <input type="text" name="short_desc" value="{{$setting->short_desc ? $setting->short_desc : old('short_desc') }}" class="form-control " id="ex1" placeholder="Enter Phone No.">
                                </div>
                                @error('short_desc')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror

                                <div class="form-group">
                                    <label for="our_history">Our History</label>
                                    <textarea id="tinymce" name="our_history">
                                        {{$setting->our_history ? $setting->our_history : old('our_history') }}
                                   </textarea>
                                </div>
                                @error('our_history')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror

                                <div class="form-group">
                                    <label for="our_mission">Our Mission</label>
                                    <textarea id="tinymce" name="our_mission">
                                        {{$setting->our_mission ? $setting->our_mission : old('our_mission') }}
                                   </textarea>
                                </div>
                                @error('our_mission')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror

                                <div class="form-group">
                                    <label for="our_vision">Our Vision</label>
                                    <textarea id="tinymce" name="our_vision">
                                        {{$setting->our_vision ? $setting->our_vision : old('our_vision') }}
                                   </textarea>
                                </div>
                                @error('our_vision')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror

                                <div class="form-group">
                                    <label for="about_us">About Us</label>
                                    <textarea id="tinymce" name="about_us">
                                        {{$setting->about_us ? $setting->about_us : old('about_us') }}
                                   </textarea>
                                </div>
                                @error('our_history')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror

                                <div class="form-group">
                                    <label for="terms">Terms and Condition</label>
                                    <textarea id="tinymce" name="terms">
                                        {{$setting->terms ? $setting->terms : old('terms') }}
                                   </textarea>
                                </div>
                                @error('terms')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror

                                <div class="form-group">
                                    <label for="privacy">Privacy and Policy</label>
                                    <textarea id="tinymce" name="privacy">
                                        {{$setting->privacy ? $setting->privacy : old('privacy') }}
                                   </textarea>
                                </div>
                                @error('privacy')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror


                                <div class="form-group">
                                    <label class="control-label">Featured Image</label>
                                    <br>
                                    <img src="{{asset($setting->featured_image)}}" alt="Featured Image<" style="width: 400px; height: 300px;">
                                </div>
                                <div class="form-group">
                                    <input type="file" name="featured_image" class="form-control" id="ex1">
                                </div>
                                @error('featured_image')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror

                                <div class="form-group">
                                    <label class="control-label">Logo</label>
                                    <br>
                                    <img src="{{asset($setting->logo)}}" alt="Logo" style="width: 200px;">
                                </div>
                                <div class="form-group">
                                    <input type="file" name="logo" class="form-control" id="ex1">
                                </div>
                                @error('logo')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror

                                <div class="form-group">
                                    <label class="control-label">Favicon</label>
                                    <br>
                                    <img src="{{asset($setting->favicon)}}" alt="Favicon" style="width: 50px;">
                                </div>
                                <div class="form-group">
                                    <input type="file" name="favicon" class="form-control" id="ex1">
                                </div>
                                @error('favicon')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror

                                <button type="submit" class="btn btn-success waves-effect waves-light">Submit</button>
                                <a href="{{route('admin.settings.index')}}" class="btn btn-info waves-effect waves-light">Back</a>
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
