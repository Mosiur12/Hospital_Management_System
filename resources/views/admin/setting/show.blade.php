@extends('admin.master')

@section('title', 'Setting')

@section('main-content')
    <div class="row">
        <div class="col-sm-12">
            <div class="page-header-title">
                <h4 class="pull-left page-title">Setting</h4>
                <ol class="breadcrumb pull-right">
                    <li><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                    <li class="active">Setting</li>
                </ol>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">Setting</h3>
                </div>

                <div class="panel-body">
                    <div class="row">
                        <div class="col-xs-12">
                            <form role="form">

                                <div class="form-group">
                                    <label>Facebook Link</label>
                                    <input readonly type="text" name="" value="{{$setting->facebook_url}}" class="form-control " id="ex1">
                                </div>

                                <div class="form-group">
                                    <label>Youtube Link</label>
                                    <input readonly type="text" name="" value="{{$setting->youtube_url}}" class="form-control " id="ex1" placeholder="Enter Youtube link">
                                </div>

                                <div class="form-group">
                                    <label>Twitter Link</label>
                                    <input readonly type="text" name="" value="{{$setting->twitter_url}}" class="form-control " id="ex1" placeholder="Enter Youtube link">
                                </div>

                                <div class="form-group">
                                    <label>Google+ Link</label>
                                    <input readonly type="text" name="" value="{{$setting->google_plus_url}}" class="form-control " id="ex1" placeholder="Enter Youtube link">
                                </div>

                                <div class="form-group">
                                    <label>Address</label>
                                    <input readonly type="text" name="" value="{{$setting->address}}" class="form-control " id="ex1" placeholder="Enter Address">
                                </div>

                                <div class="form-group">
                                    <label>Phone</label>
                                    <input readonly type="text" name="" value="{{$setting->phone}}" class="form-control " id="ex1" placeholder="Enter Phone No.">
                                </div>

                                <div class="form-group">
                                    <label>Email</label>
                                    <input readonly type="email" name="" value="{{$setting->email}}" class="form-control " id="ex1" placeholder="Enter your Email address">
                                </div>

                                <div class="form-group">
                                    <label>Platform Name</label>
                                    <input readonly type="text" name="" value="{{$setting->platform_name}}" class="form-control " id="ex1" placeholder="Enter Phone No.">
                                </div>

                                <div class="form-group">
                                    <label>Developer Name</label>
                                    <input readonly type="text" name="" value="{{$setting->developer_name}}" class="form-control " id="ex1" placeholder="Enter Phone No.">
                                </div>

                                <div class="form-group">
                                    <label>Developer Link</label>
                                    <input readonly type="text" name="" value="{{$setting->developer_link}}" class="form-control " id="ex1" placeholder="Enter Phone No.">
                                </div>


                                <div class="form-group">
                                    <label>Short Description</label>
                                    <input readonly type="text" name="" value="{{$setting->short_desc}}" class="form-control " id="ex1" placeholder="Enter your Email address">
                                </div>

                                <div class="form-group">
                                    <label class="control-label">Our History</label>
                                    <div>
                                       <p>{!! $setting->our_history !!}</p>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label">Our Mission</label>
                                    <div>
                                        <p>{!! $setting->our_mission !!}</p>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label">Our Vision</label>
                                    <div>
                                        <p>{!! $setting->our_vision !!}</p>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label">About Us</label>
                                    <div>
                                        <p>{!! $setting->about_us !!}</p>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label">Terms</label>
                                    <div>
                                       <p>{!! $setting->terms !!}</p>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label">Privacy</label>
                                    <div>
                                        <p>{!! $setting->privacy !!}</p>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label">Google Map</label>
                                    <div>
                                        <p>{{$setting->google_map}}</p>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label">Featured Image</label>
                                    <br>
                                    <img src="{{asset($setting->featured_image)}}" alt="Featured Image" style="width: 400px; height: 300px;">
                                </div>

                                <div class="form-group">
                                    <label class="control-label">Logo</label>
                                    <br>
                                    <img src="{{asset($setting->logo)}}" alt="Logo" style="width: 200px;">
                                </div>

                                <div class="form-group">
                                    <label class="control-label">Favicon</label>
                                    <br>
                                    <img src="{{asset($setting->favicon)}}" alt="Favicon" style="width: 50px;">
                                </div>

                                <a href="{{route('admin.settings.edit', $setting->id)}}" class="btn btn-success waves-effect waves-light">Edit</a>
                                <a href="{{route('admin.settings.index')}}" class="btn btn-info waves-effect waves-light">Back</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

