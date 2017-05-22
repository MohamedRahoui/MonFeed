<template>
    <div class="col-md-4" style="margin-bottom: 20px;">
        <div class="card" style="height: 100%;">
            <img class="card-img-top" height="180" :src="url">
            <div class="card-block">
                <h4 class="card-title"><i class="fa fa-facebook-official float-right" style="color: #3b5998;"></i></h4>
                <p class="card-text" style="overflow: auto;">{{message}}</p>
            </div>
            <div class="card-footer" v-if="link">
                <a  :href="link" target="_blank" class="card-link float-right"><i class="fa fa-info-circle"></i> Plus de détails</a>
            </div>
        </div>
    </div>
</template>
<script>
    export default{
        props: {
            article_id: {
                type: String,
                required: true
            }
        },
        data(){
            return {
                message: '',
                link: '',
                url:''
            }
        },
        created(){
            let self = this;
            FB.api(
                "/" + self.article_id,
                "GET",
                {
                    "fields": 'id,message,link,attachments{media}'
                },
                function (response) {
                    if (response && !response.error) {
                        if(!response.attachments){
                            self.url = '/img/default.gif';
                        }else {
                            self.url = response.attachments.data[0].media.image.src;
                        }
                        self.message = response.message;
                        self.link = response.link;
                    } else {
                        toastr.error('Erreur');
                    }
                }
            );
        }
    }
</script>