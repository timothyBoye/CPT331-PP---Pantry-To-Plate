@extends('layouts.adminlayout')

@section('content-header')
    <h1>
        {{$title}}
        <small>List of ingredients</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><i class="ion ion-ios-nutrition"></i> {{$title}}</li>
    </ol>
@endsection


@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-success">
                <div class="box-header with-border">
                    <a href="#" class="btn btn-success">Add Ingredient</a>
                </div>
                <div class="box-body">
                    <table class="table">
                        <tr>
                            <th>Name</th>
                            <th width="280px"></th>
                        </tr>
                        @foreach ($ingredients as $ingredient)
                            <tr>
                                <td>{{ $ingredient->name}}</td>
                                <td>
                                    <a class="btn" href="#">View Ingredient</a>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
                <div class="box-footer">
                    {!! $ingredients->appends(Input::except('page'))->render() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
