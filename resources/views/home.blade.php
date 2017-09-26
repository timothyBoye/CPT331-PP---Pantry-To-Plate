@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-3">
            @if (Auth::user())
            <div class="filter-container">
                <form>
                    <label class="checkbox-inline">
                        <input type="checkbox" value="">Star Rating
                    </label>
                    <label class="checkbox-inline">
                        <input type="checkbox" value="">Cuisine
                    </label>
                </form>

                <div class="li-category dropdown">
                    <button class="btn btn-default dropdown-toggle dropdown-buttons" type="button" data-toggle="dropdown">CUISINE TYPE<span class="caret caret-right"></span></button>
                        <ul class="dropdown-menu drop-down-full-width">
                        @foreach($cuisine as $cuisineType)
                            <li class="li-ingredient" role="presentation"><a href="#" data-id="{{$cuisineType->id}}" data-name="{{$cuisineType->name}}">{{$cuisineType->name}}</a></li>
                        @endforeach
                        </ul>
                </div>
            </div>
            @endif
            @foreach($categories as $category)
                <div class="li-category dropdown" data-id="{{$category->id}}">
                    <button class="btn btn-default dropdown-toggle dropdown-buttons" type="button" data-toggle="dropdown">{{$category->name}}&nbsp;&nbsp;<span class="caret caret-right"></span></button>
                    <ul class="dropdown-menu drop-down-full-width">
                        @foreach($category->recipeIngredients as $ingredient)
                            <li class="li-ingredient" role="presentation"><a href="#" data-id="{{$ingredient->id}}" data-name="{{$ingredient->name}}">{{$ingredient->name}}</a></li>
                        @endforeach
                    </ul>
                </div>
            @endforeach
        </div>
        {{--<div class="col-md-9">--}}
            {{--<div class="selected-ingredients-anchor row" data-api-controller-url="{{URL::route('result')}}">--}}
                {{--<ul class="clearable"></ul>--}}
            {{--</div>--}}
        {{--</div>--}}
        <div class="col-md-9 home-recipe-container">
            <div class = "selected-ingredients-anchor" data-api-controller-url="{{URL::route('result')}}">
                <ul class = "clearable"></ul>
            </div>
            <div class="clearable" id="recipes"></div>
        </div>

    </div>
</div>
@endsection
