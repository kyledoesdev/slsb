<template>
    <div class="col mx-2">
        <div class="col">
            <div class="row d-flex justify-content-center">
                <div class="col-md-auto d-flex justify-content-center mt-4">
                    <h4>{{ this.gamename }}</h4>
                </div>
            </div>
            <div class="col d-flex justify-content-center m-0 p-0">
                <img class="mb-2" :src="getImageSrc()" :alt="this.gamename">
                <button 
                    v-if="this.profileusername === this.authusername"
                    @click="isAddMode ? addGame() : deleteGame()"
                    :class="actionButtonClass" 
                    class="border-2 border-dark"
                    style="max-height: 30px; transform: translate(-115%, 15%);"
                    type="button"
                >
                    <i :class="isAddMode ? 'fa fa-plus' : 'fa fa-times'"></i>
                </button>
            </div>
        </div>
    </div>
    
</template>

<script lang="js">

    export default {

        props: ['storeroute', 'deleteroute', 'gameid', 'gamename', 'gameboxarturl', 'profileusername', 'authusername', 'addMode'],

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
                if (this.profileusername === this.authusername) {
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
                if (this.profileusername === this.authusername) {
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