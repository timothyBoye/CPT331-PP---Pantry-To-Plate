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
                <form role="form" action="{{ isset($recipe) ? route('admin.recipe.put', ['id' => $recipe->id]) : route('admin.recipe.post') }}" method="POST" id="form" novalidate>
                    {{ csrf_field() }}
                    @if(isset($recipe))
                        {{ method_field('PUT') }}
                        <input type="text" id="id" name="id" value="{{ $recipe->id }}" hidden disabled>
                    @endif
                    <div class="box-body">
                        <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                            <label for="name">Recipe Name</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter recipe name" value="{{ isset($recipe) ? $recipe->name : ''  }}">
                            @if ($errors->has('name'))
                                <span class="help-block"><strong>{{ $errors->first('name') }}</strong></span>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('image_url') ? 'has-error' : '' }}">
                            <label for="image_url">Image File Name</label>
                            <input type="text" class="form-control" id="image_url" name="image_url" placeholder="Enter an image file name" value="{{ isset($recipe) ? $recipe->image_url : ''  }}">
                            @if ($errors->has('image_url'))
                                <span class="help-block"><strong>{{ $errors->first('image_url') }}</strong></span>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('short_description') ? 'has-error' : '' }}">
                            <label for="short_description">Short Description</label>
                            <input type="text" class="form-control" id="short_description" name="short_description" placeholder="Enter recipe short description" value="{{ isset($recipe) ? $recipe->short_description : ''  }}">
                            @if ($errors->has('short_description'))
                                <span class="help-block"><strong>{{ $errors->first('short_description') }}</strong></span>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('long_description') ? 'has-error' : '' }}">
                            <label for="long_description">Long Description</label>
                            <textarea rows="3" class="form-control" id="long_description" name="long_description" placeholder="Enter recipe long description">{{ isset($recipe) ? $recipe->long_description : ''  }}</textarea>
                            @if ($errors->has('long_description'))
                                <span class="help-block"><strong>{{ $errors->first('long_description') }}</strong></span>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('serving_size') ? 'has-error' : '' }}">
                            <label for="serving_size">Serving Size</label>
                            <input type="text" class="form-control" id="serving_size" name="serving_size" placeholder="Enter recipe serving size" value="{{ isset($recipe) ? $recipe->serving_size : ''  }}">
                            @if ($errors->has('serving_size'))
                                <span class="help-block"><strong>{{ $errors->first('serving_size') }}</strong></span>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('cuisine_type_id') ? 'has-error' : '' }}">
                            <label for="cuisine_type_id">Cuisine Type</label>
                            <select id="cuisine_type_id" name="cuisine_type_id" class="form-control">
                                @foreach ($cuisine_types as $cuisine_type)
                                    <option {{ isset($recipe) ? ($cuisine_type->id == $recipe->cuisine_type_id ? 'selected' : '') : '' }} value="{{$cuisine_type->id}}">{{$cuisine_type->name}}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('cuisine_type_id'))
                                <span class="help-block"><strong>{{ $errors->first('cuisine_type_id') }}</strong></span>
                            @endif
                        </div>

                        <div id="method_container">
                            <h4>Method</h4>
                        </div>
                        <div id="method_buttons">
                            <p>
                                <a id="add_method_step" class="btn btn-primary btn-sm" href="#add_method_step"><span>(+) Add Step</span></a>
                                <a id="remove_method_step" class="btn btn-warning btn-sm"  href="#remove_method_step"><span>(-) Remove Step</span></a>
                            </p>
                        </div>

                        <div id="ingredients_container">
                            <h4>Ingredients</h4>
                        </div>
                        <div id="ingredients_buttons">
                            <p>
                                <a id="add_ingredient" class="btn btn-primary btn-sm" href="#add_ingredient"><span>(+) Add Ingredient</span></a>
                                <a id="remove_ingredient" class="btn btn-warning btn-sm"  href="#remove_ingredient"><span>(-) Remove Ingredient</span></a>
                            </p>
                        </div>
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



@section('head')
    <script>
        var method_steps_count = 0;
        var ingredients_count = 0;
        $(function() {
            // Recipe method steps functions
            @if(isset($recipe))
            @foreach($recipe->method_steps() as $step)
            $('#method_container').append(addStep('{{$step}}'));
            @endforeach
            @endif

            $('#add_method_step').click(function(){
                $('#method_container').append(addStep(''));
            });

            $('#remove_method_step').click(function(){
                if (method_steps_count > 0) {
                    method_steps_count -= 1;
                    $('#method_container > :last-child').remove();
                }
            });

            function addStep(text) {
                method_steps_count += 1;
                return '<div class="form-group">' +
                    '<h5>Step ' + method_steps_count + ': </h5>' +
                    '<label for="method_' + method_steps_count + '">Description</label>\n' +
                    '<input id="method_' + method_steps_count + '" class="form-control" name="methods[]' + '" type="text" placeholder="Enter step description" value="'+ text +'" />' +
                    '</div>';
            }


            // Recipe ingredients functions
            @if(isset($recipe))
            @foreach($recipe->ingredients as $ingredient)
            $('#ingredients_container').append(addIngredient('{{$ingredient->description}}', '{{$ingredient->measure->id}}', '{{$ingredient->quantity}}', {{$ingredient->ingredient_id}}));
            @endforeach
            @endif

            $('#add_ingredient').click(function(){
                $('#ingredients_container').append(addIngredient('', '', '', ''));
            });

            $('#remove_ingredient').click(function(){
                if (ingredients_count > 0) {
                    ingredients_count -= 1;
                    $('#ingredients_container > :last-child').remove();
                }
            });

            function addIngredient(description, measure, quantity, ingredient_id) {
                ingredients_count += 1;
                var ingredient_box = '<div class="form-group">' +
                    '<h5>Ingredient ' + ingredients_count + ': </h5>' +

                    // quantity
                    '<label for="ingredient_quantity_' + ingredients_count + '">Quantity</label>' +
                    '<input id="ingredient_quantity_' + ingredients_count + '" class="form-control" name="ingredient_quantities[]' + '" type="text" placeholder="Enter ingredient quantity" value="'+ quantity +'" />' +

                    // measurement type
                    '<label for="ingredient_measure_' + ingredients_count + '">Measurement Type</label>' +
                    '<select id="ingredient_measure_' + ingredients_count + '" name="ingredient_measures[]' + ingredients_count + '" class="form-control">' +
                @foreach ($measurement_types as $measurement_type)
                    '<option value="{{$measurement_type->id}}" ';

                if (measure == "{{$measurement_type->id}}") {
                    ingredient_box += 'selected';
                }

                ingredient_box +='>{{$measurement_type->name}}</option>' +
                @endforeach
                    '</select>' +

                    // Ingredient
                    '<label for="ingredient_name_' + ingredients_count + '">Ingredient Name</label>' +
                    '<select id="ingredient_name_' + ingredients_count + '" name="ingredient_names[]' + ingredients_count + '" class="form-control">' +
                @foreach ($ingredients as $ingredient)
                    '<option value="{{$ingredient->id}}" ';

                if (ingredient_id != '' && ingredient_id == "{{$ingredient->id}}") {
                    ingredient_box += 'selected';
                }

                ingredient_box +='>{{$ingredient->name}}</option>' +
                @endforeach
                    '</select>' +

                    // Description
                    '<label for="ingredient_description_' + ingredients_count + '">Description</label>\n' +
                    '<input id="ingredient_description_' + ingredients_count + '" class="form-control" name="ingredient_descriptions[]' + '" type="text" placeholder="Enter ingredient description" value="'+ description +'" />' +
                    '</div>';

                return ingredient_box;
            }

            // Validation
            $("#form").validate({
                rules: {
                    name: {
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
            $("input[id*='ingredient_quantity']").each(function() {
                $(this).validate();
                $(this).rules('add', {
                    required: true,
                    number: true,
                    messages: {
                        required: "Please enter a quantity",
                        number: "Doesn't appear to be a valid number"
                    }
                });
            });
            $("input[id*='ingredient_measure']").each(function() {
                $(this).validate();
                $(this).rules('add', {
                    required: true,
                    messages: {
                        required: "Please select a measure"
                    }
                });
            });
            $("input[id*='ingredient_name']").each(function() {
                $(this).validate();
                $(this).rules('add', {
                    required: true,
                    messages: {
                        required: "Please select an ingredient"
                    }
                });
            });
        });
    </script>
@endsection
