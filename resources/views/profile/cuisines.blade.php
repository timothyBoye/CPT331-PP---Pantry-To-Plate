
@extends('layouts.app')

@section('content')

    <div class="container-fluid cuisine-mappings-bg content">
        <div class="row">
            <div class = "success-box invisible">
                <button type="button" class="close close-message-box" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <div class = "success-danger-img">
                    <img class = "tick" src='{{ asset('/img/tick.png') }}'/>
                    <img class = "cross-img" src='{{ asset('/img/600px-Exclamation_mark_white_icon.svg.png') }}'/>
                </div>
                <div class="alert success-message"></div>
            </div>

            {{--col-md-6--}}
        </div>

        <div class="row">
            <div class="col-sm-3"></div>
            <div class="col-sm-6 drag-drop-box">
                <div class="black-box"></div>
                <h2 class = "drag-drop-box-heading" >Manage Cuisine Preferences</h2>
                    <div class="cuisine-box" >
                        <ul id="sortable" class='cuisine-mappings-anchor ui-sortable' data-controller-url="{{URL::route('profile.cuisines.update')}}">
                            @foreach($cuisine_mappings as $mapping)
                                <li class="ui-state-default ui-sortable-handle sort-li" data-mapping-id="{{$mapping->cuisine_type_id}}" data-current-rank="{{$mapping->rating}}">{{$mapping->cuisine_type->name}}</li>
                            @endforeach
                         </ul>
                    </div>
                </div>
            </div>


            <div class="container-button">
                <button class="update-cuisine-mappings-btn btn cuisine-button">Update Preferences <span class="glyphicon glyphicon-check"></span></button>
            </div>
        </div>


    </div>

@endsection