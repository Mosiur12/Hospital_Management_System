@extends('instructor.master')

@section('title', 'Profile Edit')

@section('main-content')
    <div class="row">
        <div class="col-sm-12">
            <div class="page-header-title">
                <h4 class="pull-left page-title">Profile Edit</h4>
                <ol class="breadcrumb pull-right">
                    <li><a href="{{route('instructor.dashboard')}}">Dashboard</a></li>
                    <li class="active">Profile Edit</li>
                </ol>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">Edit Profile</h3>
                </div>

                <div class="panel-body">
                    <div class="row">
                        <div class="col-xs-12">
                            <form role="form" action="{{route('instructor.profileUpdate', $info->id)}}" method="post" enctype="multipart/form-data">
                                @csrf
                                @method('put')

                                <div class="form-group">
                                    <label class="control-label" for="name">Name</label>
                                    <div>
                                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{$info->name ? $info->name : old('name')}}" placeholder="Eneter your name">
                                    </div>
                                </div>
                                @error('title')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror

                                <div class="form-group">
                                    <label class="control-label" for="example-email">Email</label>
                                    <div>
                                        <input type="email" id="example-email"  class="form-control" value="{{$info->email}}" readonly>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label" for="address">Address</label>
                                    <div>
                                        <input type="text" id="example-email" name="address" class="form-control @error('address') is-invalid @enderror" value="{{$info->address ? $info->address : old('address')}}" placeholder="Enter your address">
                                    </div>
                                </div>
                                @error('address')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror


                                <div class="form-group">
                                    <label class="control-label" for="phone">Phone</label>
                                    <div>
                                        <input type="text" id="example-email" name="phone" class="form-control @error('address') is-invalid @enderror" value="{{$info->phone ? $info->phone : old('phone')}}" placeholder="Enter your phone no.">
                                    </div>
                                </div>
                                @error('phone')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror


                                <div class="form-group">
                                    <label for="image">Profile Image</label>
                                    <img src="{{asset($info->image)}}" alt="Profile Image" class="img-responsive w-lg" style="height: 200px;">
                                </div>

                                <div class="form-group">
                                    <input type="file" name="image" value="{{$info->image ? $info->image : old('image') }}" class="form-control @error('image') is-invalid @enderror">
                                </div>
                                @error('image')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror


                                <div class="form-group">
                                    <label for="facebook">Facebook Url</label>
                                    <input type="url" name="facebook" value="{{$contact->facebook ? $contact->facebook : old('facebook')}}" class="form-control @error('facebook') is-invalid @enderror" id="ex1" placeholder="Enter Facebook URL">
                                </div>
                                @error('facebook')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror

                                <div class="form-group">
                                    <label for="youtube">Youtube Url</label>
                                    <input type="url" name="youtube" value="{{$contact->youtube ? $contact->youtube : old('youtube')}}" class="form-control @error('youtube') is-invalid @enderror" id="ex1" placeholder="Enter Youtube URL">
                                </div>
                                @error('youtube')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror

                                <div class="form-group">
                                    <label for="twitter">Twitter Url</label>
                                    <input type="url" name="twitter" value="{{$contact->twitter ? $contact->twitter : old('twitter')}}" class="form-control @error('twitter') is-invalid @enderror" id="ex1" placeholder="Enter Twitter URL">
                                </div>
                                @error('twitter')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror

                                <div class="form-group">
                                    <label for="instagram">Instragram</label>
                                    <input type="url" name="instagram" value="{{$contact->instagram ? $contact->instagram : old('instagram')}}" class="form-control @error('instagram') is-invalid @enderror" id="ex1" placeholder="Enter Instaragram URL">
                                </div>
                                @error('instagram')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror

                                <div class="form-group">
                                    <label for="whatsapp">WhatsApp NO.</label>
                                    <input type="text" name="whatsapp" value="{{$contact->whatsapp ? $contact->whatsapp : old('whatsapp')}}" class="form-control @error('whatsapp') is-invalid @enderror" id="ex1" placeholder="Enter WhatsApp NO.">
                                </div>
                                @error('whatsapp')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror


                                <div class="form-group">
                                    <label for="about_me">About Me</label>
                                    <input type="text" name="about_me" value="{{$contact->about_me ? $contact->about_me : old('about_me') }}" class="form-control @error('about_me') is-invalid @enderror" id="ex1" placeholder="Enter About Me">
                                </div>
                                @error('about_me')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror

                                <div class="form-group">
                                    <label for="designation">Designation</label>
                                    <input type="text" name="designation" value="{{$contact->designation ? $contact->designation : old('designation') }}" class="form-control @error('designation') is-invalid @enderror" id="ex1" placeholder="Enter Your designation">
                                </div>
                                @error('designation')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror


                                <button type="submit" class="btn btn-success waves-effect waves-light">Submit</button>
                                <a href="{{route('instructor.dashboard')}}" class="btn btn-info waves-effect waves-light">Home</a>
                                <a href="{{route('instructor.profile')}}" class="btn btn-success waves-effect waves-light">Back</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

