<template>

    <section>
        <button id="follow-button" class="btn btn-primary rounded-pill border border-2 border-warning" @click="updateFollowing" v-text="followingButtonText"></button>
    </section>

</template>

<script>
    import { EventBus } from '../app.js';

    export default {

        props: ['userId', 'state', 'followersCount', 'followingCount'],

        data: function() {
            return {
                status: this.state,
                followers: this.followersCount,
                following: this.followingCount,
            }
        },

        methods: {
            updateFollowing() {
                if (!this.status) {
                    axios.post('/follow/' + this.userId)
                    .then(response => {
                        this.status = !this.status;
                        this.followers = response.data.followersCount;
                        this.following = response.data.followingCount;
                        EventBus.$emit('followers', this.followers);
                        EventBus.$emit('following', this.following);
                    })
                    .catch(error => {
                        console.log(error);
                    });
                }
                if(this.status) {
                    axios.post('/unfollow/' + this.userId)
                    .then(response => {
                        this.status = !this.status;
                        this.followers = response.data.followersCount;
                        this.following = response.data.followingCount;
                        EventBus.$emit('followers', this.followers);
                        EventBus.$emit('following', this.following);
                    })
                    .catch(error => {
                        console.log(error);
                    });
                }
            },

        },

        mounted() {

        },

        computed: {
            followingButtonText() {
                return (this.status) ? 'Unfollow' : 'Follow';
            },

            followersText() {
                return "Followers: " + this.followers;
            },

            followingText() {
                return "Following: " + this.following;
            }
        }
    };
</script>
