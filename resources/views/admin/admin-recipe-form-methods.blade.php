@extends('layouts.adminlayout')

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

@section('content')
    <div class="row">
        <div class="col-md-12">
            <form role="form" action="{{ route('admin.recipe.methods.post', ['id' => $recipe->id]) }}" method="POST" id="form" novalidate>
                <div class="box box-success">
                    <div class="box-header with-border">
                        <h3 class="box-title">Recipe Method</h3>
                        {{ csrf_field() }}
                    </div>
                    <div class="box-body" style="">
                        <div id="method_container">
                        </div>
                        <div id="method_buttons">
                            <p>
                                <a id="add_method_step" class="btn btn-primary btn-sm" href="#method_container"><span>(+) Add Step</span></a>
                                <a id="remove_method_step" class="btn btn-warning btn-sm"  href="#method_container"><span>(-) Remove Step</span></a>
                            </p>
                        </div>
                    </div>
                </div>

                <div class="box box-solid">
                    <div class="box-body">
                        <div id="seed_file_string">

                        </div>
                        <button type="submit" class="btn btn-primary">Finish</button>
                        <input class="btn btn-default" type="reset">
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection



@section('head')
    <script>

        // Validation
        $("#form").validate({
            rules: {
            },
            messages: {
            }
        });


        var method_steps_count = 0;
        $(function() {
            // Recipe method steps functions
            @if(isset($recipe))
            @foreach($recipe->method_steps as $step)
            $('#method_container').append(addStep('{{$step->description}}', '{{$step->image_url}}'));
            @endforeach
            @elseif(old('method_descriptions'))
            @for($i = 0; $i < count(old('method_descriptions')); $i++)
            @php($image = old('method_images.'.$i))
            @php($description = old('method_descriptions.'.$i))
            $('#method_container').append(addStep('{{$description}}', '{{$image}}'));
            @endfor
            @endif

            $('#add_method_step').click(function() {
                $('#method_container').append(addStep('', ''));
                $('.method_descriptions').each(function(key, element) {
                    $(element).append("hello");
                });
            });

            $('#remove_method_step').click(function(){
                if (method_steps_count > 0) {
                    method_steps_count -= 1;
                    $('#method_container > :last-child').remove();
                }
            });

            function addStep(description, image_name) {
                method_steps_count += 1;
                return '<div class="form-group">' +
                    '<h5>Step ' + method_steps_count + ': </h5>' +
                    '<label for="method_description_' + method_steps_count + '">Description</label>\n' +
                    '<input id="method_description_' + method_steps_count + '" class="form-control method_descriptions" name="method_descriptions[]' + '" type="text" placeholder="Enter step description" value="'+ description +'" />' +
                    '<label for="method_image_' + method_steps_count + '">Image name</label>\n' +
                    '<input id="method_image_' + method_steps_count + '" class="form-control" name="method_images[]' + '" type="text" placeholder="Enter step image name" value="'+ image_name +'" />' +
                    '</div>';
            }

//            $("input[id*='method_desciption']").each(function() {
//                $(this).validate();
//                $(this).rules('add', {
//                    required: true,
//                    messages: {
//                        required: "Please enter an ingredient"
//                    }
//                });
//            });
//            $("input[id*='method_image']").each(function() {
//                $(this).validate();
//                $(this).rules('add', {
//                    required: false,
//                    messages: {
//                    }
//                });
//            });
        });
    </script>
@endsection
