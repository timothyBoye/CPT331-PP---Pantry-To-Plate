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
                    <div id="recipe-info">
                        <ul>
                            <li><strong>Serves:</strong> {{ $recipe->serving_size }}</li>
                            @if($recipe->cuisine_type)
                                <li><strong>Cuisine:</strong> {{ $recipe->cuisine_type->name }}</li>
                            @endif
                            <li>
                                <fieldset class="rating {{Auth::check() ? 'rating-editable' : ''}}">
                                    <strong>Rated:</strong>
                                    <input type="radio" id="star5-{{$recipe->id}}" name="rating-{{$recipe->id}}" value="5" {{ round($recipe->average_rating) == 5 ? 'checked' : '' }} {{Auth::check() ? '' : 'disabled'}}/><label for="star5-{{$recipe->id}}" title="Rocks!">5 stars</label>
                                    <input type="radio" id="star4-{{$recipe->id}}" name="rating-{{$recipe->id}}" value="4" {{ round($recipe->average_rating) == 4 ? 'checked' : '' }} {{Auth::check() ? '' : 'disabled'}}/><label for="star4-{{$recipe->id}}" title="Pretty good">4 stars</label>
                                    <input type="radio" id="star3-{{$recipe->id}}" name="rating-{{$recipe->id}}" value="3" {{ round($recipe->average_rating) == 3 ? 'checked' : '' }} {{Auth::check() ? '' : 'disabled'}}/><label for="star3-{{$recipe->id}}" title="Meh">3 stars</label>
                                    <input type="radio" id="star2-{{$recipe->id}}" name="rating-{{$recipe->id}}" value="2" {{ round($recipe->average_rating) == 2 ? 'checked' : '' }} {{Auth::check() ? '' : 'disabled'}}/><label for="star2-{{$recipe->id}}" title="Kinda bad">2 stars</label>
                                    <input type="radio" id="star1-{{$recipe->id}}" name="rating-{{$recipe->id}}" value="1" {{ round($recipe->average_rating) == 1 ? 'checked' : '' }} {{Auth::check() ? '' : 'disabled'}}/><label for="star1-{{$recipe->id}}" title="Sucks big time">1 star</label>
                                </fieldset>
                                by {{ $recipe->number_of_ratings }} users
                            </li>
                        </ul>
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
