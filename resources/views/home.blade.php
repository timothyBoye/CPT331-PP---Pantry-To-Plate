@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-3">
            <ul>
               @foreach($ingredients as $ingredient)
                   <li class="li-ingredient" data-id="{{$ingredient->id}}" data-name="{{$ingredient->name}}">{{$ingredient->name}}</li>
                @endforeach
            </ul>
        </div>
        <div class="col-md-9">
            <h1>Selected Ingredients</h1>
            <div class="selected-ingredients-anchor row">
                <ul></ul>
            </div>
            <div class="row">
                <div class="alert alert-info">
                    <p class="api-key" data-api-url="{{Config::get('constants.api_endpoint')}}">API KEY:&nbsp;{{Config::get('constants.api_endpoint')}}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
