<template>
    <div class="col-md-4" style="margin-bottom: 20px;" v-if="!isDeleted">
        <div class="card" style="height: 100%;">
            <img class="card-img-top" height="180" :src="coverUrl" :alt="pageName">
            <div class="card-block">
                <h4 class="card-title">{{pageName}} <a :href="link" target="_blank" class="float-right"><img class="img-thumbnail" width="50" :src="imgUrl" :alt="pageName"></a></h4>
                <p class="card-text" style="overflow: auto;">{{about}}</p>
            </div>
            <div class="card-footer">
                <small class="text-muted float-left"><i class="fa fa-heart" aria-hidden="true"></i> :  {{fanCount}}</small>
                <div class="float-right" style="cursor: pointer;" @click="triggerDelete" >
                    <div class="btn btn-secondary">
                        <i class="fa fa-trash text-danger" aria-hidden="true"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    export default{
        props: {
            page_id: {
                type: String,
                required: true
            },
            page_key: {
                type: String,
                required: true
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
                isDeleted: false
            }
        }
        ,
        created()
        {
            let self = this;
            FB.api(
                "/" + self.page_id,
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
                "/" + self.page_id + "/picture",
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
            triggerDelete(){
                HoldOn.open({theme: 'sk-circle'});
                let self = this;
                axios.post('/my_space/facebook/delete_page_by_key', {key: self.page_key})
                    .then(function (response) {
                        if (response.data.deleted) {
                            self.isDeleted = true;
                            toastr.success('Vous ne suivez plus cette page');
                        }
                        HoldOn.close();
                    })
                    .catch(function (error) {
                        HoldOn.close();
                    });
            }
        }
    }
</script>