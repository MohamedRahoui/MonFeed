<nav class="navbar navbar-toggleable-md navbar-light fixed-top bg-faded">
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse"
            data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false"
            aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <a class="navbar-brand" href="#"> <img src="{{asset('img/logo.png')}}"  height="30" alt="MonFeed" class="d-inline-block align-top" > MonFeed </a>

    <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item {{$page == "home" ? 'active' : '' }}">
                <a class="nav-link" href="{{url('/')}}">Acceuil</a>
            </li>
        </ul>
        <ul class="navbar-nav navbar-right">
            <li class="nav-item {{$page == "login" ? 'active' : '' }}">
                <a class="nav-link" href="{{url('login')}}">Connexion</a>
            </li>
            <li class="nav-item {{$page == "register" ? 'active' : '' }}">
                <a class="nav-link" href="{{url('register')}}">Inscription</a>
            </li>
        </ul>

    </div>
</nav>