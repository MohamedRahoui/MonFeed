<template>
    <form class="offset-md-2 col-md-8 col-sm-12" @submit.prevent="login_post" method="POST">
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" v-model="user.email" required>
        </div>
        <div class="form-group">
            <label for="password">Mot de passe</label>
            <input type="password" class="form-control" id="password" v-model="user.password" required>
        </div>
        <div class="form-check">
            <label class="form-check-label">
                <input type="checkbox" class="form-check-input" v-model="user.stayConnected">
                Rester Connecté
            </label>
        </div>
        <div class="form-group row">
            <div class="offset-md-10 col-sm-12 col-md-2">
                <button type="submit" class="btn btn-primary">Se connecter</button>
            </div>
        </div>
    </form>
</template>

<script>
    export default {
        data(){
            return {
                user: {
                    email: '',
                    password: '',
                    stayConnected: true
                }
            }
        },
        methods:{
            login_post() {
                HoldOn.open({theme: "sk-circle"});
                var self = this;
                axios.post('/login', self.user).then(function (response) {
                    if(response.data.loggedIn){
                        window.location.replace("/my_space");
                    }else{
                        HoldOn.close();
                        swal({
                            title: 'Oops ...',
                            text: 'Mauvaises informations',
                            type: 'error'
                        });
                    }
                }).catch(function (error) {
                    HoldOn.close();
                    swal({
                        title: 'Oops ...',
                        text: 'Un problème est survenu lors de votre connexion , veuillez réessayer ultérieurement.',
                        type: 'error'
                    }).then(function () {
                        window.location.replace("/");
                    }, function () {
                        window.location.replace("/");
                    });
                });
            }
        }
    }
</script>
