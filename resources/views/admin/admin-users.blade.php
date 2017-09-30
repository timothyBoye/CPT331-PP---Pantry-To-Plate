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
            <div class="box box-success">
                <div class="box-header with-border">
                    <a href="#" class="btn btn-success">Add User</a>
                </div>
                <div class="box-body"><table class="table">
                        <tr>
                            <th>Name</th>
                            <th width="280px"></th>
                        </tr>
                        @foreach ($users as $user)
                            <tr>
                                <td>{{ $user->name}}</td>
                                <td>
                                    <a class="btn" href="#">View User</a>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
                <div class="box-footer">
                    {!! $users->appends(Input::except('page'))->render() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
