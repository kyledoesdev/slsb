<template>
    <div v-if="this.iseditable">
        <h5>{{ this.partname }}</h5> 
        <div class="col-auto">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        <img :src="this.imgpath" :alt="this.partname" style="max-width: 75px; max-height: 75px;">
                    </span>
                </div>
                <input type="text" class="form-control" v-model="enteredPartName">
            </div>
        </div> 
    </div>
    <div v-else>
        <h5>{{ this.partname }}</h5> 
        <div class="col-md-4">
            <div class="input-group">
                <div class="input-group-prepend m-2">
                    <span class="input-group-text">
                        <img :src="this.imgpath" :alt="this.partname" style="max-width: 75px; max-height: 75px;">
                        <span class="mx-2" style="font-size: 2vh;"><b>{{ this.name }}</b></span>
                    </span>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'PCPart',
        props: ['partid', 'name', 'partname', 'imgpath', 'iseditable'],

        data: function() {
            return {
                canEdit: this.iseditable,
                enteredPartName: ""
            }
        },

        methods: {
            getEnteredName() {
                return this.enteredPartName;
            }
        },

        mounted() {
            this.enteredPartName = this.name
        }
    }
</script>