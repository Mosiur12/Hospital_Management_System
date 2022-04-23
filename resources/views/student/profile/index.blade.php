@extends('student.master')

@section('title', 'Profile')

@section('main-content')
    <div class="row">
        <div class="col-sm-12">
            <div class="page-header-title">
                <h4 class="pull-left page-title">Profile</h4>
                <ol class="breadcrumb pull-right">
                    <li><a href="{{route('student.dashboard')}}">Dashboard</a></li>
                    <li class="active">Profile</li>
                </ol>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">{{$info->name}}</h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-4"><img src="{{asset($info->image)}}" class="img-responsive" alt=""></div>
                        <div class="col-md-8">
                            <div class="panel panel-primary">
                                <div class="panel-heading"><h3 class="panel-title">User Information</h3></div>

                                <div class="panel-body">
                                    <form class="form-horizontal" role="form">
                                        <div class="form-group">
                                            <label class="col-md-2 control-label">Name</label>
                                            <div class="col-md-10">
                                                <input type="text" class="form-control" value="{{$info->name}}" readonly>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-2 control-label" for="example-email">Email</label>
                                            <div class="col-md-10">
                                                <input type="email" id="example-email" name="example-email" class="form-control" value="{{$info->email}}" readonly>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-2 control-label" for="example-email">Address</label>
                                            <div class="col-md-10">
                                                <input type="email" id="example-email" name="example-email" class="form-control" value="{{$info->address}}" readonly>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-2 control-label" for="example-email">Phone</label>
                                            <div class="col-md-10">
                                                <input type="email" id="example-email" name="example-email" class="form-control" value="{{$info->phone}}" readonly>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-2 control-label" for="example-email">About Me</label>
                                            <div class="col-md-10">
                                                <input type="text" id="example-email" name="example-email" class="form-control" value="{{$contact->about_me ? $contact->about_me : ''}}" readonly>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-2 control-label" for="example-email">Total course</label>
                                            <div class="col-md-10">
                                                <input type="email" id="example-email" name="example-email" class="form-control" value="{{$info->total_course}}" readonly>
                                            </div>
                                        </div>
                                       {{-- <div class="form-group">
                                            <label class="col-md-2 control-label" for="example-email">Total Student</label>
                                            <div class="col-md-10">
                                                <input type="email" id="example-email" name="example-email" class="form-control" value="100" readonly>
                                            </div>
                                        </div>--}}

                                        {{--<div class="form-group">
                                            <label class="col-md-2 control-label" for="example-email">Status</label>
                                            <div class="col-md-10">
                                                <input type="email" id="example-email" name="example-email" class="form-control" value="Active" readonly>
                                            </div>
                                        </div>--}}

                                        <div class="form-group">
                                            <label class="col-md-2 control-label" for="example-email">Role</label>
                                            <div class="col-md-10">
                                                <input type="email" id="example-email" name="example-email" class="form-control text-capitalize" value="{{$info->user_type}}" readonly>
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
                                                <a href="{{route('student.dashboard')}}" class="btn btn-info waves-effect waves-light">Home</a>
                                                <a href="{{route('student.profileEdit')}}" class="btn btn-success waves-effect waves-light">Update Profile</a>
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

   {{-- <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">All Roles Table</h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-xs-12">
                            <table class="table table-striped table-bordered">
                                <thead>
                                <tr>
                                    <th>#SL</th>
                                    <th>Name</th>
                                    <th>Slug</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tbody>
                                @foreach($roles as $key=>$role)
                                    <tr>
                                        <td>{{$key+1}}</td>
                                        <td>{{$role->name}}</td>
                                        <td>{{$role->slug}}</td>
                                        <td><span class="label {{$role->status ? 'label-success':'label-warning'}}">{{$role->status ? 'Active':'Inactive'}}</span></td>
                                        <td>
                                            <a href="{{route('admin.roles.edit', $role->id)}}" class="btn btn-success"><i class="fa fa-edit"></i></a>
                                            <button class="btn btn-danger" type="button" onclick="deleteRole({{$role->id}})">
                                                <i class="fa fa-trash-o"></i>
                                            </button>
                                            <form id="delete_from_{{$role->id}}" style="display: none" action="{{route('admin.roles.destroy', $role->id)}}" method="post">
                                                @csrf
                                                @method('delete')
                                            </form>

                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>--}}
@endsection

@push('js')
    <script type="text/javascript">
        function deleteRole(id)
        {
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false
            })

            swalWithBootstrapButtons.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!',
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    event.preventDefault();
                    document.getElementById('delete_from_'+id).submit();
                    swalWithBootstrapButtons.fire(
                        'Deleted!',
                        'Your data has been deleted',
                        'success'
                    )
                } else if (
                    /* Read more about handling dismissals below */
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    swalWithBootstrapButtons.fire(
                        'Cancelled',
                        'Your imaginary data is safe :)',
                        'error'
                    )
                }
            })
        }
    </script>
@endpush
