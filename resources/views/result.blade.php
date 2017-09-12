@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-3">

        </div>

        <div class="col-md-9">
            <h1>Results</h1>
            <div class="selected-ingredients-anchor row">
                @foreach($json["matches"] as $j)
                    <p>{{$j["recipeName"]}}</p>
                    <p>{{$j["rating"]}}</p>
                @endforeach
                <?php
                echo $json["totalMatchCount"];
                ?>
            </div>
            <div class="row">

                <div id="json-results"></div>
            </div>
        </div>
    </div>
</div>
@endsection
