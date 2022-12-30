<template>

    <section class="section">
         <div v-if="this.status">
            <button @click="likePost" class="btn btn-secondary rounded-pill shadow-none mb-0" style="border-radius: 0em;">
                <i class="fa-solid fa-thumbs-up"></i>
            </button>
            <span v-text="countText"></span>
        </div>
        <div v-else>
            <button @click="likePost" class="btn btn-primary rounded-pill shadow-none mb-0" style="border-radius: 0em;">
                <i class="fa-regular fa-thumbs-up"></i>
            </button>
            <span v-text="countText"></span>
        </div>
    </section>

</template>

<script>

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
                        this.emitter.emit('like', this.likeCount);
                        this.emitter.emit('totalLikes', response.data.totalCount);
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
                        this.emitter.emit('like', this.likeCount);
                        this.emitter.emit('totalLikes', response.data.totalCount);
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
