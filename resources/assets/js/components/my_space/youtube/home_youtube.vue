<template>
    <div>
        <div class="text-center" v-if="emptyDb"><h3 class="display-4 text-danger">
            <a href="/my_space/youtube" class="text-danger"><i class="fa fa-battery-empty"
                                            aria-hidden="true"></i></a>
            Youtube</h3>
        </div>
        <div class="card-deck">
            <video-id v-for="video in show_ids" :id="video.id" :key="video.id" :videos="db_ids"
                      @addVideo="addVideo(video.id)"></video-id>
        </div>

        <div class="text-center">
            <div class="btn btn-outline-danger" @click="nextPageGet()" v-if="isShowMore"
                 style="cursor: pointer; margin: 10px;"><i class="fa fa-plus-circle"></i></div>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return {
                emptyDb: false,
                show_ids: [],
                db_ids: [],
                randoms: [],
                isShowMore: true,
            }
        },
        created(){
            let self = this;
            let db_ids = [];
            let shuffle = (a) => {
                for (let i = a.length; i; i--) {
                    let j = Math.floor(Math.random() * i);
                    [a[i - 1], a[j]] = [a[j], a[i - 1]];
                }
            };
            axios.get('/my_space/youtube/get_videos_ids')
                .then(function (response) {
                    if (response.data.found) {
                        let random_ids = [];
                        let promises = [];
                        db_ids = response.data.videos;
                        self.db_ids = db_ids;
                        if (!db_ids.length > 0) {
                            this.emptyDb = true;
                        } else if (db_ids.length < 5) {
                            db_ids.forEach((id) => {
                                let url = 'https://www.googleapis.com/youtube/v3/search?relatedToVideoId=' + id + '&part=id&type=video&maxResults=18&key=AIzaSyDG2MYjLHqTQODJkOL44DCO364rxwlt7vE';
                                promises.push(axios.get(url));
                            });
                        } else {
                            let randoms = [];
                            for (let i = 0; i < 5; i++) {
                                randoms.push(db_ids[Math.floor(Math.random() * db_ids.length)]);
                            }
                            randoms.forEach((id) => {
                                let url = 'https://www.googleapis.com/youtube/v3/search?relatedToVideoId=' + id + '&part=id&type=video&maxResults=18&key=AIzaSyDG2MYjLHqTQODJkOL44DCO364rxwlt7vE';
                                promises.push(axios.get(url));
                            });
                        }
                        let randoms = [];
                        if (promises.length > 0) {
                            axios.all(promises).then(function (results) {
                                results.forEach(function (response) {
                                    response.data.items.forEach(function (video) {
                                        randoms.push(video.id.videoId);
                                    });
                                });
                                shuffle(randoms);
                                self.randoms = randoms;
                                for (let i = 0; i < 6; i++) {
                                    self.show_ids.push({id: self.randoms[i]});
                                    self.randoms.splice(i, 1);
                                }
                            });

                        } else {
                            self.emptyDb = true;
                        }

                    } else {
                        self.emptyDb = true;
                        self.isShowMore = false;
                    }
                })
                .catch(function (response) {
                    console.log(response);
                });


        },
        methods: {
            addVideo(id){
                HoldOn.open({theme: "sk-circle"});
                let self = this;
                axios.post('/my_space/youtube/add_video', {id: id})
                    .then(function (response) {
                        if (response.data.added) {
                            toastr.success("Video Ajouté");
                            HoldOn.close();
                        }
                    })
                    .catch(function (error) {
                        console.log(error);
                        toastr.error('Veuillez actualiser la page et réessayer');
                        HoldOn.close();
                    });
            },
            nextPageGet(){
                if (this.randoms.length <= 0) {
                    this.isShowMore = false;
                } else {
                    this.randoms.some((id, index, _ary) => {
                        this.show_ids.push({id: id});
                        this.randoms.splice(index, 1);
                        return index === 5;
                    });
                }

            }


        }
    }
</script>
