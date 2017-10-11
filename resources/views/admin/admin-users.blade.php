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
                    <table id="datatable" class="table table-bordered table-striped table-hover">
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
                        @foreach ($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->name}}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->role->user_role_name }}</td>
                                <td>
                                    <form class="admin-table-buttons" action="{{ route('admin.user.get', ['id' => $user->id]) }}" method="GET">
                                        {{ csrf_field() }}
                                        <button class="btn btn-info btn-sm" type="submit">Edit</button>
                                    </form>
                                </td>
                                <th>
                                    <form id="seed_form_{{$user->id}}" class="admin-table-buttons" action="" method="POST">
                                        {{ csrf_field() }}
                                        <button id="seed_button_{{$user->id}}" data-api-controller-url="{{route('admin.user.seeder', ['id' => $user->id])}}" class="btn btn-default btn-sm" type="button">Seed String</button>
                                        <script>
                                            $('#seed_button_{{$user->id}}').click(function(){
                                                console.log('click');
                                                $.ajax({
                                                    url: $('#seed_button_{{$user->id}}').attr('data-api-controller-url'),
                                                    type: 'POST',
                                                    data: $('#seed_form_{{$user->id}}').serialize()
                                                }).done(function(response){
                                                    $('#seed_string').html('<pre>'+response+'</pre>');
                                                }).fail(function(response){
                                                    $('#seed_string').html(response.responseText);
                                                });
                                            });
                                        </script>
                                    </form>
                                </th>
                                <td>
                                    <form class="admin-table-buttons" action="{{ route('admin.user.delete', ['id' => $user->id]) }}" method="POST">
                                        {{ method_field('DELETE') }}
                                        {{ csrf_field() }}
                                        <button class="btn btn-danger btn-sm" type="submit">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
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
        $(function () {
            $('#datatable').DataTable({
                'paging'      : true,
                'lengthChange': true,
                'searching'   : true,
                'ordering'    : true,
                'info'        : true,
                'autoWidth'   : true,
                'stateSave'   : true
            })
        })
    </script>
@endsection