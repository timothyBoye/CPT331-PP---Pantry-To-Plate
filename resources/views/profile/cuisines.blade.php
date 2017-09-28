
@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">
            </div>
            <div class="col-md-9">
                <h2>Manage Cuisine Preferences</h2>
                <div class="row">
                    <div class="alert invisible success-message col-md-6"></div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <ul id="sortable" class='cuisine-mappings-anchor' data-controller-url="{{URL::route('profile.cuisines.update')}}">
                            @foreach($cuisine_mappings as $mapping)
                                <li class="ui-state-default sort-li" data-mapping-id="{{$mapping->cuisine_type_id}}" data-current-rank="{{$mapping->rating}}">{{$mapping->cuisine_type->name}}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-offset-2 col-md-2">
                        <button class="update-cuisine-mappings-btn btn btn-primary">Update Preferences <span class="glyphicon glyphicon-check"></span></button>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection