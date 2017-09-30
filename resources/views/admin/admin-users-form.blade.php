@extends('layouts.adminlayout')

@section('content-header')
    <h1>
        {{$title}}
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="{{ route('admin.users') }}"><i class="ion ion-ios-list"></i> Users</a></li>
        <li><i class="fa fa-sticky-note-o"></i> {{$title}}</li>
    </ol>
@endsection


@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-success">
                <form role="form" action="" method="post">
                    <div class="box-body">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter name" value="{{ isset($user) ? $user->name : ''  }}">
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" class="form-control" id="email" name="email" placeholder="Enter email" value="{{ isset($user) ? $user->email : ''  }}">
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="text" class="form-control" id="password" name="password" placeholder="Enter password" >
                        </div>
                        <div class="form-group">
                            <label for="confirm-password">Confirm Password</label>
                            <input type="text" class="form-control" id="confirm-password" name="confirm-password" placeholder="Confirm password" >
                        </div>
                        <div class="form-group">
                            <label for="user-role">User Role</label>
                            <input type="text" class="form-control" id="user-role" name="user-role" placeholder="Enter user role" value="{{ isset($user) ? $user->role : ''  }}">
                        </div>

                    </div>
                    <!-- /.box-body -->

                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <input class="btn btn-default" type="reset">
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
