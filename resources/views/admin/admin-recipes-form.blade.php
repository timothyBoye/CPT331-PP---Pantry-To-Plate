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
            <form role="form" action="{{ isset($recipe) ? route('admin.recipe.put', ['id' => $recipe->id]) : route('admin.recipe.post') }}" method="POST" id="form" novalidate>
                <div class="box box-success">
                    {{ csrf_field() }}
                    @if(isset($recipe))
                        {{ method_field('PUT') }}
                        <input type="text" id="id" name="id" value="{{ $recipe->id }}" hidden disabled>
                    @endif
                    <div class="box-body">
                        <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                            <label for="name">Recipe Name</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter recipe name" value="{{ isset($recipe) ? $recipe->name : old('name')  }}">
                            @if ($errors->has('name'))
                                <span class="help-block"><strong>{{ $errors->first('name') }}</strong></span>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('image_url') ? 'has-error' : '' }}">
                            <label for="image_url">Image File Name</label>
                            <input type="text" class="form-control" id="image_url" name="image_url" placeholder="Enter an image file name" value="{{ isset($recipe) ? $recipe->image_url : old('image_url')  }}">
                            @if ($errors->has('image_url'))
                                <span class="help-block"><strong>{{ $errors->first('image_url') }}</strong></span>
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
                            <label for="serving_size">Serving Size</label>
                            <input type="text" class="form-control" id="serving_size" name="serving_size" placeholder="Enter recipe serving size" value="{{ isset($recipe) ? $recipe->serving_size : old('serving_size')  }}">
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

                <div class="box box-default box-solid">
                    <a data-widget="collapse" href="">
                        <div class="box-header with-border">
                            <h3 class="box-title">Recipe Method</h3>
                            <div class="box-tools pull-right">
                                <span><i class="fa fa-minus"></i></span>
                            </div>
                        </div>
                    </a>
                    <div class="box-body" style="">
                        <div id="method_container">
                        </div>
                        <div id="method_buttons">
                            <p>
                                <a id="add_method_step" class="btn btn-primary btn-sm" href="#method_container"><span>(+) Add Step</span></a>
                                <a id="remove_method_step" class="btn btn-warning btn-sm"  href="#method_container"><span>(-) Remove Step</span></a>
                            </p>
                        </div>
                    </div>
                </div>

                <div class="box box-default box-solid">
                    <a data-widget="collapse" href="">
                        <div class="box-header with-border">
                            <h3 class="box-title">Recipe Ingredients</h3>
                            <div class="box-tools pull-right">
                                <span><i class="fa fa-minus"></i></span>
                            </div>
                        </div>
                    </a>
                    <div class="box-body" style="">
                        <div id="ingredients_container">
                        </div>
                        <div id="ingredients_buttons">
                            <p>
                                <a id="add_ingredient" class="btn btn-primary btn-sm" href="#ingredients_container"><span>(+) Add Ingredient</span></a>
                                <a id="remove_ingredient" class="btn btn-warning btn-sm"  href="#ingredients_container"><span>(-) Remove Ingredient</span></a>
                            </p>
                        </div>
                    </div>
                </div>

                <div class="box box-default box-solid">
                    <a data-widget="collapse" href="">
                        <div class="box-header with-border">
                            <h3 class="box-title">Nutritional Info</h3>
                            <div class="box-tools pull-right">
                                <span><i class="fa fa-minus"></i></span>
                            </div>
                        </div>
                    </a>
                    <div class="box-body" style="">
                        <div class="form-group {{ $errors->has('calories') ? 'has-error' : '' }}">
                            <label for="calories">Calories</label>
                            <input type="text" class="form-control" id="calories" name="calories" placeholder="Enter calories" value="{{ isset($recipe) ? $recipe->nutritional_info_panel->calories : old('calories')  }}">
                            @if ($errors->has('calories'))
                                <span class="help-block"><strong>{{ $errors->first('calories') }}</strong></span>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('gram_total_fat') ? 'has-error' : '' }}">
                            <label for="gram_total_fat">Grams Total Fat</label>
                            <input type="text" class="form-control" id="gram_total_fat" name="gram_total_fat" placeholder="Enter grams total fat" value="{{ isset($recipe) ? $recipe->nutritional_info_panel->gram_total_fat : old('gram_total_fat')  }}">
                            @if ($errors->has('gram_total_fat'))
                                <span class="help-block"><strong>{{ $errors->first('gram_total_fat') }}</strong></span>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('gram_saturated_fat') ? 'has-error' : '' }}">
                            <label for="gram_saturated_fat">Grams Saturated Fats</label>
                            <input type="text" class="form-control" id="gram_saturated_fat" name="gram_saturated_fat" placeholder="Enter grams saturated fat" value="{{ isset($recipe) ? $recipe->nutritional_info_panel->gram_saturated_fat : old('gram_saturated_fat')  }}">
                            @if ($errors->has('gram_saturated_fat'))
                                <span class="help-block"><strong>{{ $errors->first('gram_saturated_fat') }}</strong></span>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('gram_fiber') ? 'has-error' : '' }}">
                            <label for="gram_fiber">Grams Fibre</label>
                            <input type="text" class="form-control" id="gram_fiber" name="gram_fiber" placeholder="Enter grams fibre" value="{{ isset($recipe) ? $recipe->nutritional_info_panel->gram_fiber : old('gram_fiber')  }}">
                            @if ($errors->has('gram_fiber'))
                                <span class="help-block"><strong>{{ $errors->first('gram_fiber') }}</strong></span>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('gram_total_carbohydrates') ? 'has-error' : '' }}">
                            <label for="gram_total_carbohydrates">Grams Total Carbohydrates</label>
                            <input type="text" class="form-control" id="gram_total_carbohydrates" name="gram_total_carbohydrates" placeholder="Enter grams total fat" value="{{ isset($recipe) ? $recipe->nutritional_info_panel->gram_total_carbohydrates : old('gram_total_carbohydrates')  }}">
                            @if ($errors->has('gram_total_carbohydrates'))
                                <span class="help-block"><strong>{{ $errors->first('gram_total_carbohydrates') }}</strong></span>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('gram_sugars') ? 'has-error' : '' }}">
                            <label for="gram_sugars">Grams Sugar</label>
                            <input type="text" class="form-control" id="gram_sugars" name="gram_sugars" placeholder="Enter grams sugar" value="{{ isset($recipe) ? $recipe->nutritional_info_panel->gram_sugars : old('gram_sugars') }}">
                            @if ($errors->has('gram_sugars'))
                                <span class="help-block"><strong>{{ $errors->first('gram_sugars') }}</strong></span>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('gram_protein') ? 'has-error' : '' }}">
                            <label for="gram_protein">Grams Protein</label>
                            <input type="text" class="form-control" id="gram_protein" name="gram_protein" placeholder="Enter grams protein" value="{{ isset($recipe) ? $recipe->nutritional_info_panel->gram_protein : old('gram_protein') }}">
                            @if ($errors->has('gram_protein'))
                                <span class="help-block"><strong>{{ $errors->first('gram_protein') }}</strong></span>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('mg_sodium') ? 'has-error' : '' }}">
                            <label for="mg_sodium">Milligrams Sodium</label>
                            <input type="text" class="form-control" id="mg_sodium" name="mg_sodium" placeholder="Enter mg sodium" value="{{ isset($recipe) ? $recipe->nutritional_info_panel->mg_sodium : old('mg_sodium') }}">
                            @if ($errors->has('mg_sodium'))
                                <span class="help-block"><strong>{{ $errors->first('mg_sodium') }}</strong></span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="box box-solid">
                    <div class="box-body">
                        <div id="seed_file_string">

                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <button type="button" id="seed_button" class="btn btn-info" data-api-controller-url="{{route('admin.recipe.seeder')}}">Get Seed File String</button>
                        <input class="btn btn-default" type="reset">
                    </div>
                </div>
            </form>
        </div>
    </div>
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


        var method_steps_count = 0;
        var ingredients_count = 0;
        $(function() {
            $('#seed_button').click(function(){
                if($("input[name=_method]").length) {
                    $("input[name=_method]").val('POST');
                }
                $.ajax({
                    url: $('#seed_button').attr('data-api-controller-url'),
                    type: 'POST',
                    data: $(form).serialize()
                }).done(function(response){
                    $('#seed_file_string').html('<pre>'+response+'</pre>');
                    if($("input[name=_method]").length) {
                        $("input[name=_method]").val('PUT');
                    }
                }).fail(function(response){
                    $('#seed_file_string').html(response.responseText);
                    if($("input[name=_method]").length) {
                        $("input[name=_method]").val('PUT');
                    }
                });
            });

            // Recipe method steps functions
            @if(isset($recipe))
                @foreach($recipe->method_steps as $step)
                    $('#method_container').append(addStep('{{$step->description}}', '{{$step->image_url}}'));
                @endforeach
            @elseif(old('method_descriptions'))
                @for($i = 0; $i < count(old('method_descriptions')); $i++)
                    @php($image = old('method_images.'.$i))
                    @php($description = old('method_descriptions.'.$i))
                    $('#method_container').append(addStep('{{$description}}', '{{$image}}'));
                @endfor
            @endif

            $('#add_method_step').click(function() {
                $('#method_container').append(addStep('', ''));
                $('.method_descriptions').each(function(key, element) {
                    $(element).append("hello");
                });
            });

            $('#remove_method_step').click(function(){
                if (method_steps_count > 0) {
                    method_steps_count -= 1;
                    $('#method_container > :last-child').remove();
                }
            });

            function addStep(description, image_name) {
                method_steps_count += 1;
                return '<div class="form-group">' +
                    '<h5>Step ' + method_steps_count + ': </h5>' +
                    '<label for="method_description_' + method_steps_count + '">Description</label>\n' +
                    '<input id="method_description_' + method_steps_count + '" class="form-control method_descriptions" name="method_descriptions[]' + '" type="text" placeholder="Enter step description" value="'+ description +'" />' +
                    '<label for="method_image_' + method_steps_count + '">Image name</label>\n' +
                    '<input id="method_image_' + method_steps_count + '" class="form-control" name="method_images[]' + '" type="text" placeholder="Enter step image name" value="'+ image_name +'" />' +
                    '</div>';
            }


            // Recipe ingredients functions
            @if(isset($recipe))
                @foreach($recipe->ingredients as $ingredient)
                    $('#ingredients_container').append(addIngredient('{{$ingredient->description}}', '{{$ingredient->measure->id}}', '{{$ingredient->quantity}}', {{$ingredient->ingredient_id}}));
                @endforeach
            @elseif(old('ingredient_quantities'))
                @for($i = 0; $i < count(old('ingredient_quantities')); $i++)
                    $('#ingredients_container').append(addIngredient('{{old('ingredient_descriptions')[$i]}}', '{{old('ingredient_measures')[$i]}}', '{{old('ingredient_quantities')[$i]}}', {{old('ingredient_names')[$i]}}));
                @endfor
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
//
//            $("input[id*='ingredient_quantity']").each(function() {
//                $(this).validate();
//                $(this).rules('add', {
//                    required: true,
//                    number: true,
//                    messages: {
//                        required: "Please enter a quantity",
//                        number: "Doesn't appear to be a valid number"
//                    }
//                });
//            });
//            $("input[id*='ingredient_measure']").each(function() {
//                $(this).validate();
//                $(this).rules('add', {
//                    required: true,
//                    messages: {
//                        required: "Please select a measure"
//                    }
//                });
//            });
//            $("input[id*='ingredient_name']").each(function() {
//                $(this).validate();
//                $(this).rules('add', {
//                    required: true,
//                    messages: {
//                        required: "Please select an ingredient"
//                    }
//                });
//            });
//            $("input[id*='method_desciption']").each(function() {
//                $(this).validate();
//                $(this).rules('add', {
//                    required: true,
//                    messages: {
//                        required: "Please enter an ingredient"
//                    }
//                });
//            });
//            $("input[id*='method_image']").each(function() {
//                $(this).validate();
//                $(this).rules('add', {
//                    required: false,
//                    messages: {
//                    }
//                });
//            });
        });
    </script>
@endsection
