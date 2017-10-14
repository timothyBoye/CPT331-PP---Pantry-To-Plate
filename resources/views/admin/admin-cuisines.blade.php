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
                <div id="seed_string"></div>
                <div class="box box-success">
                <div class="box-header with-border">
                    <a href="{{ route('admin.cuisine.new') }}" class="btn btn-success">New</a>
                </div>
                <div class="box-body">
                    <table id="datatable" class="table table-bordered table-striped table-hover">
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
                        @foreach ($cuisines as $cuisine)
                            <tr>
                                <td>{{ $cuisine->id }}</td>
                                <td>{{ $cuisine->name}}</td>
                                <td>{{ count($cuisine->recipes) }}</td>
                                <td>
                                    <form class="admin-table-buttons" action="{{ route('admin.cuisine.get', ['id' => $cuisine->id]) }}" method="GET">
                                        {{ csrf_field() }}
                                        <button class="btn btn-info btn-sm" type="submit">Edit</button>
                                    </form>
                                </td>
                                <th>
                                    <form id="seed_form_{{$cuisine->id}}" class="admin-table-buttons" action="" method="POST">
                                        {{ csrf_field() }}
                                        <button id="seed_button_{{$cuisine->id}}" data-api-controller-url="{{route('admin.cuisine.seeder', ['id' => $cuisine->id])}}" class="btn btn-default btn-sm" type="button">Seed String</button>
                                        <script>
                                            $('#seed_button_{{$cuisine->id}}').click(function(){
                                                console.log('click');
                                                $.ajax({
                                                    url: $('#seed_button_{{$cuisine->id}}').attr('data-api-controller-url'),
                                                    type: 'POST',
                                                    data: $('#seed_form_{{$cuisine->id}}').serialize()
                                                }).done(function(response){
                                                    $('#seed_string').html('<pre>'+response+'</pre>');
                                                }).fail(function(response){
                                                    $('#seed_string').html(response.responseText);
                                                });
                                            });
                                        </script>
                                    </form>
                                </th>
                                <td>
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

@endsection