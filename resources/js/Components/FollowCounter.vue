<template>

    <section class="section">
        <div>
            <span><a :href="this.userFollowersList">Followers</a>: <span class="fw-bold" v-text="followersText"></span></span>
            <span><a :href="this.userFollowingList">Following</a>: <span class="fw-bold" v-text="followingText"></span></span>
        </div>
    </section>

</template>

<script>

    import { EventBus } from '../app.js';

    export default {

        props: ['followersCount', 'followingCount', 'followersList', 'followingList'],

        data: function() {
            return {
                followers: this.followersCount,
                following: this.followingCount,
                userFollowersList: this.followersList,
                userFollowingList: this.followingList,
            }
        },

        created() {
            EventBus.$on('followers', (data) => {
                this.followers = data;
            });

            EventBus.$on('following', (data) => {
                this.following = data;
            })
        },

        computed: {
            followersText() {
                return this.followers;
            },

            followingText() {
                return this.following;
            }
        }
    };
</script>
