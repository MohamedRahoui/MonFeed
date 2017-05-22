<?php $page = "youtube"; ?>
@extends('layouts.master')
@section('title', 'Youtube')
@section('content')
    @include('my_space.partials.header')
    @include('my_space.youtube.partials.jumbotron')
    <div class="container">
        @if(count($videos) > 0)
            <div class="card-deck">
                @foreach($videos as $video)
                    <my-video id="{{$video->youtube_id}}" db_key="{{$video->key}}"></my-video>
                @endforeach
            </div>
        @else
            <div class="text-center"><h3 class="display-4 text-danger"><i class="fa fa-battery-empty"
                                                                          aria-hidden="true"></i>
                    Pas de videos</h3>
            </div>
        @endif
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

