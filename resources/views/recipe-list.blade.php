{{--DO NOT ADD ANY CODE OUTSIDE THE LOOP UNLESS YOU KNOW WHAT YOU"RE DOING--}}
{{--This file is called to create each page of data not just once so any code outside the loop likely should be on the home page not here--}}
@foreach($recipes as $recipe)
    {{--<div class="item{{ $rkey == 0 ? ' active' : '' }}">--}}
        <div class="col-lg-4 col-md-6 col-sm-12 recipes-matched-search">
            <div class="recipe-container">
                <!-- Save recipe option -->
                <div class="save-recipe-div" data-recipe-id="{{$recipe->id}}" data-delete-recipe-url="{{ Route('profile.delete_recipe') }}" data-save-recipe-url="{{Route('profile.save_recipe')}}">
                    @if(Auth::User())
                        @if(!\App\RecipeUserMapping::has_saved_recipe($recipe->id))
                            <button id="saved-btn-{{$recipe->id}}" class="save-recipe-btn btn btn-success" data-recipe-id="{{$recipe->id}}" data-id="{{$recipe->id}}">Save</button>
                        @else
                            <button id="saved-btn-{{$recipe->id}}" class="save-recipe-btn btn btn-success disabled" data-recipe-id="{{$recipe->id}}" data-id="{{$recipe->id}}">Saved</button>
                        @endif
                    @endif
                </div>
                <!-- Display cuisine type ribbon on recipe card -->
                @if($recipe->cuisine_type)
                    <div class="cuisine-ribbon-container">
                        <div class="cuisine-ribbon {{ $recipe->cuisine_type->name }}">{{ $recipe->cuisine_type->name }}</div>
                    </div>
                @endif
                <!-- Display number of matched ingredients -->
                <div class="ingredient-match" >
                    @foreach($occurrences as $key => $val)
                        @if($key == $recipe->id)
                            <h5 class="ingredients-match-number">{{$val}}</h5>
                            <p class="ingredients-match-word">INGREDIENT</p>
                            <p class="ingredients-match-word">MATCH</p>
                        @endif
                    @endforeach
                </div>
                <!-- Make recipe card a link -->
                <a href="{{ route('recipe', $recipe->id) }}" class="recipe-link">
                    <div class="recipe-image" style="background-image: url({{ URL::asset('img/recipes/'.$recipe->image_name()) }});">
                    </div>

                    <h4 class="recipe-name">{{ $recipe->name }}</h4>
                    @foreach($occurrences as $key => $val)
                        @if($key == $recipe->id)
                            <h5>{{count($recipe->ingredients)}} Ingredient Recipe</h5>
                        @endif
                    @endforeach
                </a>
                <div class="recipe-text">
                    <!-- Display recipe rating on card -->
                    <div style="margin:auto auto">
                        @php($rating = false)

                        @foreach($userRatings as $userRating)
                            @if($userRating->recipe_id == $recipe->id)
                                @php($rating = $userRating)
                            @endif
                        @endforeach

                        @php ($ratingValue = $rating ? $rating->rating : round($recipe->average_rating))
                        <fieldset class="rating {{ $rating ? 'rated' : '' }}" id="rating-{{$recipe->id}}" >
                            <input type="radio" id="star5-{{$recipe->id}}" name="rating-{{$recipe->id}}" value="5" {{ $ratingValue == 5 ? 'checked' : '' }} disabled/><label for="star5-{{$recipe->id}}" title="5 stars"></label>
                            <input type="radio" id="star4-{{$recipe->id}}" name="rating-{{$recipe->id}}" value="4" {{ $ratingValue == 4 ? 'checked' : '' }} disabled/><label for="star4-{{$recipe->id}}" title="4 stars"></label>
                            <input type="radio" id="star3-{{$recipe->id}}" name="rating-{{$recipe->id}}" value="3" {{ $ratingValue == 3 ? 'checked' : '' }} disabled/><label for="star3-{{$recipe->id}}" title="3 stars"></label>
                            <input type="radio" id="star2-{{$recipe->id}}" name="rating-{{$recipe->id}}" value="2" {{ $ratingValue == 2 ? 'checked' : '' }} disabled/><label for="star2-{{$recipe->id}}" title="2 stars"></label>
                            <input type="radio" id="star1-{{$recipe->id}}" name="rating-{{$recipe->id}}" value="1" {{ $ratingValue == 1 ? 'checked' : '' }} disabled/><label for="star1-{{$recipe->id}}" title="1 star"></label>
                        </fieldset>
                    </div>
                    <!-- Display recipe description on card -->
                    <div style="clear:both;">
                        <q>{{ $recipe->short_description }}</q>
                    </div>
                </div>
            </div>
            {{--<div class="slider-recipe-count">--}}
                {{--{{array_search($recipe, $recipes) + 1}} / {{count($recipes)}}--}}
            {{--</div>--}}
        </div>
    </div>
@endforeach
<script src="{{ asset('js/saveRecipeController.js') }}"></script>