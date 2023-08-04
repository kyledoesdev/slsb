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
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Edit your PC Setup</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-auto mb-4 pb-2" v-for="part in this.profileparts" :key="part.id">
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
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" @click="test">Save</button>
                </div>
            </div>
        </div>
    </div>

    <!-- display profile parts -->
    <div class="row">
        <div class="col-auto mb-4 pb-2" v-for="part in this.profileparts" :key="part.id">
            <pcpart
                :partid="part.id"
                :name="part.name"
                :partname="part.pc_part.name"
                :imgpath="part.pc_part.img_path"
            >
            </pcpart>
        </div>
    </div>
</template>

<script>
    import PCPart from './PCPart.vue';

    export default {
        components: { PCPart },
        name: 'PCSpecs',
        props: ['profileparts', 'profileusername'],

        data: function() {
            return {
                specs: this.profileparts
            }
        },

        methods: {
            test() {
                let input = [];
                for (const part in this.profileparts) {
                    input.push({
                        'id': this.profileparts[part].id,
                        'name': this.$refs["part-"+this.profileparts[part].id][0].getEnteredName()
                    });
                }

                console.log(input);
            },

            buildRefId(partId) {
                return "part-" + partId
            }
        },
    }
</script>