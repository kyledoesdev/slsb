<template>

    <section class="section">
         <div v-if="this.status">
            <button @click="likePost" class="btn btn-secondary rounded-pill shadow-none mb-0" style="border-radius: 0em;">
                UnLike</button>
            <span v-text="countText"></span>
        </div>
        <div v-else>
            <button @click="likePost" class="btn btn-primary rounded-pill shadow-none mb-0" style="border-radius: 0em;">
                Like</button>
            <span v-text="countText"></span>
        </div>
    </section>

</template>

<script>

    import { EventBus } from '../app.js';

    export default {

        props: ['postId', 'likes', 'count'],

        data: function() {
            return {
                status: this.likes,
                likeCount: this.count,
            }
        },

        methods: {
            likePost() {
                if (!this.status) {
                    axios.post('/like/' + this.postId)
                    .then(response => {
                        this.status = !this.status;
                        this.likeCount = response.data.count;
                        EventBus.$emit('like', this.likeCount);
                        EventBus.$emit('totalLikes', response.data.totalCount);
                    })
                    .catch(error => {
                        console.log(error);
                    });
                }
                if (this.status) {
                    axios.post('/unlike/' + this.postId)
                    .then(response => {
                        this.status = !this.status;
                        this.likeCount = response.data.count;
                        EventBus.$emit('like', this.likeCount);
                        EventBus.$emit('totalLikes', response.data.totalCount);
                    })
                    .catch(error => {
                        console.log(error);
                    });
                }
            },
        },

        computed: {
            countText() {
                if (this.likeCount == 1) {
                    return this.likeCount + " Like";
                }

                return this.likeCount + " Likes";
            }
        },
    };
</script>
