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
            @if(isset($recipe))
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4><i class="icon fa fa-check"></i> Success!</h4>
                    Recipe "{{ $recipe->name }}" stored in the database.
                </div>
            @endif
            <div class="box box-success">
                <div class="box-header with-border">
                    <a href="{{ route('admin.recipe.new') }}" class="btn btn-success">New</a>
                </div>
                <div class="box-body">
                    <table id="datatable" class="table table-bordered table-striped table-hover">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Cuisine</th>
                            <th>Description</th>
                            <th>Ingredients</th>
                            <th>Steps</th>
                            <th>Average Rating</th>
                            <th>No. of Ratings</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($recipes as $recipe)
                            <tr>
                                <td>{{ $recipe->name}}</td>
                                <td>{{ $recipe->short_description }}</td>
                                <td>{{ $recipe->cuisine_type->name }}</td>
                                <td>{{ count($recipe->ingredients) }}</td>
                                <td>{{ count($recipe->method_steps) }}</td>
                                <td>{{ $recipe->average_rating }}</td>
                                <td>{{ $recipe->number_of_ratings }}</td>
                                <td>
                                    <form class="admin-table-buttons" action="{{ route('admin.recipe.get', ['id' => $recipe->id]) }}" method="GET">
                                        {{ csrf_field() }}
                                        <button class="btn btn-default btn-sm" type="submit">Edit</button>
                                    </form>
                                    <form class="admin-table-buttons" action="{{ route('admin.recipe.delete', ['id' => $recipe->id]) }}" method="POST">
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
                'autoWidth'   : true
            })
        })
    </script>
@endsection