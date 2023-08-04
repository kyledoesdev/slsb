import { createApp } from 'vue';
import mitt from 'mitt';

//Global mixins
import flash from './Modules/flash';
import globals from './Modules/globals';

//Toast
import Toast from './Components/Global/Toast.vue';

//follows
import Follow from './Components/Follows/Follow.vue';
import FollowCounter  from './Components/Follows/FollowCounter.vue';

//likes
import Like from './Components/Likes/Like.vue';
import LikeCounter from './Components/Likes/LikeCounter.vue';

//favorite games
import CategorySearch from './Components/FavoriteGame/CategorySearch.vue';
import GameResult from './Components/FavoriteGame/GameResult.vue';
import FavoriteGamesTab from './Components/FavoriteGame/FavoriteGamesTab.vue';

//pc specs
import PCSpecs from './Components/PCSpecs/PCSpecs.vue';
import PCPart from './Components/PCSpecs/PCPart.vue';

//posts
import CreatePost from './Components/Posts/CreatePost.vue';
import EditPost from './Components/Posts/EditPost.vue';

import RatingButtonGroup from './Components/RatingBar.vue';
import Dashboard from './Components/Dashboard.vue';

const emitter = mitt();
const app = createApp({});
app.config.globalProperties.emitter = emitter

//Register modules
app.mixin(flash);
app.mixin(globals);

//Register components
app.component('toast', Toast);
app.component('like', Like);
app.component('likecounter', LikeCounter);
app.component('follow', Follow);
app.component('followcounter', FollowCounter);
app.component('categorysearch', CategorySearch);
app.component('gameresult', GameResult);
app.component('favoritegamestab', FavoriteGamesTab);
app.component('ratingbar', RatingButtonGroup);
app.component('dashboard', Dashboard);
app.component('createpost', CreatePost);
app.component('editpost', EditPost);
app.component('pcspecs', PCSpecs);
app.component('pcpart', PCPart);

app.mount('#app');