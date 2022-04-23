@extends('admin.master')

@section('title', 'Role')

@section('main-content')
    <div class="row">
        <div class="col-sm-12">
            <div class="page-header-title">
                <h4 class="pull-left page-title">All Roles</h4>
                <ol class="breadcrumb pull-right">
                    <li><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                    <li class="active">All Roles</li>
                </ol>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>

    <div class="row m-b-15">
        <div class="col-sm-12">
            <a class="btn btn-primary" href="{{route('admin.roles.create')}}"><i class="fa fa-plus"></i> Create New Role</a>
        </div>
    </div>


    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">All Roles Table</h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-xs-12">
                            <table id="datatable-buttons" class="table table-striped table-bordered">
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
    </div>
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
