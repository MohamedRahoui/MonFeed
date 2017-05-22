<template>
    <div class="col-md-4" style="margin-bottom: 20px;" v-if="!isDeleted">
        <div class="card" style="height: 100%;">
            <div class="embed-responsive embed-responsive-16by9 card-img-top">
                <iframe class="embed-responsive-item"
                        :src="'http://www.youtube.com/embed/'+id+'?autohide=true&autoplay=auto&color=%23444444&hq=true&rel=false&showinfo=false'"
                        frameborder="0" scrolling="no" webkitallowfullscreen=""
                        mozallowfullscreen="" allowfullscreen=""></iframe>
            </div>
            <div class="card-block">
                <h4 class="card-title">{{channel_title}}</h4>
                <p class="card-text">{{title}}</p>
            </div>
            <div class="card-footer">
                <div class="float-right">
                    <div class="btn btn-secondary" @click="delete_video" style="cursor: pointer;"><i
                            class="fa fa-trash text-danger"></i> </div>
                </div>
                <small class="text-muted float-left"><i class="fa fa-calendar" aria-hidden="true"></i> :  {{date}}
                </small>
                <br>
                <small class="text-muted float-left"><i class="fa fa-eye" aria-hidden="true"></i> :  {{views}}</small>

            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['id', 'db_key'],
        data(){
            return {
                title: '',
                channel_title: '',
                date: '',
                views: '',
                isDeleted: false,
                label: '',

            }
        },
        created(){
            let emptyString = "";
            let alphabet = "abcdefghijklmnopqrstuvwxyz";
            while (emptyString.length < 6) {
                emptyString += alphabet[Math.floor(Math.random() * alphabet.length)];
            }
            this.label = emptyString;
            let id = this.id;
            let url = "https://www.googleapis.com/youtube/v3/videos?id=" + id + "&key=AIzaSyDG2MYjLHqTQODJkOL44DCO364rxwlt7vE&part=snippet,contentDetails,statistics";
            let self = this;
            axios.get(url)
                .then(function (response) {
                    self.channel_title = response.data.items[0].snippet.channelTitle;
                    self.title = response.data.items[0].snippet.title;
                    self.date = formatDate(response.data.items[0].snippet.publishedAt);
                    self.views = Intl.NumberFormat().format(response.data.items[0].statistics.viewCount);
                })
                .catch(function (error) {
                    console.log(error);
                });

        },
        methods: {
            delete_video(event){
                if (event) event.preventDefault();
                HoldOn.open({theme: 'sk-circle'});
                let self = this;
                axios.post('/my_space/youtube/delete_video_by_key', {key: self.db_key})
                    .then(function (response) {
                        if (response.data.deleted) {
                            self.isDeleted = true;
                            toastr.success('Video supprimée avec succès');
                        }
                        console.log(response.data);
                        HoldOn.close();
                    })
                    .catch(function (error) {
                        HoldOn.close();
                        console.log(error);
                    });
            }
        }

    }
</script>
