@extends('layouts.adminlayout')

@section('content-header')
    <h1>
        {{$title}}
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="{{ route('admin.recipes') }}"><i class="ion ion-ios-list"></i> Recipes</a></li>
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
                        <label for="name">Recipe Name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Enter recipe name" value="{{ isset($recipe) ? $recipe->name : ''  }}">
                    </div>
                    <div class="form-group">
                        <label for="short_description">Short Description</label>
                        <input type="text" class="form-control" id="short_description" name="short_description" placeholder="Enter recipe short description" value="{{ isset($recipe) ? $recipe->short_description : ''  }}">
                    </div>
                    <div class="form-group">
                        <label for="long_description">Long Description</label>
                        <textarea rows="3" class="form-control" id="long_description" name="long_description" placeholder="Enter recipe long description">{{ isset($recipe) ? $recipe->long_description : ''  }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="serving_size">Serving Size</label>
                        <input type="text" class="form-control" id="serving_size" name="serving_size" placeholder="Enter recipe serving size" value="{{ isset($recipe) ? $recipe->serving_size : ''  }}">
                    </div>
                    <div class="form-group">
                        <label for="cuisine_type">Cuisine Type</label>
                        <input type="text" class="form-control" id="cuisine_type" name="cuisine_type" placeholder="Enter recipe cuisine type" value="{{ isset($recipe) ? $recipe->cuisine_type : ''  }}">
                    </div>
                    <div class="form-group">
                        <label for="method">Method</label>
                        <textarea rows="6" class="form-control" id="method" name="method" placeholder="Enter recipe method">{{ isset($recipe) ? $recipe->method : '' }}</textarea>
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
