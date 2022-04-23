@extends('admin.master')

@section('title', 'Student Details')

@section('main-content')
    <div class="row">
        <div class="col-sm-12">
            <div class="page-header-title">
                <h4 class="pull-left page-title">Student Details</h4>
                <ol class="breadcrumb pull-right">
                    <li><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                    <li><a href="{{route('admin.students.index')}}">All Student</a></li>
                    <li class="active">Details Instructor</li>
                </ol>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">{{$user->name}}</h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        @php
                        $img = '';
                        if (isset($user->image)){
                            $img = $user->image;
                        }else{
                            $img = 'assets/images/img/default.jpg';
                        }
                        @endphp
                        <div class="col-md-4"><img src="{{asset($img)}}" class="img-responsive" alt=""></div>
                        <div class="col-md-8">
                            <div class="panel panel-primary">
                                <div class="panel-heading"><h3 class="panel-title">Information</h3></div>

                                <div class="panel-body">
                                    <form class="form-horizontal" role="form">
                                        <div class="form-group">
                                            <label class="col-md-2 control-label">Student Name</label>
                                            <div class="col-md-10">
                                                <input type="text" class="form-control" value="{{$user->name}}" readonly>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-2 control-label" for="example-email">Student Email</label>
                                            <div class="col-md-10">
                                                <input type="email" id="example-email" name="example-email" class="form-control" value="{{$user->email}}" readonly>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-2 control-label" for="example-email">Student Address</label>
                                            <div class="col-md-10">
                                                <input type="email" id="example-email" name="example-email" class="form-control" value="{{$user->address}}" readonly>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-2 control-label" for="example-email">Student Phone</label>
                                            <div class="col-md-10">
                                                <input type="email" id="example-email" name="example-email" class="form-control" value="{{$user->phone}}" readonly>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-2 control-label" for="example-email">Total course</label>
                                            <div class="col-md-10">
                                                <input type="email" id="example-email" name="example-email" class="form-control" value="{{$user->total_course}}" readonly>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-2 control-label" for="example-email">Student Status</label>
                                            <div class="col-md-10">
                                                <input type="email" id="example-email" name="example-email" class="form-control" value="{{$user->status ? 'Active':'Inactive'}}" readonly>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-2 control-label" for="example-email">Role</label>
                                            <div class="col-md-10">
                                                <input type="email" id="example-email" name="example-email" class="form-control text-capitalize" value="{{$user->user_type}}" readonly>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-2 control-label" for="example-email">Facebook Url</label>
                                            <div class="col-md-10">
                                                <input type="url" id="example-email" name="example-email" class="form-control" value="{{$contact->facebook ? $contact->facebook : ''}}" readonly>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-2 control-label" for="example-email">Youtube Url</label>
                                            <div class="col-md-10">
                                                <input type="url" id="example-email" name="example-email" class="form-control" value="{{$contact->youtube ? $contact->youtube : ''}}" readonly>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-2 control-label" for="example-email">Twitter Url</label>
                                            <div class="col-md-10">
                                                <input type="url" id="example-email" name="example-email" class="form-control" value="{{$contact->twitter ? $contact->twitter : ''}}" readonly>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-2 control-label" for="example-email">Instagram Url</label>
                                            <div class="col-md-10">
                                                <input type="url" id="example-email" name="example-email" class="form-control" value="{{$contact->instagram ? $contact->instagram : ''}}" readonly>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-2 control-label" for="example-email">WhatsApp N0.</label>
                                            <div class="col-md-10">
                                                <input type="text" id="example-email" name="example-email" class="form-control" value="{{$contact->whatsapp ? $contact->whatsapp : ''}}" readonly>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-2 control-label" for="example-email"></label>
                                            <div class="col-md-10">
                                                <a href="{{route('admin.students.index')}}" class="btn btn-info waves-effect waves-light">Back</a>
                                                <a href="{{route('admin.students.edit', $user->id)}}" class="btn btn-success waves-effect waves-light">Edit</a>
                                            </div>
                                        </div>
                                    </form>
                                </div> <!-- panel-body -->
                            </div> <!-- panel -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">Enrolled Course</h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-3">
                            <img src="img/img-1.png" class="img-responsive" alt="">
                        </div>
                        <div class="col-md-9" style="display: inline">
                            <h3>Web Development</h3>
                            <span><b>Instructor</b> <a href="#" class="label label-primary">Jahid Hassan</a></span>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab animi ducimus et quas voluptatibus. Aperiam dolorum facilis ipsam saepe totam.</p>
                            <span>Course Fee: </span> <b class="label label-success">Free</b>
                        </div>
                    </div>

                    <hr>

                    <div class="row">
                        <div class="col-md-3">
                            <img src="img/img-2.jpg" class="img-responsive" alt="">
                        </div>
                        <div class="col-md-9" style="display: inline">
                            <h3>Web Development</h3>
                            <span><b>Instructor</b> <a href="#" class="label label-primary">Jahid Hassan</a></span>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab animi ducimus et quas voluptatibus. Aperiam dolorum facilis ipsam saepe totam.</p>
                            <span>Course Fee: </span> <b class="label label-success">Free</b>
                        </div>
                    </div>

                    <hr>

                    <div class="row">
                        <div class="col-md-3">
                            <img src="img/img-1.png" class="img-responsive" alt="">
                        </div>
                        <div class="col-md-9" style="display: inline">
                            <h3>Web Development</h3>
                            <span><b>Instructor</b> <a href="#" class="label label-primary">Jahid Hassan</a></span>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab animi ducimus et quas voluptatibus. Aperiam dolorum facilis ipsam saepe totam.</p>
                            <span>Course Fee: </span> <b class="label label-success">Free</b>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection
