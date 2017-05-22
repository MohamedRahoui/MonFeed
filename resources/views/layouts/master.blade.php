<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>MonFeed - @yield('title')</title>
    <link rel="icon" type="image/png" href="{{asset('img/logo.png')}}"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="{{asset('bootstrap/css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <link rel="stylesheet" href="{{asset('sweetalert/sweet.css')}}">
    <link rel="stylesheet" href="{{asset('toastr/toastr.css')}}">
    <link rel="stylesheet" href="{{asset('holdon/holdon.css')}}">
    @yield('Css')
    <script>
        window.Laravel = {!! json_encode([
        'csrfToken' => csrf_token(),
    ]) !!};
    </script>

</head>
<body>
@yield('FastJs')
<div id="app">
    @yield('content')
</div>
<script src="{{asset('js/time.js')}}"></script>
<script src="{{asset('js/app.js')}}"></script>
<script src="{{asset('toastr/toastr.js')}}"></script>
<script src="{{asset('holdon/holdon.js')}}"></script>
<script src="{{asset('sweetalert/sweet.js')}}"></script>
<script src="{{asset('js/tether.js')}}"></script>
<script src="{{asset('bootstrap/js/bootstrap.js')}}"></script>
<script src="https://use.fontawesome.com/c859bf1e57.js"></script>
<script src="{{asset('js/scripts.js')}}"></script>
@yield('Js')
</body>
</html>