@extends('layouts.master')
@section('title', 'Confirmation d\'émail')
@section('content')
    <div class="container">
        <div class="jumbotron">
            <h1 class="display-3">MonFeed - Félicitations</h1>
            <p class="lead">Votre émail {{studly_case($user->email)}} est bien validé, vous pouvez vous connecter dès maintenant.</p>
            <p><a class="btn btn-lg btn-success" href="{{url('login')}}" role="button">Se Connecter</a></p>
        </div>
    </div>
@endsection