<div class="jumbotron my_heading">
    <div class="container">
        <h5 class="display-4 d-inline-block"><i class="fa fa-youtube-play" style="color: #E52929;" aria-hidden="true"></i>
            <small class="lead">{{$page == "youtube" ? 'Mes videos' : ''}}</small>
            <span class="lead">{{$page == "search" ? 'Ajouter une video' : ''}}</span>
            <span class="lead">{{$page == "collections" ? 'Mes Collections' : ''}}</span>
        </h5>
        <div class="dropdown d-inline-block float-md-right" id="youtubeMenu">
            <a class="btn btn-secondary" href="#" id="dropdownMenuLink"
               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <small class="lead"><i class="fa fa-bars" aria-hidden="true"></i></small>
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
                <a class="dropdown-item {{$page == "youtube" ? 'disabled' : ''}}" href="{{url('my_space/youtube')}}"><i class="fa fa-video-camera" aria-hidden="true" style="margin-right: 10px;"></i> Mes videos</a>
                <a class="dropdown-item {{$page == "search" ? 'disabled' : ''}}" href="{{url('my_space/youtube/search')}}"><i class="fa fa-plus-circle" aria-hidden="true" style="margin-right: 10px;"></i> Ajouter une video</a>
            </div>
        </div>
    </div>
</div>