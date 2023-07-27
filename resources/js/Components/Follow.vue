<template>
    <section>
        <button id="follow-button" class="btn btn-primary rounded-pill border border-2 border-warning" @click="updateFollowing">
            <i :class="followingButtonText"></i>
        </button>
    </section>
</template>

<script lang="js">

    export default {
        name: 'Follow',
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
                        this.emitter.emit('followers', this.followers);
                        this.emitter.emit('following', this.following);
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
                        this.emitter.emit('followers', this.followers);
                        this.emitter.emit('following', this.following);
                    })
                    .catch(error => {
                        console.log(error);
                    });
                }
            },

        },

        computed: {
            followingButtonText() {
                return (this.status) ? 'fa-solid fa-xmark' : 'fa-solid fa-check';
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
