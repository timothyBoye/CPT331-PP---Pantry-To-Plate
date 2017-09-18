@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-3">

            </div>

            <div class="col-md-9">
                <div class="row">
                    <h1>{{ $recipe->name }}</h1>
                    <q>{{ $recipe->long_description }}</q>
                    <div id="recipe-serving">
                        <strong>Serves:</strong> {{ $recipe->serving_size }}
                    </div>
                </div>
                <div class="row">
                    <h2>Ingredients</h2>
                    <div id="recipe-ingredients">
                        <ul>
                            @foreach($recipe->ingredients as $ingredient)
                            <li>
                                {{ $ingredient->ingredient->name }}
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="row">
                    <h2>Method</h2>
                    <div id="recipe-method">
                        <ol>
                            <li>
                                {!! str_replace(';', "</li><li>", $recipe->method) !!}
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
