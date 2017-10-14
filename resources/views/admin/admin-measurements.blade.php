@extends('layouts.adminlayout')

@section('content-header')
    <h1>
        {{$title}}
        <small>List of measurement types</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><i class="ion ion-spoon"></i> {{$title}}</li>
    </ol>
@endsection


@section('content')
    <div class="row">
        <div class="col-md-12">
            @if(isset($measurement))
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i> Success!</h4>
                Measurement type "{{ $measurement->name }}" stored in the database.
            </div>
            @endif
                <div id="seed_string"></div>
                <div class="box box-success">
                <div class="box-header with-border">
                    <a href="{{ route('admin.measurement.new') }}" class="btn btn-success">New</a>
                </div>
                <div class="box-body">
                    <table id="datatable" class="table table-bordered table-striped table-hover">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Comparable Size</th>
                            <th>Edit</th>
                            <th>Seed</th>
                            <th>Delete</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($measurements as $measurement)
                            <tr>
                                <td>{{ $measurement->id }}</td>
                                <td>{{ $measurement->name}}</td>
                                <td>{{ $measurement->comparable_size }}</td>
                                <td>
                                    <form class="admin-table-buttons" action="{{ route('admin.measurement.get', ['id' => $measurement->id]) }}" method="GET">
                                        {{ csrf_field() }}
                                        <button class="btn btn-info btn-sm" type="submit">Edit</button>
                                    </form>
                                </td>
                                <th>
                                    <form id="seed_form_{{$measurement->id}}" class="admin-table-buttons" action="" method="POST">
                                        {{ csrf_field() }}
                                        <button id="seed_button_{{$measurement->id}}" data-api-controller-url="{{route('admin.measurement.seeder', ['id' => $measurement->id])}}" class="btn btn-default btn-sm" type="button">Seed String</button>
                                        <script>
                                            $('#seed_button_{{$measurement->id}}').click(function(){
                                                console.log('click');
                                                $.ajax({
                                                    url: $('#seed_button_{{$measurement->id}}').attr('data-api-controller-url'),
                                                    type: 'POST',
                                                    data: $('#seed_form_{{$measurement->id}}').serialize()
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
                                    <form class="admin-table-buttons" action="{{ route('admin.measurement.delete', ['id' => $measurement->id]) }}" method="POST">
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