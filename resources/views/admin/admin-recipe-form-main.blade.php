@extends('layouts.adminlayout')
<!-- Admin form to add a new recipe to database -->
<!-- Breadcrumb trail -->
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
<!-- Input fields for recipe details, added to database if unique and valid -->
@section('content')
    <form role="form" action="{{ isset($recipe) ? route('admin.recipe.put', ['id' => $recipe->id]) : route('admin.recipe.post') }}" method="POST" id="form" enctype="multipart/form-data" novalidate>
        <div class="row">
            <div class="col-md-6">
            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title">Recipe Details</h3>
                    {{ csrf_field() }}
                    @if(isset($recipe))
                        {{ method_field('PUT') }}
                        <input type="text" id="id" name="id" value="{{ $recipe->id }}" hidden disabled>
                    @endif
                </div>
                <div class="box-body">
                    <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                        <label for="name">Recipe Name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Enter recipe name" value="{{ isset($recipe) ? $recipe->name : old('name')  }}">
                        @if ($errors->has('name'))
                            <span class="help-block"><strong>{{ $errors->first('name') }}</strong></span>
                        @endif
                    </div>
                    <div class="form-group {{ $errors->has('recipe_source') ? 'has-error' : '' }}">
                        <label for="recipe_source">Recipe Sourced From</label>
                        <input type="text" class="form-control" id="recipe_source" name="recipe_source" placeholder="Enter recipe source" value="{{ isset($recipe) ? $recipe->recipe_source : old('recipe_source')  }}">
                        @if ($errors->has('recipe_source'))
                            <span class="help-block"><strong>{{ $errors->first('recipe_source') }}</strong></span>
                        @endif
                    </div>
                    <div class="form-group {{ $errors->has('image') ? 'has-error' : '' }}">
                        <label for="image">Image File</label>
                        <input type="file" class="form-control" id="image" name="image">
                        @if ($errors->has('image'))
                            <span class="help-block"><strong>{{ $errors->first('image') }}</strong></span>
                        @endif
                    </div>
                    <div class="form-group {{ $errors->has('short_description') ? 'has-error' : '' }}">
                        <label for="short_description">Short Description</label>
                        <input type="text" class="form-control" id="short_description" name="short_description" placeholder="Enter recipe short description" value="{{ isset($recipe) ? $recipe->short_description : old('short_description')  }}">
                        @if ($errors->has('short_description'))
                            <span class="help-block"><strong>{{ $errors->first('short_description') }}</strong></span>
                        @endif
                    </div>
                    <div class="form-group {{ $errors->has('long_description') ? 'has-error' : '' }}">
                        <label for="long_description">Long Description</label>
                        <textarea rows="3" class="form-control" id="long_description" name="long_description" placeholder="Enter recipe long description">{{ isset($recipe) ? $recipe->long_description : old('long_description')  }}</textarea>
                        @if ($errors->has('long_description'))
                            <span class="help-block"><strong>{{ $errors->first('long_description') }}</strong></span>
                        @endif
                    </div>
                    <div class="form-group {{ $errors->has('serving_size') ? 'has-error' : '' }}">
                        <label for="serving_size">Serves</label>
                        <input type="number" class="form-control" id="serving_size" name="serving_size" placeholder="Enter number of people recipe serves" value="{{ isset($recipe) ? $recipe->serving_size : old('serving_size')  }}">
                        @if ($errors->has('serving_size'))
                            <span class="help-block"><strong>{{ $errors->first('serving_size') }}</strong></span>
                        @endif
                    </div>
                    <div class="form-group {{ $errors->has('cuisine_type_id') ? 'has-error' : '' }}">
                        <label for="cuisine_type_id">Cuisine Type</label>
                        <select id="cuisine_type_id" name="cuisine_type_id" class="form-control">
                            @foreach ($cuisine_types as $cuisine_type)
                                <option {{ ((isset($recipe) && $cuisine_type->id == $recipe->cuisine_type_id) || ($cuisine_type->id == old('cuisine_type_id'))) ? 'selected' : '' }} value="{{$cuisine_type->id}}">{{$cuisine_type->name}}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('cuisine_type_id'))
                            <span class="help-block"><strong>{{ $errors->first('cuisine_type_id') }}</strong></span>
                        @endif
                    </div>
                </div>
            </div>
            </div>
            <!-- Input fields for recipe nutritional data -->
            <div class="col-md-6">
            <div class="box box-default">
                <div class="box-header with-border">
                    <h3 class="box-title">Nutritional Info</h3>
                </div>
                <div class="box-body" style="">
                    <div class="form-group {{ $errors->has('calories') ? 'has-error' : '' }}">
                        <label for="calories">Calories</label>
                        <input type="number" class="form-control" id="calories" name="calories" placeholder="Enter calories" value="{{ isset($recipe) ? $recipe->nutritional_info_panel->calories : old('calories')  }}">
                        @if ($errors->has('calories'))
                            <span class="help-block"><strong>{{ $errors->first('calories') }}</strong></span>
                        @endif
                    </div>
                    <div class="form-group {{ $errors->has('gram_total_fat') ? 'has-error' : '' }}">
                        <label for="gram_total_fat">Grams Total Fat</label>
                        <input type="number" class="form-control" id="gram_total_fat" name="gram_total_fat" placeholder="Enter grams total fat" value="{{ isset($recipe) ? $recipe->nutritional_info_panel->gram_total_fat : old('gram_total_fat')  }}">
                        @if ($errors->has('gram_total_fat'))
                            <span class="help-block"><strong>{{ $errors->first('gram_total_fat') }}</strong></span>
                        @endif
                    </div>
                    <div class="form-group {{ $errors->has('gram_saturated_fat') ? 'has-error' : '' }}">
                        <label for="gram_saturated_fat">Grams Saturated Fats</label>
                        <input type="number" class="form-control" id="gram_saturated_fat" name="gram_saturated_fat" placeholder="Enter grams saturated fat" value="{{ isset($recipe) ? $recipe->nutritional_info_panel->gram_saturated_fat : old('gram_saturated_fat')  }}">
                        @if ($errors->has('gram_saturated_fat'))
                            <span class="help-block"><strong>{{ $errors->first('gram_saturated_fat') }}</strong></span>
                        @endif
                    </div>
                    <div class="form-group {{ $errors->has('gram_fiber') ? 'has-error' : '' }}">
                        <label for="gram_fiber">Grams Fibre</label>
                        <input type="number" class="form-control" id="gram_fiber" name="gram_fiber" placeholder="Enter grams fibre" value="{{ isset($recipe) ? $recipe->nutritional_info_panel->gram_fiber : old('gram_fiber')  }}">
                        @if ($errors->has('gram_fiber'))
                            <span class="help-block"><strong>{{ $errors->first('gram_fiber') }}</strong></span>
                        @endif
                    </div>
                    <div class="form-group {{ $errors->has('gram_total_carbohydrates') ? 'has-error' : '' }}">
                        <label for="gram_total_carbohydrates">Grams Total Carbohydrates</label>
                        <input type="number" class="form-control" id="gram_total_carbohydrates" name="gram_total_carbohydrates" placeholder="Enter grams total fat" value="{{ isset($recipe) ? $recipe->nutritional_info_panel->gram_total_carbohydrates : old('gram_total_carbohydrates')  }}">
                        @if ($errors->has('gram_total_carbohydrates'))
                            <span class="help-block"><strong>{{ $errors->first('gram_total_carbohydrates') }}</strong></span>
                        @endif
                    </div>
                    <div class="form-group {{ $errors->has('gram_sugars') ? 'has-error' : '' }}">
                        <label for="gram_sugars">Grams Sugar</label>
                        <input type="number" class="form-control" id="gram_sugars" name="gram_sugars" placeholder="Enter grams sugar" value="{{ isset($recipe) ? $recipe->nutritional_info_panel->gram_sugars : old('gram_sugars') }}">
                        @if ($errors->has('gram_sugars'))
                            <span class="help-block"><strong>{{ $errors->first('gram_sugars') }}</strong></span>
                        @endif
                    </div>
                    <div class="form-group {{ $errors->has('gram_protein') ? 'has-error' : '' }}">
                        <label for="gram_protein">Grams Protein</label>
                        <input type="number" class="form-control" id="gram_protein" name="gram_protein" placeholder="Enter grams protein" value="{{ isset($recipe) ? $recipe->nutritional_info_panel->gram_protein : old('gram_protein') }}">
                        @if ($errors->has('gram_protein'))
                            <span class="help-block"><strong>{{ $errors->first('gram_protein') }}</strong></span>
                        @endif
                    </div>
                    <div class="form-group {{ $errors->has('mg_sodium') ? 'has-error' : '' }}">
                        <label for="mg_sodium">Milligrams Sodium</label>
                        <input type="number" class="form-control" id="mg_sodium" name="mg_sodium" placeholder="Enter mg sodium" value="{{ isset($recipe) ? $recipe->nutritional_info_panel->mg_sodium : old('mg_sodium') }}">
                        @if ($errors->has('mg_sodium'))
                            <span class="help-block"><strong>{{ $errors->first('mg_sodium') }}</strong></span>
                        @endif
                    </div>
                </div>
            </div>
            </div>
        </div>
        <div class="row">
            <div class="box box-solid">
                <div class="box-body">
                    <div id="seed_file_string">

                    </div>
                    <button type="submit" class="btn btn-primary">Next</button>
                    <input class="btn btn-default" type="reset">
                </div>
            </div>
        </div>
    </form>
@endsection



@section('head')
    <script>

        // Validation
        $("#form").validate({
            rules: {
                name: {
                    required: true,
                    minlength: 3
                },
                recipe_source: {
                    required: true,
                    minlength: 3
                },
                short_description: {
                    required: true,
                    minlength: 3
                },
                long_description: {
                    required: true,
                    minlength: 3
                },
                image_url: {
                    required: true,
                    minlength: 3
                },
                serving_size: {
                    required: true,
                    digits: true
                },
                cuisine_type_id: {
                    required: true,
                    digits: true
                }
                calories: {
                    digits: true
                },
                mg_sodium: {
                    digits: true
                },
                gram_total_fat: {
                    number: true
                },
                gram_saturated_fat: {
                    number: true
                },
                gram_fibre: {
                    number: true
                },
                gram_total_carbohydrates: {
                    number: true
                },
                gram_sugar: {
                    number: true
                },
                gram_protein: {
                    number: true
                },
            },
            messages: {
                name: {
                    required: "Please enter a name for the recipe",
                    minlength: "A recipe name must be at least 3 characters"
                },
                short_description: {
                    required: "Please enter a description",
                    minlength: "A description must be at least 3 characters"
                },
                long_description: {
                    required: "Please enter a description",
                    minlength: "A description must be at least 3 characters"
                },
                image_url: {
                    required: "Please enter an image file name (include the file extension)",
                    minlength: "A image name must be at least 3 characters (include the file extension)"
                },
                serving_size: {
                    required: "Please enter how many people the recipe serves",
                    digits: "Doesn't appear to be a number"
                },
                cuisine_type_id: {
                    required: "Please enter a cuisine type",
                    digits: "Doesn't appear to be a valid cuisine type id"
                }
            }
        });
    </script>
@endsection
