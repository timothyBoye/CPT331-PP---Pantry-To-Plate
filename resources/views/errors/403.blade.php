@extends('layouts.app')

@section('content')
    <div class="container content">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <!--Custom Error Page-->
                <!--https://laravel.com/docs/5.5/errors#custom-http-error-pages-->
                <h2 style="text-align: center;">403</h2>
                <!--Would like a nicer looking image but it fits the bill for now-->
                <p style="text-align:center;"><img src="https://cdn.wallpapersafari.com/64/15/DHkLNa.jpg" alt="Unhappy cat" height="270" width="480"></p>
                <p style="text-align: center;">Uh oh! There might be too many cooks in the kitchen right now. The page you are looking for can't be found.</p>
                <!--Should be able to see what to do when the page is actually styled-->
                <p style="text-align: center;">Please use the back button in your browser to return to where you were.</p>
            </div>
        </div>
    </div>
@endsection