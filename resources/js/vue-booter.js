import { createApp } from 'vue';
import mitt from 'mitt';

import Follow  from './Components/Follow.vue';
import FollowCounter  from './Components/FollowCounter.vue';
import Like from './Components/Like.vue';
import LikeCounter from './Components/LikeCounter.vue';
import CategorySearch from './Components/CategorySearch.vue';
import GameResult from './Components/GameResult.vue';
import FavoriteGamesTab from './Components/FavoriteGamesTab.vue';
import Rating from './Components/Rating.vue';
import Dashboard from './Components/Dashboard.vue';

const emitter = mitt();
const app = createApp({});
app.config.globalProperties.emitter = emitter

app.component('like', Like);
app.component('likecounter', LikeCounter);
app.component('follow', Follow);
app.component('followcounter', FollowCounter);
app.component('categorysearch', CategorySearch);
app.component('gameresult', GameResult);
app.component('favoritegamestab', FavoriteGamesTab);
app.component('rating', Rating);
app.component('dashboard', Dashboard);

app.mount('#app');