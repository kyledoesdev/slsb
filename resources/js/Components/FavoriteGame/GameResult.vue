<template>
    <h5>{{ this.gamename }}</h5>
    <img 
        class="border border-2 border-dark mb-2" 
        :src="getImageSrc()" 
        :alt="this.gamename" 
        width="142" 
        height="190"
    >
    <!-- For an unauthenticated user, profileusername is set, and authusername is null -->
    <button 
        v-if="this.profileusername === this.authUserName"
        @click="isAddMode ? addGame() : deleteGame()"
        :class="actionButtonClass" 
        class="border-2 border-dark"
        style="max-height: 30px; transform: translate(-115%, -250%);"
        type="button"
    >
        <i :class="isAddMode ? 'fa fa-plus' : 'fa fa-times'"></i>
    </button>
</template>

<script lang="js">

    export default {
        name: 'GameResult',
        props: ['storeroute', 'deleteroute', 'gameid', 'gamename', 'gameboxarturl', 'profileusername', 'addMode'],

        data: function() {
            return {
                actionButtonClass: 'btn btn-sm btn-primary',
                isAddMode: this.addMode,
            }
        },

        methods: {
            getImageSrc() {
                return "https://static-cdn.jtvnw.net/ttv-boxart/"+this.gameid+"-285x380.jpg";
            },

            addGame() {
                if (this.profileusername === this.authUserName) {
                    axios.post(this.storeroute, {
                        'game_id': this.gameid,
                        'game_title': this.gamename,
                        'box_art_url': this.gameboxarturl,
                        'username': this.profileusername
                    })
                    .then(response => {
                        const data = response.data;

                        if (data) {
                            if (data.type === 'tooManyGames') {
                                alert('You can only have 9 favorite games.');
                                this.emitter.emit('resetresults');
                                return;
                            }

                            this.emitter.emit('gameadded', data.games)
                            this.actionButtonClass = 'btn btn-sm btn-secondary';
                            this.isAddMode = ! this.isAddMode;
                        }
                    }).catch(error => {
                        
                    });
                }
            },

            deleteGame() {
                if (this.profileusername === this.authUserName) {
                    console.log(this.gameid);
                    axios.post(this.deleteroute, {
                        'game_id': this.gameid,
                        'username': this.profileusername
                    })
                    .then(response => {
                        this.emitter.emit('gamedeleted', response.data.games);
                        this.actionButtonClass = 'btn btn-sm btn-primary';
                        this.isAddMode = ! this.isAddMode;
                    })
                    .catch(error => {

                    });
                }
            }
        },

    }
</script>