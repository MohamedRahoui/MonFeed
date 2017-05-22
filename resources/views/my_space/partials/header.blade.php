<nav class="navbar navbar-toggleable-md navbar-light fixed-top bg-faded">
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse"
            data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false"
            aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <a class="navbar-brand" href="{{url('my_space')}}"> <img src="{{asset('img/logo.png')}}" height="30" alt="MonFeed"
                                                             class="d-inline-block align-top"> MonFeed </a>

    <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
        </ul>
        <ul class="navbar-nav navbar-right">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown"
                   aria-haspopup="true" aria-expanded="false">
                    {{studly_case(Auth::user()->first_name)}} {{studly_case(Auth::user()->last_name)}}
                </a>
                <div class="dropdown-menu dropdown-menu-right " aria-labelledby="navbarDropdownMenuLink">
                    <a class="dropdown-item text-danger" href="{{url('my_space/youtube')}}">
                        <i class="fa fa-youtube-play " aria-hidden="true"></i> Youtube</a>
                    <a class="dropdown-item" href="{{url('my_space/facebook')}}" style="color: #3B5998;">
                        <i class="fa fa-facebook-official" aria-hidden="true"></i> Facebook</a>
                    <a class="dropdown-item {{$page == "twitter" ? 'active' : ''}}" href="{{url('my_space/twitter')}}"
                       style="color: #1DA1F3;"><i class="fa fa-twitter" aria-hidden="true"></i> Twitter</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item text-danger" href="{{url('logout')}}"><i class="fa fa-sign-out"
                                                                                     aria-hidden="true"></i> Déconnexion</a>
                </div>
            </li>
        </ul>

    </div>
</nav>