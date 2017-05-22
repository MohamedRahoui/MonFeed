<template>
<form class="offset-md-2 col-md-8 col-sm-12" @submit.prevent="register_post" method="POST">
    <div class="form-group" :class="[errors.first_name ? ' has-danger' : '']">
        <label for="first_name">Prénom</label>
        <input type="text" class="form-control" id="first_name" name="first_name" v-model="user.first_name">
        <div class="form-control-feedback" v-if="errors.first_name">{{ errors.first_name[0]}}</div>
    </div>
    <div class="form-group" :class="[errors.last_name ? ' has-danger' : '']">
        <label for="last_name">Nom</label>
        <input type="text" class="form-control" id="last_name" name="last_name" v-model="user.last_name">
        <div class="form-control-feedback" v-if="errors.last_name">{{ errors.last_name[0]}}</div>
    </div>
    <div class="form-group" :class="[errors.email ? ' has-danger' : '']">
        <label for="email">Email</label>
        <input type="text" class="form-control" id="email" name="email" v-model="user.email">
        <div class="form-control-feedback" v-if="errors.email">{{ errors.email[0]}}</div>
    </div>
    <div class="form-group" :class="[errors.password ? ' has-danger' : '']">
        <label for="password">Mot de passe</label>
        <input type="password" class="form-control" id="password" name="password" v-model="user.password">
        <div class="form-control-feedback" v-if="errors.password">{{ errors.password[0]}}</div>
    </div>
    <div class="form-group" :class="[errors.password_confirmation ? ' has-danger' : '']">
        <label for="password_confirmation">Confirmation du mot de passe</label>
        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation"
               v-model="user.password_confirmation">
        <div class="form-control-feedback" v-if="errors.password_confirmation">{{ errors.password_confirmation[0]}}
        </div>
    </div>
    <div class="form-group row">
        <div class="offset-md-10 col-sm-12 col-md-2">
            <button type="submit" class="btn btn-primary">S'inscrire</button>
        </div>
    </div>
</form>

</template>
<script>
    export default {
        data(){
            return {
                user: {
                    first_name: '',
                    last_name: '',
                    email: '',
                    password: '',
                    password_confirmation: ''
                },
                errors: {}
            }
        },
        mounted() {
            console.log('Component mounted.')
        },
        methods: {
            register_post(){
                HoldOn.open({theme: "sk-circle"});
                var self = this;
                this.errors = {};
                axios.post('/register', self.user).then(function (response) {
                    if (response.data.saved) {
                        HoldOn.close();
                        swal({
                            title: 'Félicitations',
                            text: 'Nous vous avons envoyé un mail pour valider votre compte',
                            type: 'success'
                        }).then(function () {
                            window.location.replace("/login");
                        }, function () {
                            window.location.replace("/login");
                        });
                    } else {
                        HoldOn.close();
                        swal({
                            title: 'Oops ...',
                            text: 'Un problème est survenu lors de votre inscription , veuillez réessayer ultérieurement.',
                            type: 'error'
                        }).then(function () {
                            window.location.replace("/");
                        }, function () {
                            window.location.replace("/");
                        });
                    }
                }).catch(function (errors) {
                    HoldOn.close();
                    self.errors = errors.response.data;
                });
            }
        }
    }
</script>
