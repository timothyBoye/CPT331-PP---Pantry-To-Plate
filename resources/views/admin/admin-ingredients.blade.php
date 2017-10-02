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
                    {{--<a href="{{ route('admin.ingredient.new') }}" class="btn btn-success">New</a>--}}
                </div>
                <div class="box-body">
                    <table class="table">
                        <tr>
                            <th>Name</th>
                            <th></th>
                        </tr>
                        @foreach ($ingredients as $ingredient)
                            <tr>
                                <td>{{ $ingredient->name}}</td>
                                <td>
                                    {{--<form class="admin-table-buttons" action="{{ route('admin.ingredient.get', ['id' => $ingredient->id]) }}" method="GET">--}}
                                        {{--{{ csrf_field() }}--}}
                                        {{--<button class="btn btn-default btn-sm" type="submit">Edit</button>--}}
                                    {{--</form>--}}
                                    <form class="admin-table-buttons" action="{{ route('admin.ingredient.delete', ['id' => $ingredient->id]) }}" method="POST">
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
                    {!! $ingredients->appends(Input::except('page'))->render() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
