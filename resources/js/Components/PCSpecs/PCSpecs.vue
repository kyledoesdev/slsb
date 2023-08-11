<template>
    <div class="row" v-if="this.profileusername === this.authUserName">
        <div class="col d-flex justify-content-end mb-3">
            <button class="btn btn-primary border border-dark border-2" data-bs-toggle="modal" data-bs-target="#editPartsModal">
                <i class="fa fa-pencil"></i> Parts List
            </button>
        </div>
    </div>

    <div class="modal fade" id="editPartsModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Add to & Edit your PC Setup</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="row">
                            <h3>Add a new part.</h3>
                        </div>
                        <div class="col-sm-4 mt-2">
                            <select class="form-select" v-model="newPartId">
                                <option v-for="part in this.partslist" :key="part.id" :value="part.id">
                                    {{ part.name }}
                                </option>
                            </select>
                        </div>
                        <div class="col-sm-4 mt-2">
                            <input 
                                type="text" 
                                class="form-control" 
                                placeholder="Enter part name here." 
                                v-model="newPartName" 
                            />
                        </div>
                        <div class="col-sm-4 mt-2">
                            <button 
                                type="button" 
                                class="btn btn-primary border border-2 border-dark" 
                                @click="saveNewPart"
                            >
                                Add part
                            </button>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="row">
                            <h3>Edit your existing parts.</h3>
                        </div>
                        <div class="col-auto mt-4 mb-4 pb-2" v-for="part in this.profileSpecs" :key="part.id">
                            <pcpart
                                :ref="buildRefId(part.id)"
                                :partid="part.id"
                                :name="part.name"
                                :imgpath="part.pc_part.img_path"
                                :partname="part.pc_part.name"
                                :iseditable="true"
                            >
                            </pcpart>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="btn-group border border-2 border-dark">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" @click="updateParts">Save</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- display profile parts -->
    <div class="row">
        <div v-if="this.profileparts.length > 0">
            <div class="col-auto mb-4 pb-2" v-for="part in this.profileSpecs" :key="part.id">
                <pcpart
                    :partid="part.id"
                    :name="part.name"
                    :partname="part.pc_part.name"
                    :imgpath="part.pc_part.img_path"
                    :iseditable="false"
                >
                </pcpart>
            </div>
        </div>
        <div class="col-auto" v-else-if="this.profileSpecs.length <= 0 && this.authUserName != this.profileusername">
            <span>{{ this.profileusername }} has not configured their PC Specs.</span>
        </div>
    </div>
</template>

<script>
    import PCPart from './PCPart.vue';

    export default {
        components: { PCPart },
        name: 'PCSpecs',
        props: ['partslist', 'profileparts', 'profileid', 'profileusername'],

        data: function() {
            return {
                newPartId: "",
                newPartName: "",
                profileSpecs: this.profileparts
            }
        },

        methods: {
            saveNewPart() {
                if (this.authUserName === this.profileusername) {
                    axios.post('/pc_parts/store', {
                        'profile_id': this.profileid, 
                        'pc_part_id': this.newPartId,
                        'name': this.newPartName,
                    })
                    .then(response => {
                        if (response.data?.parts && response.data?.message) {
                            this.profileSpecs = response.data.parts;
                            this.flash("Success", response.data.message);
                        }
                    })
                    .catch(error => {
                        console.error(error);
                        this.flash(
                            "Something went wrong!", 
                            "Sorry, something went wrong trying to add your new PC part. Please try again later", 
                            'error'
                        );
                    });
                }
            },

            updateParts() {
                let input = [];
                for (const part in this.profileparts) {
                    input.push({
                        'id': this.profileparts[part].id,
                        'name': this.$refs["part-"+this.profileparts[part].id][0].getEnteredName()
                    });
                }

                if (this.authUserName === this.profileusername) {
                    axios.post('/pc_parts/update', {
                        'profile_id': this.profileid,
                        'parts': input 
                    })
                    .then(response => {
                        if (response.data && response.data.parts) {                            
                            this.profileparts = response.data.parts;
                            this.flash("Success", "Successfully updated your PC Parts");
                        }
                    })
                    .catch(error => {
                        console.error(error);
                        this.flash("Error", "Sorry, we messed something up. Try again later!", "error");
                    })
                }
            },

            buildRefId(partId) {
                return "part-" + partId
            }
        },
    }
</script>