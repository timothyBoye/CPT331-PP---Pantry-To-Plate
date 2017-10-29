@extends('layouts.adminlayout')
<!-- Admin form to add recipe steps to database -->
<!-- Breadcrumb trail -->
@section('content-header')
    <h1>
        {{$title}}
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="{{ route('admin.recipes') }}"><i class="ion ion-ios-list"></i> Recipes</a></li>
        <li><i class="fa fa-sticky-note-o"></i> {{$title}}</li>
    </ol>
@endsection
<!-- Step, image and description input, added to database if unique and valid -->
@section('content')
    <div class="row">
        <div class="col-md-12">
            <form role="form" action="{{ route('admin.recipe.methods.post', ['id' => $recipe->id]) }}" method="POST" id="method-form" name="method-form" novalidate>
                <div class="box box-success">
                    <div class="box-header with-border">
                        <h3 class="box-title">Recipe Method</h3>
                        {{ csrf_field() }}
                    </div>
                    <div class="box-body" style="">
                        <div id="method_container">
                        </div>
                        <!-- Add/remove step buttons -->
                        <div id="method_buttons">
                            <p>
                                <a id="add_method_step" class="btn btn-primary btn-sm" href="#method_container"><span>(+) Add Step</span></a>
                                <a id="remove_method_step" class="btn btn-warning btn-sm"  href="#method_container"><span>(-) Remove Step</span></a>
                            </p>
                        </div>
                    </div>
                </div>
                <!-- Validation message display -->
                <div class="box box-solid">
                    <div class="box-body">
                        <p id="errors" class="{{ count($errors) > 0 ? 'has-error' : '' }}">
                            <b>
                            @if (count($errors) > 0)
                                @foreach ($errors->all() as $error)
                                    {{ $error }}
                                @endforeach
                            @endif
                            </b>
                        </p>
                        <button type="button" id="submit-btn" class="btn btn-primary">Finish</button>
                        <input class="btn btn-default" type="reset">
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection


<!-- Input handling and validation methods -->
@section('head')
    <script>
        var method_steps_count = 0;
        $(function() {
            // Recipe method steps functions
            @if(old('method_descriptions'))
                @for($i = 0; $i < count(old('method_descriptions')); $i++)
                {{--@php(//$image = old('method_images.'.$i))--}}
                @php($description = old('method_descriptions.'.$i))
                $('#method_container').append(addStep('{{$description}}'));//, '{{--$image--}}'));
                @endfor
            @elseif(isset($recipe))
                @foreach($recipe->method_steps as $step)
                $('#method_container').append(addStep('{{$step->description}}'));//, '{{--$step->image_url--}}'));
                @endforeach
            @endif


            $('#add_method_step').click(function() {
                $('#method_container').append(addStep('', ''));
            });

            $('#remove_method_step').click(function(){
                if (method_steps_count > 0) {
                    method_steps_count -= 1;
                    $('#method_container > :last-child').remove();
                }
            });

            function addStep(description) { //}, image_name) {
                method_steps_count += 1;
                return '<div class="form-group">' +
                    '<h5>Step ' + method_steps_count + ': </h5>' +
                    '<label for="method_description_' + method_steps_count + '">Description</label>\n' +
                    '<textarea id="method_description_' + method_steps_count + '" class="form-control method_descriptions" name="method_descriptions[]' + '" placeholder="Enter step description">'+ description +'</textarea>' +
                    //'<label for="method_image_' + method_steps_count + '">Image name</label>\n' +
                    //'<input id="method_image_' + method_steps_count + '" class="form-control" name="method_images[]' + '" type="text" placeholder="Enter step image name" value="'+ image_name +'" />' +
                    '</div>';
            }
            // Validation
            $('#submit-btn').click( function()
            {
                if (validMethods() == 0) {
                    $('form#method-form').submit();
                } else {
                    $('#errors').html('<b>All method steps must contain simple text, if you have too many fields clicking \"Remove Step\" will remove the last step.</b>');
                }
            });

            function validMethods()
            {
                var errors = 0;
                $("[id^='method_description']").each(function() {
                    if($(this).val().length == 0) {
                        errors++;
                    }
                });
                return errors;
            }
        });
    </script>
@endsection
