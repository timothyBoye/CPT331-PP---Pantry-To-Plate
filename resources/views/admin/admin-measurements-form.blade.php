@extends('layouts.adminlayout')

@section('head')
<script>
    $().ready(function() {
        $("#form").validate({
            rules: {
                name: {
                    required: true,
                    minlength: 3
                },
                comparable_size: {
                    required: true,
                    digits: true
                }
            },
            messages: {
                name: {
                    required: "Please enter a name for the measurement",
                    minlength: "A measurement name must be at least 3 characters"
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
                            <div class="col-md-12">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Enter name" value="{{ isset($measurement) ? $measurement->name : ''  }}">
                                @if ($errors->has('name'))
                                    <span class="help-block"><strong>{{ $errors->first('name') }}</strong></span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                            <div class="col-md-12">
                                <label for="comparable_size">Comparable Size</label>
                                <input type="text" class="form-control" id="comparable_size" name="comparable_size" placeholder="Enter comparable size" value="{{ isset($measurement) ? $measurement->comparable_size : ''  }}">
                                @if ($errors->has('comparableSize'))
                                    <span class="help-block"><strong>{{ $errors->first('comparableSize') }}</strong></span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->

                    <div class="box-footer">
                        <div class="form-group">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <input class="btn btn-default" type="reset">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
