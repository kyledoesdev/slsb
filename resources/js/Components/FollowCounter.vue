<template>

    <section class="section">
        <span>
            <a 
                :href="this.userFollowersList" 
                class="btn btn-primary btn-sm border border-2 border-dark mx-1" 
                style="text-decoration: none;">
                Followers: 
                    <span class="fw-bold" v-text="followersText"></span>
            </a>
        </span>
        <span>
            <a 
                :href="this.userFollowingList" 
                class="btn btn-secondary btn-sm border border-2 border-dark" 
                style="text-decoration: none;">
                Following: 
                    <span class="fw-bold" v-text="followingText"></span>
            </a>
        </span>
    </section>

</template>

<script>

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
            this.emitter.on('followers', (data) => {
                this.followers = data;
            });

            this.emitter.on('following', (data) => {
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
