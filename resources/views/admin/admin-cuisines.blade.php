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
            @if(isset($cuisine))
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4><i class="icon fa fa-check"></i> Success!</h4>
                    Cuisine "{{ $cuisine->name }}" stored in the database.
                </div>
            @endif
            <div class="box box-success">
                <div class="box-header with-border">
                    <a href="{{ route('admin.cuisine.new') }}" class="btn btn-success">New</a>
                </div>
                <div class="box-body">
                    <table id="datatable" class="table table-bordered table-striped table-hover">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>No. of Recipes</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($cuisines as $cuisine)
                            <tr>
                                <td>{{ $cuisine->name}}</td>
                                <td>{{ count($cuisine->recipes) }}</td>
                                <td>
                                    <form class="admin-table-buttons" action="{{ route('admin.cuisine.get', ['id' => $cuisine->id]) }}" method="GET">
                                        {{ csrf_field() }}
                                        <button class="btn btn-default btn-sm" type="submit">Edit</button>
                                    </form>
                                    <form class="admin-table-buttons" action="{{ route('admin.cuisine.delete', ['id' => $cuisine->id]) }}" method="POST">
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