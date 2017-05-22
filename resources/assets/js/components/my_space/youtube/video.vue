<template>
    <div class="col-md-4" style="margin-bottom: 20px;">
        <div class="card" style="height: 100%;">
            <div class="embed-responsive embed-responsive-16by9 card-img-top">
                <iframe class="embed-responsive-item"
                        :src="'http://www.youtube.com/embed/'+id+'?autohide=true&autoplay=auto&color=%23444444&hq=true&rel=false&showinfo=false'"
                        frameborder="0" scrolling="no" webkitallowfullscreen=""
                        mozallowfullscreen="" allowfullscreen=""></iframe>
            </div>
            <div class="card-block">
                <h4 class="card-title">{{channel_title}} <i class="fa fa-youtube-play float-right" style="color: #E52929;"></i></h4>

                <p class="card-text">{{title}}</p>
            </div>
            <div class="card-footer">
                <div class="float-right" v-if="!isAdded">
                    <div @click="triggerAdd" class="btn btn-secondary ">
                        <i class="fa fa-plus-circle text-success" aria-hidden="true"></i>
                    </div>
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
        props: {
            id: {
                type: String,
                required: true
            },
            videos: {
                type: Array,
                required: true
            }
        },
        data(){
            return {
                title: '',
                channel_title: '',
                date: '',
                views: '',
                isAdded: false,
            }
        },
        created(){
            if (this.videos.length > 0) {
                if ($.inArray(this.id, this.videos) > -1) {
                    this.isAdded = true;
                } else {
                    this.isAdded = false;
                }
            } else {
                this.isAdded = false;
            }


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
            triggerAdd(){
                this.isAdded = true;
                this.$emit('addVideo');
            }
        }

    }
</script>
