require('./bootstrap');

// register
Vue.component('register', require('./components/auth/register.vue'));

// login
Vue.component('login', require('./components/auth/login.vue'));

// Single Video by id
Vue.component('video-id', require('./components/my_space/youtube/video.vue'));

// My video
Vue.component('my-video', require('./components/my_space/youtube/my-video.vue'));

// youtube search
Vue.component('youtube-search', require('./components/my_space/youtube/search.vue'));

// youtube home
Vue.component('home-youtube', require('./components/my_space/youtube/home_youtube.vue'));

// facebook home
Vue.component('facebook-nav', require('./components/my_space/facebook/nav.vue'));

// facebook post form
Vue.component('facebook-post', require('./components/my_space/facebook/post.vue'));

// facebook pages search
Vue.component('facebook-search', require('./components/my_space/facebook/search.vue'));

// facebook single page
Vue.component('facebook-page', require('./components/my_space/facebook/page.vue'));

// facebook my page
Vue.component('facebook-my-page', require('./components/my_space/facebook/my-page.vue'));

// facebook article
Vue.component('facebook-article', require('./components/my_space/facebook/article.vue'));

// facebook home pge
Vue.component('home-facebook', require('./components/my_space/facebook/home_facebook.vue'));

const app = new Vue({
    el: '#app'
});
