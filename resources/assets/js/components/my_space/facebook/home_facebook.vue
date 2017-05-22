<template>
    <div>
        <hr>
        <div class="text-center" v-if="emptyDb && !isDisconnected"><h3 class="display-4" style="color: #3b5998;">
            <a href="/my_space/facebook/search"><i class="fa fa-battery-empty" aria-hidden="true"></i></a>
            Facebook</h3>
        </div>

        <div class="text-center" style="margin-bottom: 20px;" v-if="isDisconnected"><h3 class="display-4"
                                                                                        style="color: #3b5998;">
            <a href="/my_space/facebook"> <i class="fa fa-power-off" aria-hidden="true"></i></a>
           Facebook</h3>
        </div>


        <div class="card-deck" v-if="!isDisconnected && !emptyDb">
            <facebook-article v-for="article in show_ids" :key="article.id" :article_id="article.id"></facebook-article>
        </div>
        <div class="text-center">
            <div class="btn btn-outline-info" @click="nextPageGet()" v-if="isShowMore"
                 style="cursor: pointer; margin: 10px;"><i class="fa fa-plus-circle"></i></div>
        </div>
    </div>
</template>
<script>
    export default{
        data(){
            return {
                emptyDb: false,
                show_ids: [],
                db_ids: [],
                randoms: [],
                isShowMore: true,
                isDisconnected: false,
                accessToken: ''
            }
        },
        created(){
            let self = this;
            window.fbAsyncInit = function () {
                FB.init({
                    appId: '1675015296127584',
                    xfbml: true,
                    version: 'v2.9',
                    status: true,
                    cookie: true,
                });
                FB.getLoginStatus((response) => {
                    if (response.status === 'connected') {
                        self.isDisconnected = false;
                        self.accessToken = response.authResponse.accessToken;
                        self.makeShow();
                    } else {
                        self.isDisconnected = true;
                        self.accessToken = '';
                    }
                });
            };

            (function (d, s, id) {
                let js, fjs = d.getElementsByTagName(s)[0];
                if (d.getElementById(id)) {
                    return;
                }
                js = d.createElement(s);
                js.id = id;
                js.src = "//connect.facebook.net/fr_FR/sdk.js";
                fjs.parentNode.insertBefore(js, fjs);
            }(document, 'script', 'facebook-jssdk'));

        },
        methods: {
            makeShow(){
                let self = this;
                let db_ids = [];
                let shuffle = (a) => {
                    for (let i = a.length; i; i--) {
                        let j = Math.floor(Math.random() * i);
                        [a[i - 1], a[j]] = [a[j], a[i - 1]];
                    }
                };
                axios.get('/my_space/facebook/get_pages_ids')
                    .then(function (response) {
                        if (response.data.found) {
                            let random_ids = [];
                            let promises = [];
                            db_ids = response.data.pages;
                            self.db_ids = db_ids;
                            if (!db_ids.length > 0) {
                                this.emptyDb = true;
                            } else if (db_ids.length < 5) {
                                db_ids.forEach((id) => {
                                    let url = 'https://graph.facebook.com/v2.9/' + id + '/feed?fields=id&limit=18&access_token=' + self.accessToken;
                                    promises.push(axios.get(url));
                                });
                            } else {
                                let randoms = [];
                                for (let i = 0; i < 5; i++) {
                                    randoms.push(db_ids[Math.floor(Math.random() * db_ids.length)]);
                                }
                                randoms.forEach((id) => {
                                    let url = 'https://graph.facebook.com/v2.9/' + id + '/feed?fields=id&limit=18&accessToken=' + self.accessToken;
                                    promises.push(axios.get(url));
                                });
                            }
                            let randoms = [];
                            if (promises.length > 0) {
                                axios.all(promises).then(function (results) {
                                    results.forEach(function (response) {
                                        console.log(response);
                                        response.data.data.forEach(function (post) {
                                            randoms.push(post.id);
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
    //    fields=id,message,link,attachments{media}&limit=50
</script>