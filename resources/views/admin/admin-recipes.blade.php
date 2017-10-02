@extends('layouts.adminlayout')

@section('content-header')
    <h1>
        {{$title}}
        <small>List of recipes</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><i class="ion ion-ios-list"></i> {{$title}}</li>
    </ol>
@endsection


@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-success">
                <div class="box-header with-border">
                    {{--<a href="{{ route('admin.recipe.new') }}" class="btn btn-success">New</a>--}}
                </div>
                <div class="box-body">
                    <table class="table">
                        <tr>
                            <th>Name</th>
                            <th>Description</th>
                            <th></th>
                        </tr>
                        @foreach ($recipes as $recipe)
                            <tr>
                                <td>{{ $recipe->name}}</td>
                                <td>{{ $recipe->short_description }}</td>
                                <td>
                                    {{--<form class="admin-table-buttons" action="{{ route('admin.recipe.get', ['id' => $recipe->id]) }}" method="GET">--}}
                                        {{--{{ csrf_field() }}--}}
                                        {{--<button class="btn btn-default btn-sm" type="submit">Edit</button>--}}
                                    {{--</form>--}}
                                    <form class="admin-table-buttons" action="{{ route('admin.recipe.delete', ['id' => $recipe->id]) }}" method="POST">
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
                    {!! $recipes->appends(Input::except('page'))->render() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
