require('./bootstrap');

import Editor from '@toast-ui/editor';
import 'codemirror/lib/codemirror.css';
import '@toast-ui/editor/dist/toastui-editor.css';

window.Vue = require('vue').default;
window.axios = require('axios');
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

Vue.component('like', () => import('../js/Components/Like.vue'));
Vue.component('follow', () => import('../js/Components/Follow.vue'));
Vue.component('followcounter', () => import('../js/Components/FollowCounter.vue'));
Vue.component('likecounter', () => import('../js/Components/LikeCounter.vue'));

export const EventBus = new Vue();

const app = new Vue({
    el:'#app'
});

/**
 * Utilizes the "Toast-UI markdown editor"
 *  This allows the editor js assets to be accessed globally rather than repeated throughout the app.
 */

const editor = new Editor({
    el: document.querySelector('#editor'),
    height: '400px',
    initialEditType: 'markdown',
});

if (document.querySelector('#createPostForm')) {
    document.querySelector('#createPostForm').addEventListener('submit', e => {
        e.preventDefault();
        document.querySelector('#content').value = editor.getMarkdown();
        e.target.submit();
    });
}


