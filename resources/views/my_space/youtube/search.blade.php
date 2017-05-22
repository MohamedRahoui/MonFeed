<?php $page = "search"; ?>
@extends('layouts.master')
@section('title', 'Ajouter une video')
@section('content')
    @include('my_space.partials.header')
    @include('my_space.youtube.partials.jumbotron')
    <youtube-search></youtube-search>
    @include('my_space.partials.footer')
@endsection