@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <section class="col-lg-6 col-lg-offset-3 col-md-8 col-md-offset-3">
            <h1>About Pantry to Plate</h1>
            <div>
                <h2>Why are we here?</h2>
                <p> Our aim here at Pantry to Plate is simple: eliminate food wastage and save you some money. We do this by
                    helping you use those pesky ingredients that are near their best-by date by matching them with delicious
                    recipes. If you have used an ingredient that would otherwise have been thrown away, we have done our job.
                </p>
            </div>
            <div>
                <h2>Why are you here?</h2>
                <p>
                    You have some wontons in the refrigerator that are not the freshest they have ever been, but you are no
                    Heston Redmenthol or Jamie Olives so need a little help deciding on how best to use them. All you need to
                    do is select 'wontons' from the ingredients list on the <a href="{{ route('home') }}">home page</a> and
                    make a selection. We even allow users to rate recipes, so you know you are using your wontons wisely.
                </p>
                <p>
                    For even better suggestions, create a <a href="{{ route('register') }}">profile</a> to let us know what
                    types of food you like best. We will then ensure that the recipes you see are not only using the ingredients
                    you want to use, but they are relevant to you specifically!
                </p>
            </div>
            <div>
                <h2>Who are we?</h2>
                <p>
                    We are a small team of passionate food loving waste hating money saving web developers, and this site is our
                    answer to a world without waste.
                </p>
            </div>
        </section>
    </div>
</div>
@endsection