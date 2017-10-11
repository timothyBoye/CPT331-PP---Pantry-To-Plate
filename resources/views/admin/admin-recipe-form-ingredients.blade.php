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
            <form role="form" action="{{ route('admin.recipe.ingredients.post', ['id' => $recipe->id]) }}" method="POST" id="form" novalidate>
                <div class="box box-success">
                    {{ csrf_field() }}
                    <div class="box-header with-border">
                        <h3 class="box-title">Recipe Ingredients</h3>
                        <div class="box-tools pull-right">
                            <span><i class="fa fa-minus"></i></span>
                        </div>
                    </div>
                    <div class="box-body">
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

                <div class="box box-solid">
                    <div class="box-body">
                        <div id="seed_file_string">

                        </div>
                        <button type="submit" class="btn btn-primary">Next</button>
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
            },
            messages: {
            }
        });


        var ingredients_count = 0;
        $(function() {
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
        });
    </script>
@endsection