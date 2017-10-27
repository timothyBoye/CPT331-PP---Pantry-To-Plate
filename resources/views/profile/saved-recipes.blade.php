@extends('layouts.app')
@section('content')

 <div class="container-fluid content">
    <table id="saved_recipes_table" class="table table-bordered" data-delete-recipe-url="{{ Route('profile.delete_recipe') }}">
        <thead>
            <tr class="saved-recipe-table-heading">
                <th>Recipe Name</th>
                <th>Description</th>
                <!--Delete Button below-->
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach($mappings as $mapping)
                <tr>
                    <td><a href="{{ route('recipe', $mapping->recipe->id) }}">{{$mapping->recipe->name}}</a></td>
                    <td>{{$mapping->recipe->short_description}}</td>
                    <td>
                            <button class="delete-saved-recipe-btn btn btn-success" data-recipe-id="{{$mapping->recipe->id}}"><span class="glyphicon glyphicon-remove"></span>Delete</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
 </div>
@endsection