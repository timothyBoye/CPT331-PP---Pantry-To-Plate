@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-3">

            </div>

            <div class="col-md-9">
                <div class="row">
                    <h1>{{ $recipe->name }}</h1>
                    <q>{{ $recipe->long_description }}</q>
                    <div id="recipe-serving">
                        <strong>Serves:</strong> {{ $recipe->serving_size }}
                    </div>
                </div>
                <div class="row">
                    <h2>Ingredients</h2>
                    <div id="recipe-ingredients">
                        <ul>
                            @foreach($recipe->ingredients as $ingredient)
                            <li>
                                {{-- Display ingredient quantity --}}
                                {!! \App\Utilities::approximatedFractionString($ingredient->quantity) !!}

                                {{-- Display measurement name
                                     Check if quantity is a multiple and if so add an s to the measure --}}
                                @if(($ingredient->quantity > 1) && ($ingredient->measure->name != ''))
                                    {{ $ingredient->measure->name }}s
                                @else
                                    {{ $ingredient->measure->name }}
                                @endif
                                {{-- Display ingredient name
                                     if there is a description also show that with a comma seperator
                                     NOTE: This line is messy for a reason, having it setup nice on
                                     new lines was adding a space before the comma, if you clean this
                                     ensure you don't reintroduce that bug --}}
                                {{ $ingredient->ingredient->name }}@if($ingredient->description), {{ $ingredient->description }}@endif
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="row">
                    <h2>Method</h2>
                    <div id="recipe-method">
                        <ol>
                            <li>
                                {!! str_replace(Config::get('constants.recipe_method_delimiter'), "</li><li>", $recipe->method) !!}
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
