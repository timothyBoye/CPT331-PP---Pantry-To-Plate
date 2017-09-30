@extends('layouts.adminlayout')

@section('content-header')
<h1>
    {{$title}}
    <small>List of cuisines</small>
</h1>
<ol class="breadcrumb">
    <li><a href="{{ route('admin') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li><i class="ion ion-pizza"></i> {{$title}}</li>
</ol>
@endsection


@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-success">
                <div class="box-header with-border">
                    <a href="#" class="btn btn-success">Add Cuisine</a>
                </div>
                <div class="box-body">
                    <table class="table">
                        <tr>
                            <th>Name</th>
                            <th width="280px"></th>
                        </tr>
                        @foreach ($cuisines as $cuisine)
                            <tr>
                                <td>{{ $cuisine->name}}</td>
                                <td>
                                    <a class="btn" href="#">View Cuisine</a>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
                <div class="box-footer">
                    {!! $cuisines->appends(Input::except('page'))->render() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
