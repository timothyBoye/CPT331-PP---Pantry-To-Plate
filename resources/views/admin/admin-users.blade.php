@extends('layouts.adminlayout')

@section('content-header')
    <h1>
        {{$title}}
        <small>List of users</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><i class="ion ion-person"></i> {{$title}}</li>
    </ol>
@endsection


@section('content')
    <div class="row">
        <div class="col-md-12">
            @if(isset($user))
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4><i class="icon fa fa-check"></i> Success!</h4>
                    User "{{ $user->name }}" stored in the database.
                </div>
            @endif
                <div id="seed_string"></div>
                <div class="box box-success">
                <div class="box-header with-border">
                    <a href="{{ route('admin.user.new') }}" class="btn btn-success">New</a>
                </div>
                <div class="box-body">
                    <table id="users-datatable" class="table table-bordered table-striped table-hover">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>User Role</th>
                            <th>Edit</th>
                            <th>Seed</th>
                            <th>Delete</th>
                        </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
                <div class="box-footer">
                </div>
            </div>
        </div>
    </div>
@endsection

@section('foot')
    <script>
        $(document).ready(function () {
            $('#users-datatable').DataTable({
                'paging'      : true,
                'lengthChange': true,
                'searching'   : true,
                'ordering'    : true,
                'info'        : true,
                'autoWidth'   : true,
                'stateSave'   : true,
                "processing"  : true,
                "serverSide"  : true,
                "ajax":{
                    "url"     : "{{ route('admin.users.post') }}",
                    "dataType": "json",
                    "type"    : "POST",
                    "data"    :{ _token: "{{csrf_token()}}"}
                },
                "columns": [
                    { "data"  : "id" },
                    { "data"  : "name" },
                    { "data"  : "email" },
                    { "data"  : "user_role" },
                    { "data"  : "edit" },
                    { "data"  : "seed" },
                    { "data"  : "delete" }
                ]
            });
        });
    </script>
@endsection