@extends('layouts.adminlayout')
<!-- Admin form to add a new ingredient to database -->
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
                    },
                    ingredient_category_id: {
                        required: true,
                        digits: true
                    }
                },
                messages: {
                    name: {
                        required: "Please enter the ingredient's name",
                        minlength: "A name must be at least 3 characters"
                    },
                    ingredient_category_id: {
                        required: "Please select the ingredient's category",
                        digits: "Doesn't appear to be a valid category id"
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
        <li><a href="{{ route('admin.ingredients') }}"><i class="ion ion-ios-list"></i> Ingredients</a></li>
        <li><i class="fa fa-sticky-note-o"></i> {{$title}}</li>
    </ol>
@endsection

<!-- Input field for new ingredient, image and category, added to database if unique and valid -->
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-success">
                <form role="form" action="{{ isset($ingredient) ? route('admin.ingredient.put', ['id' => $ingredient->id]) : route('admin.ingredient.post') }}" id="form" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    @if(isset($ingredient))
                        {{ method_field('PUT') }}
                        <input type="text" id="id" name="id" value="{{ $ingredient->id }}" hidden disabled>
                    @endif
                    <div class="box-body">
                        <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter name" value="{{ isset($ingredient) ? $ingredient->name : old('name') }}">
                            @if ($errors->has('name'))
                                <span class="help-block"><strong>{{ $errors->first('name') }}</strong></span>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('ingredient_image') ? 'has-error' : '' }}">
                            <label for="ingredient_image">Image</label>
                            <input type="file" class="form-control" id="ingredient_image" name="ingredient_image" >
                            @if ($errors->has('ingredient_image'))
                                <span class="help-block"><strong>{{ $errors->first('ingredient_image') }}</strong></span>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('ingredient_category_id') ? 'has-error' : '' }}">
                            <label for="ingredient_category_id">Ingredient Category ID</label>
                            <select id="ingredient_category_id" name="ingredient_category_id" class="form-control">
                                @foreach ($categories as $category)
                                    <option {{ ((isset($ingredient) && $category->id == $ingredient->ingredient_category_id) || (old('ingredient_category_id') == $category->id)) ? 'selected' : '' }} value="{{$category->id}}">{{$category->name}}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('ingredient_category_id'))
                                <span class="help-block"><strong>{{ $errors->first('ingredient_category_id') }}</strong></span>
                            @endif
                        </div>
                        <div id="seed_file_string">

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
