@extends('layouts.adminlayout')
<!-- Admin landing page -->
@section('content-header')
<h1>
    {{$title}}
    <small>Pantry To Plate statistics</small>
</h1>
<ol class="breadcrumb">
    <li><i class="fa fa-dashboard"></i> {{$title}}</li>
</ol>
@endsection

<!-- Boxes showing counts for site categories (ingredients, recipes, etc.) -->
@section('content')
<!-- Small boxes (Stat box) -->
<div class="row">
    <div class="col-lg-2 col-xs-6 col-lg-offset-1">
        <!-- small box -->
        <div class="small-box bg-aqua">
            <div class="inner">
                <h3>{{ $recipes }}</h3>

                <p>Recipes</p>
            </div>
            <div class="icon">
                <i class="ion ion-ios-list"></i>
            </div>
            <a href="{{ route('admin.recipes') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-2 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-green">
            <div class="inner">
                <h3>{{ $ingredients }}</h3>

                <p>Ingredients</p>
            </div>
            <div class="icon">
                <i class="ion ion-ios-nutrition"></i>
            </div>
            <a href="{{ route('admin.ingredients') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-2 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-red">
            <div class="inner">
                <h3>{{ $cuisines }}</h3>

                <p>Cuisines</p>
            </div>
            <div class="icon">
                <i class="ion ion-pizza"></i>
            </div>
            <a href="{{ route('admin.cuisines') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-2 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-purple">
            <div class="inner">
                <h3>{{ $measurements }}</h3>

                <p>Measurements</p>
            </div>
            <div class="icon">
                <i class="ion ion-spoon"></i>
            </div>
            <a href="{{ route('admin.measurements') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-2 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-yellow">
            <div class="inner">
                <h3>{{ $users }}</h3>

                <p>Users</p>
            </div>
            <div class="icon">
                <i class="ion ion-person"></i>
            </div>
            <a href="{{ route('admin.users') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
</div>
<!-- /.row -->
@endsection
