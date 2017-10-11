@extends('layouts.adminlayout')

@section('head')
<script>
    $().ready(function() {
        $('#seed_button').click(function(){
            $.ajax({
                url: $('#seed_button').attr('data-api-controller-url'),
                type: 'POST',
                data: $(form).serialize()
            }).done(function(response){
                $('#seed_file_string').html('<pre>'+response+'</pre>');
            }).fail(function(response){
                $('#seed_file_string').html(response.responseText);
            });
        });
        $("#form").validate({
            rules: {
                name: {
                    required: true,
                    minlength: 3,
                    alpha_international: true
                },
                comparable_size: {
                    required: true,
                    digits: true
                }
            },
            messages: {
                name: {
                    required: "Please enter a name for the measurement",
                    minlength: "A measurement name must be at least 3 characters",
                    alpha_international: "A measurement name can contain a-z and accented characters only"
                },
                comparable_size: {
                    required: "Please enter an approximation of what 1 of this measure would be in millilitres"
                }
            }
        });
    });
</script>
@endsection

@section('content-header')
    <h1>
        {{$title}}
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="{{ route('admin.measurements') }}"><i class="ion ion-ios-list"></i> Measurements</a></li>
        <li><i class="fa fa-sticky-note-o"></i> {{$title}}</li>
    </ol>
@endsection


@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-success">
                <form role="form" action="{{ isset($measurement) ? route('admin.measurement.put', ['id' => $measurement->id]) : route('admin.measurement.post') }}" method="POST" id="form" novalidate>
                    {{ csrf_field() }}
                    @if(isset($measurement))
                        {{ method_field('PUT') }}
                        <input type="text" id="id" name="id" value="{{ $measurement->id }}" hidden disabled>
                    @endif
                    <div class="box-body">
                        <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Enter name" value="{{ isset($measurement) ? $measurement->name : old('name')  }}">
                                @if ($errors->has('name'))
                                    <span class="help-block"><strong>{{ $errors->first('name') }}</strong></span>
                                @endif
                        </div>
                        <div class="form-group {{ $errors->has('comparable_size') ? 'has-error' : '' }}">
                                <label for="comparable_size">Comparable Size</label>
                                <input type="text" class="form-control" id="comparable_size" name="comparable_size" placeholder="Enter comparable size" value="{{ isset($measurement) ? $measurement->comparable_size : old('comparable_size')  }}">
                                @if ($errors->has('comparable_size'))
                                    <span class="help-block"><strong>{{ $errors->first('comparable_size') }}</strong></span>
                                @endif
                        </div>
                        <div id="seed_file_string">

                        </div>
                    </div>
                    <!-- /.box-body -->

                    <div class="box-footer">
                        <div class="form-group">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <button type="button" id="seed_button" class="btn btn-info" data-api-controller-url="{{route('admin.measurement.seeder')}}">Get Seed File String</button>
                                <input class="btn btn-default" type="reset">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
