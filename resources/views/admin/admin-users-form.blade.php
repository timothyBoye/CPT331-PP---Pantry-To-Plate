@extends('layouts.adminlayout')

@section('head')
    <script>
        $().ready(function() {
            $("#form").validate({
                rules: {
                    name: {
                        required: true,
                        alpha_international: true
                    },
                    email: {
                        required: true,
                        minlength: 6,
                        email: true
                    },
                    password: {
                        minlength: 8
                    },
                    password_confirmation: {
                        minlength: 8,
                        equalTo: "#password"
                    },
                    user_role_id: {
                        required: true,
                        digits: true
                    }
                },
                messages: {
                    name: {
                        required: "Please enter the user's name",
                        alpha_international: "Please use only a-z and accented characters"
                    },
                    email: {
                        required: "Please enter user's email address",
                        minlength: "An email address must be at least 6 characters",
                        email: "Please enter a valid email address i.e. hello@example.org"
                    },
                    password: {
                        minlength: "A password must be at least 8 characters long"
                    },
                    password_confirmation: {
                        minlength: "A password must be at least 8 characters long",
                        equalTo: "The passwords must match"
                    },
                    user_role_id: {
                        required: "Please select the user's role type",
                        digits: "Doesn't appear to be a valid user role id"
                    }
                }
            });
        });
    </script>
@endsection

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
                <form role="form" action="{{ isset($user) ? route('admin.user.put', ['id' => $user->id]) : route('admin.user.post') }}" id="form" method="post">
                    {{ csrf_field() }}
                    @if(isset($user))
                        {{ method_field('PUT') }}
                        <input type="text" id="id" name="id" value="{{ $user->id }}" hidden disabled>
                    @endif
                    <div class="box-body">
                        <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter name" value="{{ isset($user) ? $user->name : old('name')  }}">
                            @if ($errors->has('name'))
                                <span class="help-block"><strong>{{ $errors->first('name') }}</strong></span>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                            <label for="email">Email</label>
                            <input type="text" class="form-control" id="email" name="email" placeholder="Enter email" value="{{ isset($user) ? $user->email : old('email')  }}">
                            @if ($errors->has('email'))
                                <span class="help-block"><strong>{{ $errors->first('email') }}</strong></span>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Enter password" >
                            @if ($errors->has('password'))
                                <span class="help-block"><strong>{{ $errors->first('password') }}</strong></span>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('password_confirmation') ? 'has-error' : '' }}">
                            <label for="password_confirmation">Confirm Password</label>
                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Confirm password" >
                            @if ($errors->has('password_confirmation'))
                                <span class="help-block"><strong>{{ $errors->first('password_confirmation') }}</strong></span>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('user_role_id') ? 'has-error' : '' }}">
                            <label for="user_role_id">User Role</label>
                            <select id="user_role_id" name="user_role_id" class="form-control">
                                @foreach ($userRoles as $userRole)
                                <option {{ ((isset($user) && $userRole->id == $user->user_role_id) || (old('user_role_id') == $userRole->id)) ? 'selected' : '' }} value="{{$userRole->id}}">{{$userRole->user_role_name}}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('user_role_id'))
                                <span class="help-block"><strong>{{ $errors->first('user_role_id') }}</strong></span>
                            @endif
                        </div>
                        <div id="seed_file_string">

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
