<template>
    <div v-if="this.iseditable">
        <h5>{{ this.partname }}</h5> 
        <div class="col-auto">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        <img class="m-2" :src="this.imgpath" :alt="this.partname" style="max-width: 50px; max-height: 50px;">
                    </span>
                </div>
                <input type="text" class="form-control" v-model="enteredPartName">
            </div>
        </div> 
    </div>
    <div v-else>
        <h5>{{ this.partname }}</h5>  
        <img class="mb-2" :src="this.imgpath" alt="test" style="max-width: 50px; max-height: 50px;">
        <span class="px-4">{{ this.name }}</span>
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