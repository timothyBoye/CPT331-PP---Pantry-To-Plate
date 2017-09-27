@foreach($recipes as $recipe)
    <div class="col-lg-3 col-md-6 col-sm-12">
        <div class="recipe-container">
            <a href="{{ route('recipe', $recipe->id) }}">
                <div class="recipe-image">
                </div>
                <h4>{{ $recipe->name }}</h4>
            </a>
            <div class="recipe-text">
                <fieldset class="rating">
                    <strong>Rated:</strong>
                    <input type="radio" id="star5-{{$recipe->id}}" name="rating-{{$recipe->id}}" value="5" {{ round($recipe->average_rating) == 5 ? 'checked' : '' }} disabled/><label for="star5-{{$recipe->id}}" title="Rocks!">5 stars</label>
                    <input type="radio" id="star4-{{$recipe->id}}" name="rating-{{$recipe->id}}" value="4" {{ round($recipe->average_rating) == 4 ? 'checked' : '' }} disabled/><label for="star4-{{$recipe->id}}" title="Pretty good">4 stars</label>
                    <input type="radio" id="star3-{{$recipe->id}}" name="rating-{{$recipe->id}}" value="3" {{ round($recipe->average_rating) == 3 ? 'checked' : '' }} disabled/><label for="star3-{{$recipe->id}}" title="Meh">3 stars</label>
                    <input type="radio" id="star2-{{$recipe->id}}" name="rating-{{$recipe->id}}" value="2" {{ round($recipe->average_rating) == 2 ? 'checked' : '' }} disabled/><label for="star2-{{$recipe->id}}" title="Kinda bad">2 stars</label>
                    <input type="radio" id="star1-{{$recipe->id}}" name="rating-{{$recipe->id}}" value="1" {{ round($recipe->average_rating) == 1 ? 'checked' : '' }} disabled/><label for="star1-{{$recipe->id}}" title="Sucks big time">1 star</label>
                </fieldset>
                <q>{{ $recipe->short_description }}</q>
            </div>
        </div>
    </div>
@endforeach