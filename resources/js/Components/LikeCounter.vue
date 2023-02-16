<template>

    <section class="section">
        <div class="mt-2">
            <span v-text="likesText"></span>
        </div>
    </section>

</template>

<script lang="js">
    export default {

        props: ['likeCount'],

        data: function() {
            return {
                likes: this.likeCount,
            }
        },

        created() {
            this.emitter.emit('totalLikes', (data) => {
                this.likes = data;
            });

        },

        computed: {
            likesText() {
                return "Total Likes: " + this.likes;
            },
        }
    };
</script>
