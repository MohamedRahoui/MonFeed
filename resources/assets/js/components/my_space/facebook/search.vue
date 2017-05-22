<template>
    <div>
        <hr>
        <p class="lead">* Suivre des pages Facebook</p>
        <hr>
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
            <facebook-page v-for="page in showPages" :key="page.id" :pageId="page.id" @followPage="followPage(page.id)"
                           :pages="dbPages"></facebook-page>
        </div>
        <div class="text-center" v-if="isShowMore && !empty" @click="nextPage">
            <div class="btn btn-outline-info" style="cursor: pointer;"><i class="fa fa-plus-circle"></i></div>
        </div>
        <div class="text-center" v-if="empty"><h3 class="display-4" style="color: #3b5998;">
            <i class="fa fa-ban" aria-hidden="true"></i>
           Aucune page n'est trouvée</h3>
        </div>
    </div>
</template>
<script>
    export default{
        data(){
            return {
                search: '',
                showPages: [],
                isShowMore: false,
                nextPageUrl: '',
                trueSearch: '',
                dbPages: [],
                empty: false

            }
        },
        created(){
            let self = this;
            axios.get('/my_space/facebook/get_pages_ids')
                .then((response) => {
                    self.dbPages = response.data.pages;
                })
                .catch((response) => {
                    console.log(response);
                    toastr.error('error');
                });
        },
        methods: {
            search_get(){
                this.trueSearch = this.search;
                let self = this;
                this.showPages = [];
                FB.api(
                    "/search",
                    "GET",
                    {
                        "q": self.search,
                        "type": "page",
                        "limit": 6,
                        "fields": 'id'
                    },
                    function (response) {
                        if (response && !response.error) {
                            if(response.data <= 0){
                                self.empty = true;
                            }
                            response.data.forEach((page) => {
                                self.showPages.push(
                                    {id: page.id}
                                )
                            });
                            if (response.paging.next) {
                                self.isShowMore = true;
                                self.nextPageUrl = response.paging.cursors.after;
                            } else {
                                self.isShowMore = false;
                                self.nextPageUrl = '';
                            }
                        } else {
                            toastr.error('Une erreur s\'est produite lors de la recherche');
                        }
                    }
                );
            }, nextPage(){
                let self = this;
                FB.api(
                    "/search",
                    "GET",
                    {
                        "q": self.trueSearch,
                        "type": "page",
                        "limit": 6,
                        "fields": 'id',
                        "after": self.nextPageUrl
                    },
                    function (response) {
                        if (response && !response.error) {
                            response.data.forEach((page) => {
                                self.showPages.push(
                                    {id: page.id}
                                )
                            });
                            if (response.paging.next) {
                                self.isShowMore = true;
                                self.nextPageUrl = response.paging.cursors.after;
                            } else {
                                self.isShowMore = false;
                                self.nextPageUrl = '';
                            }
                        } else {
                            toastr.error('Une erreur s\'est produite lors de la recherche');
                        }
                    }
                );
            },
            followPage(id){
                HoldOn.open({theme: "sk-circle"});
                let self = this;
                axios.post('/my_space/facebook/add_page', {id: id})
                    .then(function (response) {
                        if (response.data.added) {
                            toastr.success("Vous suivez désormais cette page");
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