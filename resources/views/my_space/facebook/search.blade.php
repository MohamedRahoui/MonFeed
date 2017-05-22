<?php $page = "facebook"; ?>
@extends('layouts.master')

@section('title', 'Facebook search')

@section('content')
    @include('my_space.partials.header')
    <facebook-nav>
        <div class="container">
            <facebook-search></facebook-search>
        </div>
    </facebook-nav>
    @include('my_space.partials.footer')
@endsection