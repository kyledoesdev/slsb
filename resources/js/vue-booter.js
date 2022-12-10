window.Vue = require('vue').default;
window.axios = require('axios');
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/**
 * Register Vue components here.
 */
Vue.component('like', () => import('../js/Components/Like.vue'));
Vue.component('follow', () => import('../js/Components/Follow.vue'));
Vue.component('followcounter', () => import('../js/Components/FollowCounter.vue'));
Vue.component('likecounter', () => import('../js/Components/LikeCounter.vue'));

export const EventBus = new Vue();

const app = new Vue({
    el:'#app'
});