@foreach($recipes as $recipe)
    <div class="col-lg-3 col-md-6 col-sm-12">
        <div class="recipe-container">
            <a href="{{ route('recipe', $recipe->id) }}">
                <div class="recipe-image">
                </div>
                <h4>{{ $recipe->name }}</h4>
            </a>
            <div class="recipe-text">
                @if($recipe->average_rating)
                    <div class="rating">
                    @for($i = 0; $i < round($recipe->average_rating); $i++)
                        <span>★</span>
                    @endfor
                    @for($i = 0; $i < (5 - round($recipe->average_rating)); $i++)
                        <span>☆</span>
                    @endfor
                    </div>
                @else
                    <div class="rating">
                    @for($i = 0; $i < (5); $i++)
                        <span>☆</span>
                    @endfor
                    </div>
                @endif
                <q>{{ $recipe->short_description }}</q>
            </div>
        </div>
    </div>
@endforeach