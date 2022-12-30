import { createApp } from 'vue';
import mitt from 'mitt';

import Follow  from './Components/Follow.vue';
import FollowCounter  from './Components/FollowCounter.vue';
import Like from './Components/Like.vue';
import LikeCounter from './Components/LikeCounter.vue';

const emitter = mitt();
const app = createApp({});
app.config.globalProperties.emitter = emitter

app.component('like', Like);
app.component('likecounter', LikeCounter);
app.component('follow', Follow);
app.component('followcounter', FollowCounter);

app.mount('#app');