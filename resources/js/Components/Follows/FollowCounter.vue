<template>

    <section class="mt-2">
        <span>
            <a 
                :href="this.userFollowersList" 
                class="underline-on-hover px-1" 
                style="color: black;">
                Followers: <span class="fw-bold" v-text="followersText"></span>
            </a>
        </span>
        <span>
            <a 
                :href="this.userFollowingList" 
                class="underline-on-hover" 
                style=" color: black">
                Following: <span class="fw-bold" v-text="followingText"></span>
            </a>
        </span>
    </section>

</template>

<script lang="js">
    export default {
        name: 'FollowCounter',
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

<style>
    /* Define the default styles */
    .underline-on-hover {
        text-decoration: none; /* Remove the underline by default */
        transition: text-decoration 0.3s ease; /* Optional: Add a smooth transition */
    }

    /* Apply the underline on hover */
    .underline-on-hover:hover {
        text-decoration: underline; /* Add underline on hover */
    }
</style>
