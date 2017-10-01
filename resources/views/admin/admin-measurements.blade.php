@extends('layouts.adminlayout')

@section('content-header')
    <h1>
        {{$title}}
        <small>List of measurement types</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><i class="ion ion-spoon"></i> {{$title}}</li>
    </ol>
@endsection


@section('content')
    <div class="row">
        <div class="col-md-12">
            @if(isset($measurement))
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i> Success!</h4>
                Measurement type "{{ $measurement->name }}" stored in the database.
            </div>
            @endif
            <div class="box box-success">
                <div class="box-header with-border">
                    <a href="{{ route('admin.measurement.new') }}" class="btn btn-success">New</a>
                </div>
                <div class="box-body">
                    <table class="table">
                        <tr>
                            <th>Name</th>
                            <th>Comparable Size</th>
                            <th></th>
                        </tr>
                        @foreach ($measurements as $measurement)
                            <tr>
                                <td>{{ $measurement->name}}</td>
                                <td>{{ $measurement->comparable_size }}</td>
                                <td>
                                    <form class="admin-table-buttons" action="{{ route('admin.measurement.get', ['id' => $measurement->id]) }}" method="GET">
                                        {{ csrf_field() }}
                                        <button class="btn btn-default btn-sm" type="submit">Edit</button>
                                    </form>
                                    <form class="admin-table-buttons" action="{{ route('admin.measurement.delete', ['id' => $measurement->id]) }}" method="POST">
                                        {{ method_field('DELETE') }}
                                        {{ csrf_field() }}
                                        <button class="btn btn-danger btn-sm" type="submit">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
                <div class="box-footer">
                    {!! $measurements->appends(Input::except('page'))->render() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
