@foreach($recipes as $recipe)
    <div class="col-lg-3 col-md-6 col-sm-12">
        <div class="recipe-container">
            <div class="ingredient-match" >
                {{--@foreach($recipe_id as $recipe_id_counted)--}}
                    {{--<h1>{{ $recipe_id_counted }}</h1>--}}
                {{--@endforeach--}}
                {{--<h1><{{$recipe->pooptest}}/h1>--}}
                {{--<h2>{{count($recipe->ingredients)}}</h2>--}}
                {{--@foreach($recipe->ingredients as $ingredient)--}}
                    {{--<p>{{ $ingredient->ingredient->name }}</p>--}}

                {{--@endforeach--}}
                @foreach($occurrences as $key => $val)
                    @if($key == $recipe->id)
                        <h4>{{$val}} / {{count($recipe->ingredients)}}</h4>
                    @endif


                @endforeach

            </div>
            <a href="{{ route('recipe', $recipe->id) }}" class="recipe-link">
                <div class="recipe-image">
                </div>
                <h4 class="recipe-name">{{ $recipe->name }}</h4>
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
            </div>
        </div>
    </div>
@endforeach