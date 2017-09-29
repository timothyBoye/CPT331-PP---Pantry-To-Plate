
@extends('layouts.app')

@section('content')
    <div class="container-fluid cuisine-mappings-bg">
        <div class="row">
            <div class="alert invisible success-message col-md-6"></div>
        </div>



        <div class="row">
                <div class="col-sm-3"></div>


                <div class="col-sm-6 drag-drop-box">
                    <div class="black-box"></div>
                        <h2 class = "drag-drop-box-heading" >Manage Cuisine Preferences</h2>

                        <div class="cuisine-box" >
                            <ul id="sortable" class='cuisine-mappings-anchor' data-controller-url="{{URL::route('profile.cuisines.update')}}">
                                @foreach($cuisine_mappings as $mapping)
                                    <li class="ui-state-default sort-li" data-mapping-id="{{$mapping->cuisine_type_id}}" data-current-rank="{{$mapping->rating}}">{{$mapping->cuisine_type->name}}</li>
                                @endforeach
                            </ul>
                        </div>
                    <div>
                        <button class="update-cuisine-mappings-btn btn btn-primary">Update Preferences <span class="glyphicon glyphicon-check"></span></button>
                    </div>
                </div>
                <div class="col-sm-3"></div>
        </div>
    </div>

@endsection