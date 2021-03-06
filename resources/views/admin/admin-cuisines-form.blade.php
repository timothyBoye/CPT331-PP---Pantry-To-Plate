@extends('layouts.adminlayout')
<!-- Admin form to add a new cuisine type to database -->
<!-- Validation -->
@section('head')
    <script>
        $().ready(function() {
            $("#form").validate({
                rules: {
                    name: {
                        required: true,
                        minlength: 3,
                        alpha_international: true
                    }
                },
                messages: {
                    name: {
                        required: "Please enter a name for the cuisine",
                        minlength: "A cuisine name must be at least 3 characters",
                        alpha_international: "A cuisine name can contain a-z and accented characters only"
                    }
                }
            });
        });
    </script>
@endsection
<!-- Breadcrumb trail -->
@section('content-header')
    <h1>
        {{$title}}
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="{{ route('admin.cuisines') }}"><i class="ion ion-ios-list"></i> Cuisines</a></li>
        <li><i class="fa fa-sticky-note-o"></i> {{$title}}</li>
    </ol>
@endsection

<!-- Input field for new cuisine type, added to database if unique and valid -->
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-success">
                <form role="form" action="{{ isset($cuisine) ? route('admin.cuisine.put', ['id' => $cuisine->id]) : route('admin.cuisine.post') }}" id="form" method="post">
                    {{ csrf_field() }}
                    @if(isset($cuisine))
                        {{ method_field('PUT') }}
                        <input type="text" id="id" name="id" value="{{ $cuisine->id }}" hidden disabled>
                    @endif
                    <div class="box-body">
                        <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter name" value="{{ isset($cuisine) ? $cuisine->name : old('name')  }}">
                            @if ($errors->has('name'))
                                <span class="help-block"><strong>{{ $errors->first('name') }}</strong></span>
                            @endif
                        </div>
                    </div>
                    <!-- /.box-body -->

                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <input class="btn btn-default" type="reset">
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
