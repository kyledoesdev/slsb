<template>

    <section class="section">
        <div>
            <span v-text="likesText"></span>
        </div>
    </section>

</template>

<script>

    import { EventBus } from '../app.js';

    export default {

        props: ['likeCount'],

        data: function() {
            return {
                likes: this.likeCount,
            }
        },

        created() {
            EventBus.$on('totalLikes', (data) => {
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
