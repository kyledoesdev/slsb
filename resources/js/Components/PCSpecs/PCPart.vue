<template>
    <div v-if="this.iseditable">
        <div class="col-auto mb-1">
            <div class="row align-items-center">
                <div class="col">
                    <h5>{{ this.partname }}</h5>
                </div>
                <div class="col-auto">
                    <button
                        type="button"
                        class="btn btn-sm btn-danger text-white"
                        @click="deletePart"
                    >
                        <i class="fa-solid fa-trash-can"></i>
                    </button>
                </div>
            </div>
        </div> 
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
        props: ['partid', 'name', 'partname', 'imgpath', 'iseditable', 'profileusername', 'profileid'],

        data: function() {
            return {
                canEdit: this.iseditable,
                enteredPartName: ""
            }
        },

        methods: {
            getEnteredName() {
                return this.enteredPartName;
            },

            deletePart() {
                if (this.profileusername === this.authUser.username) {
                    axios.post('/pc_parts/delete', {
                        'profile_id': this.profileid,
                        'id': this.partid
                    })
                    .then(response => {
                        const data = response.data;

                        if (data && data.parts && data.message) {
                            this.emitter.emit('partsupdated', data.parts);
                            this.flash("Deleted!", data.message);
                        }
                    })
                    .catch(error => {
                        console.error(error);
                        this.flashDefaultError();
                    });
                }
            }
        },

        mounted() {
            this.enteredPartName = this.name
        }
    }
</script>