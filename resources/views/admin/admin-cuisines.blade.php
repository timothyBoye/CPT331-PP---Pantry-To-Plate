@extends('layouts.adminlayout')
<!-- Admin page for management of cuisine data  -->
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

<!-- Table to view cuisine data and edit/delete cuisine types -->
@section('content')
    <div class="row">
        <div class="col-md-12">
            @if(isset($cuisine))
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4><i class="icon fa fa-check"></i> Success!</h4>
                    Cuisine "{{ $cuisine->name }}" stored in the database.
                </div>
            @endif
                <div id="seed_string"></div>
                <div class="box box-success">
                <div class="box-header with-border">
                    <a href="{{ route('admin.cuisine.new') }}" class="btn btn-success">New</a>
                </div>
                <div class="box-body">
                    <table id="cuisines-datatable" class="table table-bordered table-striped table-hover">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>No. of Recipes</th>
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
            $('#cuisines-datatable').DataTable({
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
                    "url"     : "{{ route('admin.cuisines.post') }}",
                    "dataType": "json",
                    "type"    : "POST",
                    "data"    :{ _token: "{{csrf_token()}}"}
                },
                "columns": [
                    { "data"  : "id" },
                    { "data"  : "name" },
                    { "data"  : "number_of_recipes" },
                    { "data"  : "edit" },
                    { "data"  : "seed" },
                    { "data"  : "delete" }
                ]
            });
        });
    </script>
@endsection