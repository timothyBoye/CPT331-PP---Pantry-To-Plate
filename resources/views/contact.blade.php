@extends('layouts.app')

@section('content')

    <div class="container-fluid content">

        <div class="row">
            <div class="col-lg-6 col-lg-offset-3">
                @if(session('message'))
                    <div class="text-center">
                        <div class='alert alert-success'>
                            <p class="contact-message-text">{{ session('message') }}</p>
                        </div>
                    </div>
                @endif
                <div class="text-center">
                    <h1 class="mb-2">Contact Us</h1>
                </div>
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
                        <button type="submit" class="btn btn-success send-button" value="Send">Send <span class="glyphicon glyphicon-envelope"></span></button>
                    </div>
                </form>
            </div>
        </div> <!-- /container -->
    </div>



@endsection