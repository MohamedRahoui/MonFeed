<?php $page = "login"; ?>
@extends('layouts.master')
@section('title', 'Connexion')
@section('content')
    @include('partials.header')
    <div class="jumbotron my_heading">
        <div class="container">
            <h5 class="display-4">Connexion</h5>
        </div>
    </div>
    <div class="container" id="login">
        <div class="row">
            <login></login>
        </div>
    </div>
    @include('partials.footer')
@endsection