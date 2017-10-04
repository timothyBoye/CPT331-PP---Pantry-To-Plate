@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div  class="col-md-3 " >
            {{--<button class="btn btn-primary btn-mini bootstro-next-btn">Next »</button>--}}
            <div class="filter-container">
                @if (Auth::user())
                    <label class="checkbox-inline">
                        <input type="checkbox" id="cuisine-preference-checkbox">Cuisine
                    </label>
                @endif
                <label class="checkbox-inline">
                    <input type="checkbox">Star Rating
                </label>

                <div id= "ingredient-selection-menu" class="bootstro" data-bootstro-title="Filter your matched recipes" data-bootstro-content="Select a cuisine type or a star rating to narrow down your search" data-bootstro-step="3" data-bootstro-placement ="right" data-bootstro-nextButtonText="Next">

                <div class="li-category dropdown">
                    <!--<button class="btn btn-default dropdown-toggle dropdown-buttons" type="button" data-toggle="dropdown">CUISINE TYPE<span class="caret caret-right"></span></button>-->
                        <select id='select-cuisine-type-filter' class="select-cuisine-type-filter">
                            <option value="-1">Filter by Cuisine Type</option>
                        @foreach($cuisine as $cuisineType)
                            <option value="{{$cuisineType->id}}">{{$cuisineType->name}}</option>
                        @endforeach
                        </select>
                </div>
                </div>
            </div>
            <div class="bootstro" data-bootstro-title="Ingredient Selector" data-bootstro-content="Select your ingredients from the dropdown categories" data-bootstro-step="0" data-bootstro-placement ="right" data-bootstro-nextButtonText="Next">
            @foreach($categories as $category)
                <div class="li-category dropdown" data-id="{{$category->id}}">
                    <button class="btn btn-default dropdown-toggle dropdown-buttons" type="button" data-toggle="dropdown">{{$category->name}}&nbsp;&nbsp;<span class="caret caret-right"></span></button>
                    <ul class="dropdown-menu drop-down-full-width">
                        @foreach($category->recipeIngredients as $ingredient)
                            {{--<h1>"keh:" {{$ingredient->ingredient_image_url}}</h1>--}}
                            <li class="li-ingredient" role="presentation"><a href="#" data-image="{{ $ingredient->ingredient_image_url == '' ? 'default.jpg' : $ingredient->ingredient_image_url }}" data-id="{{$ingredient->id}}" data-name="{{$ingredient->name}}">{{$ingredient->name}}</a></li>
                        @endforeach
                    </ul>
                </div>
            @endforeach
            </div>
        </div>
        <div class="col-md-9 home-recipe-container">
            <div class="selected-ingredients-anchor bootstro" data-api-controller-url="{{URL::route('result')}}" data-bootstro-title="Selected Ingredients" data-bootstro-html="true" data-bootstro-content="Your selected ingredients <img class ='bootstro-ingredient-img' src='../public/img/tomato.png'/> will appear here, you can remove them by clicking on the X." data-bootstro-step="1" data-bootstro-placement ="bottom" data-bootstro-nextButtonText="Next">
                <ul class="clearable"></ul>
            </div>
            <div class="clearable" id="recipes"></div>
            <div class="bootstro overlay" data-bootstro-title="Selected Ingredients" data-bootstro-html="true" data-bootstro-content="All of your matched recipes will appear here. <img class ='bootstro-recipe-img' src='../public/img/result-recipe.png'/><img class = 'match-show-count' src='../public/img/match-show-count.png'/> Indicates how many of your selected ingredients match the total ingredients needed for the recipe" data-bootstro-step="2" data-bootstro-placement ="bottom" data-bootstro-nextButtonText="Next"></div>

            <div class ="intro-message">
                <div class="intro-header"><p class="intro-heading"> Get Started</p></div>
                <div class ="into-text"> Start by selecting an ingredient from the dropdowns on the left.</div>
                <a class="btn btn-large btn-success tour-button" href="#" id="demo">First time here? Take a tour</a>
            </div>
        </div>
    </div>
</div>
@endsection

@section('footer')
    <script src="{{ asset('js/ingredientsController.js') }}"></script>
@endsection
