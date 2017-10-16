@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6 each-img-container margin-top">
                <div class="row first-row">
                    <div class="each-recipe-result-img" style="background-image: url({{ URL::asset('img/recipes/'.$recipe->image_name()) }});">

                        <div class="save-recipe-div" class = "button-for-saving" data-delete-recipe-url="{{ Route('profile.delete_recipe') }}" data-save-recipe-url="{{Route('profile.save_recipe')}}">
                            @if(Auth::User())
                                @if(!\App\RecipeUserMapping::has_saved_recipe($recipe->id))
                                    <button id="saved-btn-{{$recipe->id}}" class="save-recipe-btn btn btn-success" data-recipe-id="{{$recipe->id}}" data-id="{{$recipe->id}}">Save</button>
                                @else
                                    <button id="saved-btn-{{$recipe->id}}" class="save-recipe-btn btn btn-success disabled" data-recipe-id="{{$recipe->id}}" data-id="{{$recipe->id}}">Saved</button>
                                @endif
                            <!-- Style coloured label-->
                                <label id="saved-label-{{$recipe->id}}" class="invisible">Saved</label>
                            @endif
                        </div>
                        <div class = "recipe-onfo-each">
                            <div class="star-desc-name">
                            <h2>{{ $recipe->name }}</h2>
                            {{--<strong>RATED:</strong>--}}
                            <fieldset class="inline-block rating {{Auth::check() ? 'rating-editable' : ''}} {{ $userRating ? 'rated' : '' }} recipe-page-rating"  id="rating-{{$recipe->id}}" >
                                @php ($rating = $userRating ? $userRating->rating : round($recipe->average_rating))
                                <input type="radio" id="star5-{{$recipe->id}}" name="rating-{{$recipe->id}}" value="5" {{Auth::check() ? 'onclick=makeRatingCall('.$recipe->id.',"'.URL::route('setRating').'");' : ''}} {{ $rating == 5 ? 'checked' : '' }} {{Auth::check() ? '' : 'disabled'}}/><label for="star5-{{$recipe->id}}" title="5 star"></label>
                                <input type="radio" id="star4-{{$recipe->id}}" name="rating-{{$recipe->id}}" value="4" {{Auth::check() ? 'onclick=makeRatingCall('.$recipe->id.',"'.URL::route('setRating').'");' : ''}} {{ $rating == 4 ? 'checked' : '' }} {{Auth::check() ? '' : 'disabled'}}/><label for="star4-{{$recipe->id}}" title="4 star"></label>
                                <input type="radio" id="star3-{{$recipe->id}}" name="rating-{{$recipe->id}}" value="3" {{Auth::check() ? 'onclick=makeRatingCall('.$recipe->id.',"'.URL::route('setRating').'");' : ''}} {{ $rating == 3 ? 'checked' : '' }} {{Auth::check() ? '' : 'disabled'}}/><label for="star3-{{$recipe->id}}" title="3 star"></label>
                                <input type="radio" id="star2-{{$recipe->id}}" name="rating-{{$recipe->id}}" value="2" {{Auth::check() ? 'onclick=makeRatingCall('.$recipe->id.',"'.URL::route('setRating').'");' : ''}} {{ $rating == 2 ? 'checked' : '' }} {{Auth::check() ? '' : 'disabled'}}/><label for="star2-{{$recipe->id}}" title="2 star"></label>
                                <input type="radio" id="star1-{{$recipe->id}}" name="rating-{{$recipe->id}}" value="1" {{Auth::check() ? 'onclick=makeRatingCall('.$recipe->id.',"'.URL::route('setRating').'");' : ''}} {{ $rating == 1 ? 'checked' : '' }} {{Auth::check() ? '' : 'disabled'}}/><label for="star1-{{$recipe->id}}" title="1 star"></label>
                            </fieldset>
                            {{--<span id="rated-by-who">--}}
                                {{--@if ($userRating)--}}
                                    {{--your rating--}}
                                {{--@else--}}
                                    {{--by {{ $recipe->number_of_ratings }} users <br>--}}
                                {{--@endif--}}
                                {{--</span>--}}
                                <br><q>{{ $recipe->long_description }}</q>
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
                                            <img class="ingredient-recipe-page-img" src="{{ URL::asset('img/ingredients/'.$ingredient->ingredient->image_name()) }}">

                                            <div class = "somedivs right">

                                            {!! \App\Utilities::approximatedFractionString($ingredient->quantity) !!}

                                            @if(($ingredient->quantity > 1) && ($ingredient->measure->name != ''))
                                                {{ $ingredient->measure->name }}s
                                            @else
                                                {{ $ingredient->measure->name }}
                                            @endif
                                            {{ $ingredient->ingredient_name() }}@if($ingredient->description), {{ $ingredient->description }}@endif
                                            </div>
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




            <div class="col-md-6 margin-top-icons">
                <div class = "row text-center four-icons-mob">
                    <div class="col-md-4 move-over">
                        <img class ='serves' src='{{ asset('/img/serve.png') }}'/><br>
                        {{ $recipe->serving_size }} servings
                    </div>
                    <div class="col-md-4">
                        <img class ='world' src='{{ asset('/img/world.png') }}'/><br>
                    @if($recipe->cuisine_type)
                            {{ $recipe->cuisine_type->name }}
                        @endif
                    </div>
                    <div class="col-md-4">
                        <img class ='recipe-icon' src='{{ asset('/img/recipe.png') }}'/> <br>
                        @if(filter_var($recipe->recipe_source, FILTER_VALIDATE_URL))
                            <a class="source-link" href=" {{$recipe->recipe_source}}" target="_blank">Original Recipe</a>
                        @else
                            {{$recipe->recipe_source}}
                        @endif
                    </div>
                </div>
                <div class="col-md-12 swipe-container-mob">
                    <div class="row text-center-method text-center">
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
