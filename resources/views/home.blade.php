@extends('layouts.app')

@section('content')
<div class="container-fluid content">
    <div class="row">
        <div  class="col-md-3 " >
            {{--<button class="btn btn-primary btn-mini bootstro-next-btn">Next »</button>--}}
            <!-- Filter section -->
            <div class="filter-container">
                <!-- Display cuisine preferences option for registered users -->
                @if (Auth::user())
                    <div class="checkbox-block-div">
                        <input type="checkbox" id="cuisine-preference-checkbox" class="icheck-field" name="cuisine-preference-checkbox">
                        <label for="cuisine-preference-checkbox">Apply my cuisine preferences</label>
                    </div>
                @endif
                <div id= "ingredient-selection-menu" class="bootstro" data-bootstro-title="Filter your matched recipes" data-bootstro-content="Select a cuisine type or a star rating to narrow down your search" data-bootstro-step="3" data-bootstro-placement ="auto" data-bootstro-nextButtonText="Next">
                    {{--<label class="checkbox-inline">--}}
                         {{--<input type="checkbox">STAR RATING--}}
                    {{--</label>--}}
                    <!-- Cuisine type filter -->
                    <div class="li-category dropdown">
                    <!--<button class="btn btn-default dropdown-toggle dropdown-buttons" type="button" data-toggle="dropdown">CUISINE TYPE<span class="caret caret-right"></span></button>-->
                        <select id='select-cuisine-type-filter' class = "cuisine-dropdown">
                            <option class = "cuisine-title-value" value="0" selected>Filter by Cuisine Type</option>
                        @foreach($cuisine as $cuisineType)
                            <option value="{{$cuisineType->id}}">{{$cuisineType->name}}</option>
                        @endforeach
                        </select>
                    </div>
                    <!-- Star rating filter -->
                    <div class="li-category dropdown">
                        <select id='select-rating-type-filter' class = "cuisine-dropdown">
                            <option class = "cuisine-title-value" value="0" selected>Filter by Recipe Rating</option>
                            @for($i = 1; $i < 6; $i++)
                                <option class="cuisine-title-value" value="{{$i}}">{{$i}}
                                    @if($i == 5)
                                        Stars Only
                                    @elseif($i == 1)
                                        Star Or Better
                                    @else
                                        Stars Or Better
                                    @endif
                                </option>
                            @endfor
                        </select>
                    </div>
                    <!-- Total ingredients in recipe filter -->
                    <div class="li-category dropdown">
                        <select id='select-ingredient_filter_value' class = "cuisine-dropdown">
                            <option class = "cuisine-title-value" value="0" selected>Filter by Total Ingredients</option>
                            @for($i = 1; $i < 11; $i++)
                                <option class="cuisine-title-value" value="{{$i}}">{{$i}}
                                    @if($i < 10)
                                        Ingredient only
                                    {{--@elseif($i < 10)--}}
                                        {{--Ingredients only--}}
                                    @else
                                        Ingredients Or More
                                    @endif
                                </option>
                            @endfor
                        </select>
                    </div>
                    <!-- Number of ingredients to buy filter -->
                    <div class="li-category dropdown">
                        <select id='select-ingredients_needed_filter_value' class = "cuisine-dropdown">
                            <option class = "cuisine-title-value" value="0" selected>Filter by Ingredients Needed</option>
                            @for($i = 2; $i < 11; $i+=2)
                                <option class="cuisine-title-value" value="{{$i}}">{{$i}} Ingredients Or Less Needed</option>
                            @endfor
                        </select>
                    </div>
                </div>
            </div>
            <!-- Ingredients selection section -->
            <div class="bootstro all-dropdowns" data-bootstro-title="Ingredient Selector" data-bootstro-content="Select your ingredients from the dropdown categories" data-bootstro-step="0" data-bootstro-placement ="auto" data-bootstro-nextButtonText="Next">
                <!-- Search box -->
                <div id="ingredient-search-group" class="input-group">
                    <input list="ingredients-list" type="text" class="form-control" name="ingredient-input" id="ingredient-input" placeholder="Search by ingredient name...">
                    <datalist id="ingredients-list">
                        @foreach($categories as $category)
                            @foreach($category->recipeIngredients as $ingredient)
                                <option value="{{$ingredient->name}}">
                            @endforeach
                        @endforeach
                    </datalist>
                    <span class="input-group-btn">
                     <button class="btn btn-success btn-flat search-button" id="ingredient-search-button">
                        Go
                    </button>
                    </span>
                </div>
                <p id="search-validation">
                </p>
            <!-- Ingredient category dropdowns -->
            @foreach($categories as $category)
                <div class="li-category dropdown" data-id="{{$category->id}}">
                    <button class="btn btn-default dropdown-toggle dropdown-buttons" type="button" data-toggle="dropdown">{{$category->name}}&nbsp;&nbsp;<span class="caret caret-right"></span></button>
                    <ul class="dropdown-menu drop-down-full-width">
                        @foreach($category->recipeIngredients as $ingredient)
                            {{--<h1>"keh:" {{$ingredient->ingredient_image_url}}</h1>--}}
                            <li class="li-ingredient" role="presentation"><a href="#" data-image="{{ $ingredient->image_name() }}" data-id="{{$ingredient->id}}" data-name="{{$ingredient->name}}">{{ucfirst($ingredient->name)}}</a></li>
                        @endforeach
                    </ul>

                </div>
            @endforeach
            </div>
        </div>
        <!-- Selected ingredients panel -->
        <div class="col-md-9 home-recipe-container">
            <div class="selected-ingredients-anchor bootstro" data-api-controller-url="{{URL::route('result')}}" data-bootstro-title="Selected Ingredients" data-bootstro-html="true" data-bootstro-content="Your selected ingredients <img class ='bootstro-ingredient-img' src='{{ asset('/img/tomato.png') }}'/> will appear here, you can remove them by clicking on the  <b class = red>X</b>" data-bootstro-step="1" data-bootstro-placement ="bottom" data-bootstro-nextButtonText="Next">
                <ul class="clearable"></ul>
            </div>
            <div><button class="btn btn-alert clear-all-ingredients-btn">Clear All Selected Ingredients <span class="glyphicon glyphicon-erase"></span></button></div>
            <div class="">
{{--                <img src="{{ URL::asset('img/left-chevron-gr.png') }}" class="prev" alt="Previous">--}}
                <div class="">
                    <!-- Display recipe cards for matched recipes-->
                    <div class="clearable" id="recipes">
                    </div>
                </div>
{{--                <img src="{{ URL::asset('img/right-chevron-gr.png') }}" class="next" alt="Next">--}}
            </div>
            <div class="bootstro overlay" data-bootstro-title="Selected Ingredients" data-bootstro-html="true" data-bootstro-content="All of your matched recipes will appear here. <img class ='bootstro-recipe-img' src='{{ asset('/img/result-recipe.png') }}'/><img class = 'match-show-count' src='{{ asset('/img/match-show-count.png') }}'/> Indicates how many of your selected ingredients match the total ingredients needed for the recipe" data-bootstro-step="2" data-bootstro-placement ="bottom" data-bootstro-nextButtonText="Next"></div>
            <!-- Get started instructions -->
            <div class ="intro-message">
                <div class="intro-header"><h4 class="intro-heading">Get Started</h4></div>
                <div class ="into-text"> Start by selecting an ingredient from the drop down category menu.</div>
                <a class="btn btn-large btn-success tour-button" href="#" id="demo">First time here? Take a tour</a>
            </div>
        </div>
    </div>
</div>
@endsection

@section('footer')
    <script src="{{ asset('js/ingredientsController.js') }}"></script>
@endsection
