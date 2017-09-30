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
                    <a href="{{ route('admin.recipe.new') }}" class="btn btn-success">Add Recipe</a>
                </div>
                <div class="box-body">
                    <table class="table">
                        <tr>
                            <th>Name</th>
                            <th>Description</th>
                            <th width="280px"></th>
                        </tr>
                        @foreach ($recipes as $recipe)
                            <tr>
                                <td>{{ $recipe->name}}</td>
                                <td>{{ $recipe->short_description }}</td>
                                <td>
                                    <a class="btn" href="{{ route('admin.recipe.get', ['id' => $recipe->id]) }}">View/Edit Recipe</a>
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
