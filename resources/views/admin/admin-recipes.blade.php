@extends('layouts.adminlayout')
<!-- Admin page for management of recipe data  -->
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

<!-- Table to view recipe data and edit/delete recipes -->
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
            <div id="seed_string"></div>
            <div class="box box-success">
                <div class="box-header with-border">
                    <a href="{{ route('admin.recipe.new') }}" class="btn btn-success">New</a>
                </div>
                <div class="box-body">
                    <table id="recipes-datatable" class="table table-bordered table-striped table-hover">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Cuisine</th>
                            <th>Description</th>
                            <th>Ingredients</th>
                            <th>Steps</th>
                            <th>Average Rating</th>
                            <th>No. of Ratings</th>
                            <th>Edit</th>
                            <th>Seed</th>
                            <th>Delete</th>
                        </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
                <div class="box-footer">
                </div>
            </div>
        </div>
    </div>
@endsection
<!-- Pagination -->
@section('foot')
    <script>
        $(document).ready(function () {
            $('#recipes-datatable').DataTable({
                'paging'      : true,
                'lengthChange': true,
                'searching'   : true,
                'ordering'    : true,
                'info'        : true,
                'autoWidth'   : true,
                'stateSave'   : true,
                "processing"  : true,
                "serverSide"  : true,
                "ajax":{
                    "url"     : "{{ route('admin.recipes.post') }}",
                    "dataType": "json",
                    "type"    : "POST",
                    "data"    :{ _token: "{{csrf_token()}}"}
                },
                "columns": [
                    { "data"  : "id" },
                    { "data"  : "name" },
                    { "data"  : "cuisine_type_name" },
                    { "data"  : "short_description" },
                    { "data"  : "ingredient_count" },
                    { "data"  : "steps_count" },
                    { "data"  : "average_rating" },
                    { "data"  : "number_of_ratings" },
                    { "data"  : "edit" },
                    { "data"  : "seed" },
                    { "data"  : "delete" }
                ]
            });
        });
    </script>
@endsection