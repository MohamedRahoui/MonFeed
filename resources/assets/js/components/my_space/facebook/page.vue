<template>
    <div class="col-md-4" style="margin-bottom: 20px;">
        <div class="card" style="height: 100%;">
            <img class="card-img-top" height="180" :src="coverUrl" :alt="pageName">
            <div class="card-block">
                <h4 class="card-title">{{pageName}} <a :href="link" target="_blank" class="float-right"><img class="img-thumbnail" width="50" :src="imgUrl" :alt="pageName"></a></h4>
                <p class="card-text" style="overflow: auto;">{{about}}</p>
            </div>
            <div class="card-footer">
                <small class="text-muted float-left"><i class="fa fa-heart" aria-hidden="true"></i> :  {{fanCount}}</small>
                <div class="float-right" v-if="!isDestroyed && !isAdded" style="cursor: pointer;" @click="triggerFollow" >
                    <div class="btn btn-secondary">
                        <i class="fa fa-plus-circle" style="color: #3b5998;" aria-hidden="true"></i> Suivre
                    </div>
                </div>
                <div class="float-right" v-if="!isDestroyed && isAdded" style="cursor: pointer;" >
                    <div class="btn btn-secondary disabled">
                        <i class="fa fa-check text-success" aria-hidden="true"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    export default{
        props: {
            pageId: {
                type: String,
                required: true
            },
            pages: {
                type: Array,
                required: false
            }
        },
        data()
        {
            return {
                coverUrl: '',
                imgUrl: '',
                pageName: '',
                about: '',
                fanCount: '',
                link: '',
                isDestroyed: false,
                isAdded: false,
            }
        }
        ,
        created()
        {
            if (this.pages) {
                this.isAdded = $.inArray(this.pageId, this.pages) > -1;
            } else {
                this.isAdded = false;
            }

            let self = this;
            FB.api(
                "/" + self.pageId,
                "GET",
                {
                    "fields": 'id,name,about,fan_count,link,cover'
                },
                function (response) {
                    if (response && !response.error) {
                        if(!response.about && !response.cover){
                            self.isDestroyed = true;
                        }
                        if(!response.cover){
                            self.coverUrl = '/img/default.gif';
                        }else {
                            self.coverUrl = response.cover.source;
                        }
                        self.pageName = response.name;
                        self.about = response.about;
                        self.link = response.link;
                        self.fanCount = Intl.NumberFormat().format(response.fan_count);
                    } else {
                        toastr.error('Erreur');
                    }
                }
            );
            FB.api(
                "/" + self.pageId + "/picture",
                "GET",
                {
                    "height": '50',
                    "width": '50'
                },
                function (response) {
                    if (response && !response.error) {
                        self.imgUrl = response.data.url
                    } else {
                        toastr.error('Erreur');
                    }
                }
            );
        },
        methods: {
            triggerFollow(){
                this.isAdded = true;
                this.$emit('followPage');
            }
        }
    }
</script>