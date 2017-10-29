@extends('layouts.adminlayout')
<!-- Admin page for management of ingredient data  -->
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

<!-- Table to view ingredient data and edit/delete ingredients -->
@section('content')
    <div class="row">
        <div class="col-md-12">
            @if(isset($ingredient))
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4><i class="icon fa fa-check"></i> Success!</h4>
                    Ingredient "{{ $ingredient->name }}" stored in the database.
                </div>
            @endif
                <div class="box box-success">
                <div class="box-header with-border">
                    <a href="{{ route('admin.ingredient.new') }}" class="btn btn-success">New</a>
                </div>
                    <div id="seed_string"></div>
                    <div class="box-body">
                    <table id="ingredients-datatable" class="table table-bordered table-striped table-hover">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Category</th>
                            <th>In No. of Recipes</th>
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
            $('#ingredients-datatable').DataTable({
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
                    "url"     : "{{ route('admin.ingredients.post') }}",
                    "dataType": "json",
                    "type"    : "POST",
                    "data"    :{ _token: "{{csrf_token()}}"}
                },
                "columns": [
                    { "data"  : "id" },
                    { "data"  : "name" },
                    { "data"  : "category" },
                    { "data"  : "in_recipes" },
                    { "data"  : "edit" },
                    { "data"  : "seed" },
                    { "data"  : "delete" }
                ]
            });
        });
    </script>
@endsection