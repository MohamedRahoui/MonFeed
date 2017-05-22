<?php $page = "register"; ?>
@extends('layouts.master')
@section('title', 'Inscription')
@section('content')
    @include('partials.header')
    <div class="jumbotron my_heading">
        <div class="container">
            <h5 class="display-4">Inscription</h5>
        </div>
    </div>
    <div class="container" id="register">
        <div class="row">
            <register></register>
        </div>
    </div>
    @include('partials.footer')
@endsection