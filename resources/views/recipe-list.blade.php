<div class="slider-outer">
    <img src="{{ URL::asset('img/left-chevron-gr.png') }}" class="prev" alt="Previous">
    <div class="slider-inner">
        @foreach($recipes as $rkey => $recipe)
            <div class="item{{ $rkey == 0 ? ' active' : '' }}">
                <div class="col-lg-4 col-md-6 col-sm-12 recipes-matched-search">
                    <div class="recipe-container">
                        @if($recipe->cuisine_type)
                            <div class="cuisine-ribbon-container">
                                <div class="cuisine-ribbon {{ $recipe->cuisine_type->name }}">{{ $recipe->cuisine_type->name }}</div>
                            </div>
                        @endif
                        <div class="ingredient-match" >
                            @foreach($occurrences as $key => $val)
                                @if($key == $recipe->id)
                                    <h5 class="ingredients-match-number">{{$val}}</h5>
                                    <p class="ingredients-match-word">INGREDIENT</p>
                                    <p class="ingredients-match-word">MATCH</p>
                                @endif
                            @endforeach
                        </div>
                        <a href="{{ route('recipe', $recipe->id) }}" class="recipe-link">
                            <div class="recipe-image" style="background-image: url({{ URL::asset('img/recipes/'.($recipe->image_url == '' ? 'default.jpg' : $recipe->image_url)) }});">
                            </div>
                            <h4 class="recipe-name">{{ $recipe->name }}</h4>
                            @foreach($occurrences as $key => $val)
                                @if($key == $recipe->id)
                                    <h5>{{count($recipe->ingredients)}} Ingredient Recipe</h5>
                                @endif
                            @endforeach
                        </a>
                        <div class="recipe-text">

                            <div style="margin:auto auto">
                                @php($rating = false)

                                @foreach($userRatings as $userRating)
                                    @if($userRating->recipe_id == $recipe->id)
                                        @php($rating = $userRating)
                                    @endif
                                @endforeach

                                @php ($ratingValue = $rating ? $rating->rating : round($recipe->average_rating))
                                <fieldset class="rating {{ $rating ? 'rated' : '' }}" id="rating-{{$recipe->id}}" >
                                    <input type="radio" id="star5-{{$recipe->id}}" name="rating-{{$recipe->id}}" value="5" {{ $ratingValue == 5 ? 'checked' : '' }} disabled/><label for="star5-{{$recipe->id}}" title="Rocks!">5 stars</label>
                                    <input type="radio" id="star4-{{$recipe->id}}" name="rating-{{$recipe->id}}" value="4" {{ $ratingValue == 4 ? 'checked' : '' }} disabled/><label for="star4-{{$recipe->id}}" title="Pretty good">4 stars</label>
                                    <input type="radio" id="star3-{{$recipe->id}}" name="rating-{{$recipe->id}}" value="3" {{ $ratingValue == 3 ? 'checked' : '' }} disabled/><label for="star3-{{$recipe->id}}" title="Meh">3 stars</label>
                                    <input type="radio" id="star2-{{$recipe->id}}" name="rating-{{$recipe->id}}" value="2" {{ $ratingValue == 2 ? 'checked' : '' }} disabled/><label for="star2-{{$recipe->id}}" title="Kinda bad">2 stars</label>
                                    <input type="radio" id="star1-{{$recipe->id}}" name="rating-{{$recipe->id}}" value="1" {{ $ratingValue == 1 ? 'checked' : '' }} disabled/><label for="star1-{{$recipe->id}}" title="Sucks big time">1 star</label>
                                </fieldset>
                            </div>
                            <div style="clear:both;">
                                <q>{{ $recipe->short_description }}</q>
                            </div>
                            <div id="save-recipe-div" data-save-recipe-url="{{Route('profile.save_recipe')}}">
                                @if(Auth::User())
                                    @if(!\App\RecipeUserMapping::has_saved_recipe($recipe->id))
                                        <button id="saved-btn-{{$recipe->id}}" class="save-recipe-btn btn btn-success" data-id="{{$recipe->id}}">Save Recipe</button>
                                    @else
                                        <label>Saved</label>
                                    @endif
                                    <!-- Style coloured label-->
                                    <label id="saved-label-{{$recipe->id}}" class="invisible">Saved</label>


                                    @endif
                            </divid>
                        </div>
                    </div>
                    <div class="slider-recipe-count">
                        {{array_search($recipe, $recipes) + 1}} / {{count($recipes)}}
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <img src="{{ URL::asset('img/right-chevron-gr.png') }}" class="next" alt="Next">
</div>

<!-- Scripts -->
<script src="{{ asset('js/slider.js') }}"></script>
<!--Hammer library used to implement swipe functionality on touch screens -->
<script src="{{ asset('js/hammer.min.js') }}"></script>
<script src="{{ asset('js/saveRecipeController.js') }}"></script>