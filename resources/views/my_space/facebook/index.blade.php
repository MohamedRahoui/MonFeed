<?php $page = "facebook"; ?>
@extends('layouts.master')

@section('title', 'Facebook')

@section('content')
    @include('my_space.partials.header')
    <facebook-nav>
        <div class="container" style="padding-top: 20px;">
            <hr>
            <p class="lead" >* Pages que vous suivez</p>
            <hr>
            @if(count($pages) > 0)
                <div class="card-deck">
                    @foreach($pages as $page)
                        <facebook-my-page page_id="{{$page->facebook_id}}" page_key="{{$page->key}}"></facebook-my-page>
                    @endforeach
                </div>
            @else
                <div class="text-center"><h3 class="display-4" style="color: #3b5998;"><i class="fa fa-battery-empty"
                                                                                          aria-hidden="true"></i>
                        Pas de suivis</h3>
                </div>
            @endif
        </div>
    </facebook-nav>
@include('my_space.partials.footer')
@endsection