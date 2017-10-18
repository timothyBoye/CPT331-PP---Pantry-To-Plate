@extends('layouts.app')

@section('content')
    {{--<div class="container">--}}
        {{--<div class="row">--}}
            {{--<div class="row">--}}
                {{--<div class="col-6 col-md-4">.col-6 .col-md-4</div>--}}
                {{--<div class="col-6 col-md-4" style="margin-top: 300px;">--}}
                    {{--<form id="contact-form" name= "contact-form" action="ContactController.php" method="post">--}}
                        {{--<div class="form-group">--}}
                            {{--<label for="f-name">First Name:</label>--}}
                            {{--<input type="text" class="form-control" id="first-name" placeholder="First Name:">--}}
                        {{--</div>--}}
                        {{--<div class="form-group">--}}
                            {{--<label for="l-name">Last Name:</label>--}}
                            {{--<input type="text" class="form-control" id="last-name" placeholder="Last Name:">--}}
                        {{--</div>--}}
                        {{--<div class="dropdown">--}}
                            {{--<button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Dropdown Example--}}
                                {{--<span class="caret"></span></button>--}}
                                {{--<ul class="dropdown-menu">--}}
                                {{--<li><a href="#">New Recipe Idea</a></li>--}}
                                {{--<li><a href="#">New Feature Idea</a></li>--}}
                                {{--<li><a href="#">Enquire</a></li>--}}
                                {{--<li><a href="#">Something else</a></li>--}}
                            {{--</ul>--}}
                        {{--</div>--}}
                        {{--<div class="form-group">--}}
                            {{--<label for="email">Email:</label>--}}
                            {{--<input type="email" class="form-control" id="email" placeholder="Email:">--}}
                        {{--</div>--}}
                        {{--<div class="form-group">--}}
                            {{--<label for="comment">Comment:</label>--}}
                            {{--<textarea class="form-control" rows="5" id="comment" placeholder="Message:"></textarea>--}}
                        {{--</div>--}}
                    {{--</form>--}}
                    {{--<div id = "success" class = "container">--}}
                        {{--<p> Thank you for emailing me, I will get back to you shortly </p>--}}
                    {{--</div>--}}
                {{--</div>--}}
                {{--<div class="col-6 col-md-4">.col-6 .col-md-4</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}


    <div class="container-fluid content">
        @if(session('message'))
            <div class='alert alert-success'>
                {{ session('message') }}
            </div>
        @endif
        <div class="row">
            <div class="col-lg-6 col-md-6 col-lg-offset-3 col-md-offset-3 col-sm-10 col-sm-offset-1">
                <h1 class="mb-2">Contact Us</h1>
                <form class="form-horizontal" method="POST" action="{{ route('contact') }}">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="Name">Name: </label>
                        <input type="text" class="form-control" id="name" placeholder="Your name" name="name" required>
                    </div>

                    <div class="form-group">
                        <label for="email">Email: </label>
                        <input type="email" class="form-control" id="email" placeholder="john@example.com" name="email" required>
                    </div>

                    <div class="form-group">
                        <label for="message">Message: </label>
                        <textarea type="text" class="form-control luna-message" id="message" placeholder="Type your compliments here" name="message" required rows="15"></textarea>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary" value="Send">Send <span class="glyphicon glyphicon-envelope"></span></button>
                    </div>
                </form>
            </div>
        </div> <!-- /container -->
    </div>



@endsection