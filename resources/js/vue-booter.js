import { createApp } from 'vue';
import mitt from 'mitt';

import flash from './Modules/flash';
import globals from './Modules/globals';

import Follow  from './Components/Follow.vue';
import FollowCounter  from './Components/FollowCounter.vue';
import Like from './Components/Like.vue';
import LikeCounter from './Components/LikeCounter.vue';
import CategorySearch from './Components/CategorySearch.vue';
import GameResult from './Components/GameResult.vue';
import FavoriteGamesTab from './Components/FavoriteGamesTab.vue';
import RatingButtonGroup from './Components/RatingButtonGroup.vue';
import Dashboard from './Components/Dashboard.vue';
import PostEditor from './Components/PostEditor.vue';
import PCSpecs from './Components/PCSpecs.vue';
import PCPart from './Components/PCPart.vue';

const emitter = mitt();
const app = createApp({});
app.config.globalProperties.emitter = emitter

//Register modules
app.mixin(flash);
app.mixin(globals);

//Register components
app.component('like', Like);
app.component('likecounter', LikeCounter);
app.component('follow', Follow);
app.component('followcounter', FollowCounter);
app.component('categorysearch', CategorySearch);
app.component('gameresult', GameResult);
app.component('favoritegamestab', FavoriteGamesTab);
app.component('ratingbtngroup', RatingButtonGroup);
app.component('dashboard', Dashboard);
app.component('posteditor', PostEditor);
app.component('pcspecs', PCSpecs);
app.component('pcpart', PCPart);

app.mount('#app');