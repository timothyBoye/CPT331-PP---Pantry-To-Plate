@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-3">
            @foreach($categories as $category)
                <div class="li-category dropdown" data-id="{{$category->id}}">
                    <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">{{$category->name}}&nbsp;&nbsp;<span class="caret"></span></button>
                    <ul class="dropdown-menu">
                        @foreach($category->ingredients as $ingredient)
                            <li class="li-ingredient" role="presentation"><a href="#" data-id="{{$ingredient->id}}" data-name="{{$ingredient->name}}">{{$ingredient->name}}</a></li>
                        @endforeach
                    </ul>
                </div>
            @endforeach
        </div>
        <div class="col-md-9">
            <h1>Selected Ingredients</h1>
            <div class="selected-ingredients-anchor row">
                <ul></ul>
            </div>
            <div class="row">
                <div class="alert alert-info">
                    <p class="api-key" data-api-url="{{Config::get('constants.api_endpoint')}}" data-api-controller-url="{{URL::route('result')}}">API KEY:&nbsp;{{Config::get('constants.api_endpoint')}}</p>
                </div>
                <h1 id="json-results-count"></h1>
                <div id="json-results"></div>
                <ul class="pagination" id="pagination-list">
                    {{--<li class="li-page"><a href="#">1</a></li>--}}
                    {{--<li class="li-page"><a href="#">2</a></li>--}}
                    {{--<li class="li-page"><a href="#">3</a></li>--}}
                    {{--<li class="li-page"><a href="#">4</a></li>--}}
                    {{--<li class="li-page"><a href="#">5</a></li>--}}
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
