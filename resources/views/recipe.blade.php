@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6 each-img-container margin-top">
                <div class="row first-row">
                    <div class="each-recipe-result-img" style="background-image: url({{ URL::asset('img/recipes/'.($recipe->image_url == '' ? 'default.jpg' : $recipe->image_url)) }});">

                        <div class = "recipe-onfo-each">
                            <div class="star-desc-name">
                            <h2>{{ $recipe->name }}</h2>
                            <strong>Rated:</strong>
                            <fieldset class="inline-block rating {{Auth::check() ? 'rating-editable' : ''}} {{ $userRating ? 'rated' : '' }}"  id="rating-{{$recipe->id}}" >
                                @php ($rating = $userRating ? $userRating->rating : round($recipe->average_rating))
                                <input type="radio" id="star5-{{$recipe->id}}" name="rating-{{$recipe->id}}" value="5" {{Auth::check() ? 'onclick=makeRatingCall('.$recipe->id.',"'.URL::route('setRating').'");' : ''}} {{ $rating == 5 ? 'checked' : '' }} {{Auth::check() ? '' : 'disabled'}}/><label style="font-size: 200%;" for="star5-{{$recipe->id}}" title="Rocks!"></label>
                                <input type="radio" id="star4-{{$recipe->id}}" name="rating-{{$recipe->id}}" value="4" {{Auth::check() ? 'onclick=makeRatingCall('.$recipe->id.',"'.URL::route('setRating').'");' : ''}} {{ $rating == 4 ? 'checked' : '' }} {{Auth::check() ? '' : 'disabled'}}/><label style="font-size: 200%;" for="star4-{{$recipe->id}}" title="Pretty good"></label>
                                <input type="radio" id="star3-{{$recipe->id}}" name="rating-{{$recipe->id}}" value="3" {{Auth::check() ? 'onclick=makeRatingCall('.$recipe->id.',"'.URL::route('setRating').'");' : ''}} {{ $rating == 3 ? 'checked' : '' }} {{Auth::check() ? '' : 'disabled'}}/><label style="font-size: 200%;" for="star3-{{$recipe->id}}" title="Meh"></label>
                                <input type="radio" id="star2-{{$recipe->id}}" name="rating-{{$recipe->id}}" value="2" {{Auth::check() ? 'onclick=makeRatingCall('.$recipe->id.',"'.URL::route('setRating').'");' : ''}} {{ $rating == 2 ? 'checked' : '' }} {{Auth::check() ? '' : 'disabled'}}/><label style="font-size: 200%;" for="star2-{{$recipe->id}}" title="Kinda bad"></label>
                                <input type="radio" id="star1-{{$recipe->id}}" name="rating-{{$recipe->id}}" value="1" {{Auth::check() ? 'onclick=makeRatingCall('.$recipe->id.',"'.URL::route('setRating').'");' : ''}} {{ $rating == 1 ? 'checked' : '' }} {{Auth::check() ? '' : 'disabled'}}/><label style="font-size: 200%;" for="star1-{{$recipe->id}}" title="Sucks big time"></label>
                            </fieldset>
                            <span id="rated-by-who">
                                @if ($userRating)
                                    your rating
                                @else
                                    by {{ $recipe->number_of_ratings }} users <br>
                                @endif
                                <q>{{ $recipe->long_description }}</q>
                                </span>
                                </div>
                                <div class = "recipe-info-opacity"></div>

                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="col-md-12 text-center">
                        <h2>Ingredients</h2>
                        <div id="recipe-ingredients">
                            <ul class="unordered-list">
                                @foreach($recipe->ingredients as $ingredient)
                                    <div class="col-md-3 separate-ingredients">

                                        <li class = "list-item">
                                            <div class = "somedivs">

                                            {!! \App\Utilities::approximatedFractionString($ingredient->quantity) !!}

                                            @if(($ingredient->quantity > 1) && ($ingredient->measure->name != ''))
                                                {{ $ingredient->measure->name }}s
                                            @else
                                                {{ $ingredient->measure->name }}
                                            @endif
                                            {{ $ingredient->ingredient->name }}


                                        @if($ingredient->description), {{ $ingredient->description }}@endif
                                            </div>

                                            <img class="ingredient-recipe-page-img" src="{{ URL::asset('img/ingredients/'.$ingredient->ingredient->image_name()) }}">
                                        </li>
                                    </div>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class = "nutritional-box">
                            @if($recipe->nutritional_info_panel)
                                @include('partials.nutritionalInfoPanel', ['nutritional_info_panel' => $recipe->nutritional_info_panel])
                            @endif
                        </div>
                    </div>
                </div>
            </div>




            <div class="col-md-6 margin-top">
                <div class = "row text-center">
                    <div class="col-md-3">
                        <img class ='serves' src='{{ asset('/img/serve.png') }}'/>
                        {{ $recipe->serving_size }} servings
                    </div>
                    <div class="col-md-3">
                        <img class ='world' src='{{ asset('/img/world.png') }}'/>
                    @if($recipe->cuisine_type)
                            {{ $recipe->cuisine_type->name }}
                        @endif
                    </div>
                    <div class="col-md-3">
                        <img class ='recipe-icon' src='{{ asset('/img/recipe.png') }}'/>
                        @if(filter_var($recipe->recipe_source, FILTER_VALIDATE_URL))
                            <a class="source-link" href=" {{$recipe->recipe_source}}" target="_blank">Original Recipe</a>
                        @else
                            {{$recipe->recipe_source}}
                        @endif
                    </div>
                    <div class="col-md-3">
                        {{--SAVE RECIPE BUTTON--}}
                    </div>
                </div>
                <div class="col-md-12 swipe-container-mob">
                    <div class="row text-center-method">
                        <h2>Method</h2>
                        <div id="recipe-method">
                          <ul class = "recipe-steps-description">
                              <div class="slider-outer step-slider-outer">
                                  <img src="{{ URL::asset('img/left-chevron-gr.png') }}" class="prev prev-step" alt="Previous">
                                  <div class="slider-inner step-slider-inner">
                                @foreach($recipe->method_steps as $key=>$step)
                                    <div class = "step-node item{{ $key == 0 ? ' active' : '' }}">
                                        <div class = "step-number">{{$step->step_number}}</div>
                                        <img class ="step-img" src ="{{ URL::asset('img/'.($step->image_url)) }}">
                                        <div class = "steps-list">
                                            <li class = "horizontal method-description-text-box">{{$step->description}}</li>
                                        </div>
                                    </div>
                                @endforeach
                                    </div>
                                <img src="{{ URL::asset('img/right-chevron-gr.png') }}" class="next next-step" alt="Next">
                            </div>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer')
    <script src="{{ asset('js/ratings.js') }}"></script>
    <script src="{{ asset('js/slider.js') }}"></script>
    <!--Hammer library used to implement swipe functionality on touch screens -->
    <script src="{{ asset('js/hammer.min.js') }}"></script>
@endsection
