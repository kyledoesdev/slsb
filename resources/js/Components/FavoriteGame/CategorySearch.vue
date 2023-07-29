<template>
    <section>
        <div class="modal fade" id="favoriteGames" tabindex="-1" aria-labelledby="favoriteGamesLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="favoriteGamesLabel">Add a new favorite game.</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="col">
                            <form method="GET" v-on:submit.prevent>
                                <h5 class="mb-0">Search for a game and add it to your favorite games section.</h5>
                                <div class="input-group mt-1">
                                    <input type="text" class="form-control" id="game-input" placeholder="Enter A Game" v-model="gameinput">
                                    <div class="input-group-append">
                                        <button type="button" class="btn btn-primary" id="submit-game-input" @click="search">
                                            <i class="fa fa-search"></i>
                                        </button>
                                        <button type="button" class="btn btn-dark" @click="reset">
                                            <i class="fa fa-redo"></i>
                                        </button>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-auto" v-for="(game, index) in games" :key="index">
                                            <gameresult
                                                :gameid="game.gameid"
                                                :gamename="game.gamename"
                                                :gameboxarturl="game.gameboxarturl"
                                                :profileusername="this.profileusername"
                                                :storeroute="this.storeroute"
                                                :deleteroute="this.deleteroute"
                                                :addMode="true"
                                            >
                                            </gameresult>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script lang="js">

    export default {
        name: 'CategorySearch',
        props: ['searchroute', 'storeroute', 'deleteroute', 'profileusername'],

        data: function() {
            return {
                gameinput: "",
                games: [],
            }
        },

        methods: {
            reset() {
                this.gameinput = "";
                this.games = [];
            },

            search() {
                this.games = [];
                const searchterm = this.gameinput;
                const url = this.searchroute;

                if (searchterm && searchterm != '') {
                    axios.get(url, {
                        params: {
                            'search-term': searchterm,
                        }
                    })
                    .then(response => {
                        const data = response.data;

                        if (data.length > 0) {
                            data.forEach(element => {
                                this.games.push(
                                    {
                                        'gameid': element['id'],
                                        'gamename': element['name'],
                                        'gameboxarturl': element['box_art_url']
                                    }
                                );
                            });
                        }
                    })
                    .catch(error => {
                        console.log(error)
                    });
                }

            },
        },

        created() {
            this.emitter.on('resetresults', (data) => {
                this.reset();
            });
        }
    }
</script>