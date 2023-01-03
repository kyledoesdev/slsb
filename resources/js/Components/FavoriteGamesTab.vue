<template>
    <div class="col mx-2" v-for="game in favorites" :key="game.game_id">
        <gameresult
            :gameid="game.game_id"
            :gamename="game.game_title"
            :gameboxarturl="game.box_art_url"
            :profileusername="this.profileusername"
            :authusername="this.authusername"
            :storeroute="this.storeroute"
            :deleteroute="this.deleteroute"
            :addMode="false"
        >
        </gameresult>
    </div>
</template>

<script lang="js">

    export default {

        props: ['games', 'storeroute', 'deleteroute', 'profileusername', 'authusername'],

        data: function() {
            return {
                favorites: this.games
            }
        },

        created() {
            this.emitter.on('gameadded', (data) => {
                this.favorites = data;
            });

            this.emitter.on('gamedeleted', (data) => {
                this.favorites = data;
            });
        }

    }

</script>