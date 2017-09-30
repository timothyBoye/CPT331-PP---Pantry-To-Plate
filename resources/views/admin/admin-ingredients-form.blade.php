@extends('layouts.adminlayout')

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


@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-success">
                <form role="form" action="" method="post">
                    <div class="box-body">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter name" value="{{ isset($ingredient) ? $ingredient->name : ''  }}">
                        </div>
                        <div class="form-group">
                            <label for="ingredient-image-url">Image name</label>
                            <input type="text" class="form-control" id="ingredient-image-url" name="ingredient-image-url" placeholder="Enter image name" value="{{ isset($ingredient) ? $ingredient->ingredient_image_url : ''  }}">
                        </div>
                        <div class="form-group">
                            <label for="ingredient-category-id">Ingredient Category ID</label>
                            <input type="text" class="form-control" id="ingredient-category-id" name="ingredient-category-id" placeholder="Enter ingredient category id" value="{{ isset($ingredient) ? $ingredient->ingredient_category_id : ''  }}">
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
