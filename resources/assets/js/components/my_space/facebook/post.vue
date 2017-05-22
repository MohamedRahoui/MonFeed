<template>
    <div>
        <hr>
        <p class="lead" >* Publier sur votre mur Facebook</p>
        <hr>
        <form @submit.prevent="submitPost">
            <div class="form-group">
                <textarea class="form-control" v-model="content" rows="3" required></textarea>
            </div>
            <button class="btn btn-primary float-right" style="cursor: pointer;">Publier</button>
        </form>
    </div>
</template>
<script>
    export default{
        data(){
            return {
                content: ''
            }
        },
        methods: {
            submitPost(){
                let self = this;
                FB.api(
                    "/me/feed",
                    "POST",
                    {
                        "message": self.content
                    },
                    function (response) {
                        if (response && !response.error) {
                            toastr.success('Publication bien ajoutée a votre mur');
                            self.content = '';
                        }else{
                            toastr.error('Une erreur s\'est produite lors de la publication');
                        }
                    }
                );
            }
        }
    }
</script>