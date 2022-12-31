<template>
    <div class="col mx-2">
        <img :src="getImageSrc()" :value="gameid" class="searched-image" width="142.5" height="190"/>
        <div class="row">
            <h4 class="col-sm-auto d-flex justify-content-start mt-2 mb-2" v-text="this.gamename"></h4>
            <button 
                type="button" 
                class="col-auto d-flex justify-content-end btn btn-sm btn-primary m-2 add-new-game-button" 
                :data-id="this.gameid" 
                :data-name="this.gamename" 
                :data-art-url="this.gameboxarturl">
                <i class="fa fa-plus"></i>
            </button> 
        </div>
    </div>
</template>

<script>

    export default {

        props: ['gameid', 'gamename', 'gameboxarturl'],

        methods: {
            getImageSrc() {
                return "https://static-cdn.jtvnw.net/ttv-boxart/"+this.gameid+"-285x380.jpg";
            }
        }

    }

</script>