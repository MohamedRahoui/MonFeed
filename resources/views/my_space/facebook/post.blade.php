<?php $page = "facebook"; ?>
@extends('layouts.master')

@section('title', 'Facebook Publications')

@section('content')
    @include('my_space.partials.header')
    <facebook-nav>
        <div class="container">
            <facebook-post></facebook-post>
        </div>
    </facebook-nav>
    @include('my_space.partials.footer')
@endsection