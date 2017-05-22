<template>
    <div>
        <nav class="navbar navbar-toggleable-md navbar-light bg-faded" style="margin-top: 22px;">
                <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse"
                        data-target="#facebookNav" aria-controls="navbarsExampleDefault" aria-expanded="false"
                        aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <a class="navbar-brand" href="/my_space/facebook"><i class="fa fa-facebook-official fa-2x"
                                                                     style="color: #3b5998;"></i> Facebook </a>

                <div class="collapse navbar-collapse" id="facebookNav">
                    <ul class="navbar-nav mr-auto">

                    </ul>
                    <ul class="navbar-nav navbar-right">
                        <li class="nav-item dropdown">
                            <a v-if="isConnected" class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink"
                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img :src="userImg" width="50" :alt="userName" class="img-thumbnail">
                                {{userName}}
                            </a>
                            <div class="dropdown-menu dropdown-menu-right " aria-labelledby="navbarDropdownMenuLink">
                                <a class="dropdown-item" href="/my_space/facebook/pubs"><i class="fa fa-pencil-square-o" aria-hidden="true" style="color: #3b5998;"></i> Poster sur votre mur</a>
                                <a class="dropdown-item" href="/my_space/facebook/search"><i class="fa fa-search-plus" aria-hidden="true" style="color: #3b5998;"></i> Chercher et suivre des pages</a>
                                <a class="dropdown-item" href="/my_space/facebook"><i class="fa fa-list" aria-hidden="true" style="color: #3b5998;"></i> Pages suivis</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item text-danger" @click="logout"><i class="fa fa-sign-out" aria-hidden="true"></i> Déconnexion Facebook</a>
                            </div>
                            <a href="#" v-if="!isConnected" @click="login" class="btn btn-primary">Se connecter</a>
                        </li>
                    </ul>

                </div>
        </nav>
        <slot v-if="isConnected"></slot>
    </div>
</template>

<script>
    export default {
        data(){
            return {
                isConnected: false,
                userName: '',
                userImg: ''
            }
        },
        created(){
            let self = this;
            window.fbAsyncInit = function () {
                FB.init({
                    appId: '1675015296127584',
                    xfbml: true,
                    version: 'v2.9',
                    status     : true,
                    cookie: true,
                });
                self.checkLogin();
            };

            (function (d, s, id) {
                let js, fjs = d.getElementsByTagName(s)[0];
                if (d.getElementById(id)) {
                    return;
                }
                js = d.createElement(s);
                js.id = id;
                js.src = "//connect.facebook.net/fr_FR/sdk.js";
                fjs.parentNode.insertBefore(js, fjs);
            }(document, 'script', 'facebook-jssdk'));
        },
        methods: {
            checkLogin(){
                let self = this;
                FB.getLoginStatus(function (response) {
                    if (response.status === 'connected') {
                        self.isConnected = true;
                        FB.api('/me?fields=id,name,picture', (response) => {
                            self.userName = response.name;
                            self.userImg = response.picture.data.url;
                        });
                    } else {
                        self.isConnected = false;
                    }
                });
            },
            login(){
                let self = this;
                FB.getLoginStatus(function (response) {
                    if (response.status === 'connected') {
                        self.isConnected = true;
                        FB.api('/me?fields=id,name,picture', (response) => {
                            self.userName = response.name;
                            self.userImg = response.picture.data.url;
                        });
                    }
                    else {
                        FB.login((response) => {
                            self.isConnected = true;
                            FB.api('/me?fields=id,name,picture', (response) => {
                                self.userName = response.name;
                                self.userImg = response.picture.data.url;
                            });
                            toastr.success('Connecté');
                        });
                    }
                });
            },
            logout(){
                let self = this;
                FB.logout(function (response) {
                    self.isConnected = false;
                    self.userName = '';
                    self.userImg = '';
                    toastr.success('Déconnecté');
                });
            }
        }
    }
</script>
