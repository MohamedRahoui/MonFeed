<?php $page = "my_space"; ?>
@extends('layouts.master')
@section('title', 'Mon Éspace')
@section('content')
    @include('my_space.partials.header')
    <div class="container" style="padding-top: 40px;padding-bottom: 20px;">
        <home-youtube></home-youtube>
        <home-facebook></home-facebook>
    </div>

    @include('my_space.partials.footer')
@endsection
@section('FastJs')
    <script
            src="https://code.jquery.com/jquery-3.2.1.js"
            integrity="sha256-DZAnKJ/6XZ9si04Hgrsxu/8s717jcIzLy3oi35EouyE="
            crossorigin="anonymous"></script>
    <script src="{{asset('holdon/holdon.js')}}"></script>
    <script src="{{asset('js/youtube/index.js')}}"></script>
@endsection