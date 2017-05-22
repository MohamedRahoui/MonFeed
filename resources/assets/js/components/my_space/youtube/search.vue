<template>
    <div class="container">
        <div class="input-group">
            <input type="text" v-model="search" class="form-control" placeholder="Cherchez ici ..."
                   v-on:keyup.enter="search_get">
            <span class="input-group-btn">
                <button @click="search_get" class="btn btn-secondary" type="button"><i
                        class="fa fa-search"></i></button>
            </span>
        </div>
        <br>
        <div class="card-deck">
            <video-id v-for="video in videos" :id="video.id" :videos="addedVideos" :key="video.id" @addVideo="addVideo(video.id)"></video-id>
        </div>

        <div class="text-center">
            <div class="btn btn-outline-danger" @click="nextPageGet()" v-if="isNextPage" style="cursor: pointer; margin: 10px;"><i class="fa fa-plus-circle"></i></div>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return {
                search: '',
                thisSearch: '',
                emptyResponse: false,
                videos: [],
                isNextPage: false,
                nextPageToken: '',
                addedVideos: []
            }
        },
        beforeMount(){
            let self = this;
            axios.get('/my_space/youtube/get_videos_ids')
                .then(function (response) {
                    if (response.data.found) {
                        self.addedVideos = response.data.videos;
                    }
                })
                .catch(function (response) {
                    console.log(response);
                });
        },
        methods: {
            search_get(){
                if (this.search) {
                    HoldOn.open({theme: "sk-circle"});
                    this.thisSearch = this.search;
                    let url = 'https://www.googleapis.com/youtube/v3/search?q=' + this.search + '&part=id&type=video&maxResults=6&key=AIzaSyDG2MYjLHqTQODJkOL44DCO364rxwlt7vE';
                    let self = this;
                    self.videos = [];
                    axios.get(url)
                        .then(function (response) {
                            let totalResults = response.data.pageInfo.totalResults;
                            if (totalResults > 6) {
                                self.isNextPage = true;
                                self.nextPageToken = response.data.nextPageToken;
                            } else {
                                self.isNextPage = false;
                                self.nextPageToken = '';
                            }
                            let responseVideos = response.data.items;
                            if (responseVideos.length > 0) {
                                self.emptyResponse = false;
                                responseVideos.forEach(function (video) {
                                    self.videos.push({id: video.id.videoId});
                                });
                            } else {
                                self.emptyResponse = true;
                            }
                            HoldOn.close();
                        })
                        .catch(function (error) {
                            console.log(error);
                            HoldOn.close();
                        });
                } else {
                    toastr.error('Veuillez remplire le champs avant de lancer la recherche.');
                }
            },
            nextPageGet(){
                HoldOn.open({theme: "sk-circle"});
                let url = 'https://www.googleapis.com/youtube/v3/search?q=' + this.thisSearch + '&part=id&type=video&maxResults=6&pageToken=' + this.nextPageToken + '&key=AIzaSyDG2MYjLHqTQODJkOL44DCO364rxwlt7vE'
                let self = this;
                axios.get(url)
                    .then(function (response) {
                        let totalResults = response.data.pageInfo.totalResults;
                        if (totalResults > 6) {
                            self.isNextPage = true;
                            self.nextPageToken = response.data.nextPageToken;
                        } else {
                            self.isNextPage = false;
                            self.nextPageToken = '';
                        }
                        let responseVideos = response.data.items;
                        if (responseVideos.length > 0) {
                            self.emptyResponse = false;
                            responseVideos.forEach(function (video) {
                                self.videos.push({id: video.id.videoId});
                            });
                        } else {
                            self.emptyResponse = true;
                        }
                        HoldOn.close();
                    })
                    .catch(function (error) {
                        console.log(error);
                        HoldOn.close();
                    });
            },
            addVideo(id){
                HoldOn.open({theme: "sk-circle"});
                let self = this;
                axios.post('/my_space/youtube/add_video', {id: id})
                    .then(function (response) {
                        if (response.data.added) {
                            self.isAdded = true;
                            toastr.success("Video Ajouté");
                            HoldOn.close();
                        }
                    })
                    .catch(function (error) {
                        console.log(error);
                        toastr.error('Veuillez actualiser la page et réessayer');
                        HoldOn.close();
                    });
            }
        }
    }
</script>
