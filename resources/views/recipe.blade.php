@extends('layouts.app')

@section('content')
    <div class="container-fluid">
{{--=======--}}
    {{--<div class="container content">--}}
{{-->>>>>>> 153e3c615c2597500d52bc32eefdd43d0c80d596--}}
        <div class="row">
            <div class="col-md-6 each-img-container margin-top">
                <div class="each-recipe-result-img" style="background-image: url({{ URL::asset('img/recipes/'.($recipe->image_url == '' ? 'default.jpg' : $recipe->image_url)) }});"></div>
                    <div class = "recipe-onfo-each">
                        <h1>{{ $recipe->name }}</h1>
                        <strong>Rated:</strong>
                        <fieldset class="inline-block rating {{Auth::check() ? 'rating-editable' : ''}} {{ $userRating ? 'rated' : '' }}"  id="rating-{{$recipe->id}}" >
                            @php ($rating = $userRating ? $userRating->rating : round($recipe->average_rating))
                            <input type="radio" id="star5-{{$recipe->id}}" name="rating-{{$recipe->id}}" value="5" {{Auth::check() ? 'onclick=makeRatingCall('.$recipe->id.',"'.URL::route('setRating').'");' : ''}} {{ $rating == 5 ? 'checked' : '' }} {{Auth::check() ? '' : 'disabled'}}/><label for="star5-{{$recipe->id}}" title="Rocks!">5 stars</label>
                            <input type="radio" id="star4-{{$recipe->id}}" name="rating-{{$recipe->id}}" value="4" {{Auth::check() ? 'onclick=makeRatingCall('.$recipe->id.',"'.URL::route('setRating').'");' : ''}} {{ $rating == 4 ? 'checked' : '' }} {{Auth::check() ? '' : 'disabled'}}/><label for="star4-{{$recipe->id}}" title="Pretty good">4 stars</label>
                            <input type="radio" id="star3-{{$recipe->id}}" name="rating-{{$recipe->id}}" value="3" {{Auth::check() ? 'onclick=makeRatingCall('.$recipe->id.',"'.URL::route('setRating').'");' : ''}} {{ $rating == 3 ? 'checked' : '' }} {{Auth::check() ? '' : 'disabled'}}/><label for="star3-{{$recipe->id}}" title="Meh">3 stars</label>
                            <input type="radio" id="star2-{{$recipe->id}}" name="rating-{{$recipe->id}}" value="2" {{Auth::check() ? 'onclick=makeRatingCall('.$recipe->id.',"'.URL::route('setRating').'");' : ''}} {{ $rating == 2 ? 'checked' : '' }} {{Auth::check() ? '' : 'disabled'}}/><label for="star2-{{$recipe->id}}" title="Kinda bad">2 stars</label>
                            <input type="radio" id="star1-{{$recipe->id}}" name="rating-{{$recipe->id}}" value="1" {{Auth::check() ? 'onclick=makeRatingCall('.$recipe->id.',"'.URL::route('setRating').'");' : ''}} {{ $rating == 1 ? 'checked' : '' }} {{Auth::check() ? '' : 'disabled'}}/><label for="star1-{{$recipe->id}}" title="Sucks big time">1 star</label>
                        </fieldset>
                        <span id="rated-by-who">
                            @if ($userRating)
                                your rating
                            @else
                                by {{ $recipe->number_of_ratings }} users <br>
                            @endif

                        <q>{{ $recipe->long_description }}</q>

                            <div class = "recipe-info-opacity"></div>
                         </span>
                    </div>
                </div>

            <div class="col-md-6 margin-top">

                <div class="col-md-2">
                    Serves: {{ $recipe->serving_size }}
                </div>
                <div class="col-md-2">
                    @if($recipe->cuisine_type)
                        Cuisine: {{ $recipe->cuisine_type->name }}
                    @endif
                </div>
                <div class="col-md-2">Time</div>

            </div>

        </div>
    </div>


    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <h2>Ingredients</h2>
                <div id="recipe-ingredients">
                    <ul>
                        @foreach($recipe->ingredients as $ingredient)
                        <li>
                            {!! \App\Utilities::approximatedFractionString($ingredient->quantity) !!}

                            @if(($ingredient->quantity > 1) && ($ingredient->measure->name != ''))
                                {{ $ingredient->measure->name }}s
                            @else
                                {{ $ingredient->measure->name }}
                            @endif
                                {{ $ingredient->ingredient->name }}@if($ingredient->description), {{ $ingredient->description }}@endif
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="col-md-6">
                    <h2>Method</h2>
                    <div id="recipe-method">
                        <ol>
                            @foreach($recipe->method_steps as $step)
                                <li>{{$step->description}}</li>
                            @endforeach
                        </ol>
                    </div>
            </div>
        </div>
    </div>

    
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <div class = "nutritional-box">
                    @if($recipe->nutritional_info_panel)
                        @include('partials.nutritionalInfoPanel', ['nutritional_info_panel' => $recipe->nutritional_info_panel])
                    @endif
                </div>
            </div>
            <div class="col-md-6">
                @if(filter_var($recipe->recipe_source, FILTER_VALIDATE_URL))
                    <a class="source-link" href=" {{$recipe->recipe_source}}" target="_blank">Original Recipe</a>
                @else
                    {{$recipe->recipe_source}}
                @endif
            </div>
        </div>
    </div>

@endsection

@section('footer')
    <script src="{{ asset('js/ratings.js') }}"></script>
@endsection
