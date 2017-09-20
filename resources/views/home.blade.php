@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-3">
            @foreach($categories as $category)
                <div class="li-category dropdown" data-id="{{$category->id}}">
                    <button class="btn btn-default dropdown-toggle dropdown-buttons" type="button" data-toggle="dropdown">{{$category->name}}&nbsp;&nbsp;<span class="caret caret-right"></span></button>
                    <ul class="dropdown-menu">
                        @foreach($category->recipeIngredients as $ingredient)
                            <li class="li-ingredient" role="presentation"><a href="#" data-id="{{$ingredient->id}}" data-name="{{$ingredient->name}}">{{$ingredient->name}}</a></li>
                        @endforeach
                    </ul>
                </div>
            @endforeach
        </div>
        <div class="col-md-9">
            <h1>Selected Ingredients</h1>
            {{--<div class="selected-ingredients-anchor row" data-api-controller-url="{{URL::route('result')}}">--}}
                {{--<ul class="clearable"></ul>--}}
            {{--</div>--}}
        </div>
        <div class="col-md-9">
            <h2>Recipes</h2>
            <div class="recipes clearable"></div>
            {{--<div class = "recipe-container">--}}
                {{--<div class = "recipe-image">--}}
                    {{--<div class = "white-triangle">--}}
                    {{--</div>--}}
                {{--</div>--}}

            </div>
        </div>
        <div class = "selected-ingredients-anchor" data-api-controller-url="{{URL::route('result')}}">
            <ul class = "clearable"></ul>
        </div>
    </div>
</div>
@endsection
