<template>
    <div class="card">
        <div class="card-header mt-2 mb-0">
            <h2>Create a new Post</h2>
        </div>
        <div class="card-body">
            <div class="col-md-8 px-4">
                <div class="mb-2">
                    <h2 class="form-label">Create a Title<i style="color: red">*</i></h2>
                    <input class="form-control" type="text" name="title" placeholder="My title" v-model="title" />
                </div>
            </div>
            <div class="col-md-8 pt-2 px-4">
                <div class="mb-2">
                    <h2 class="form-label">Write up your post body</h2>
                </div>
            </div>
            <section class="px-4 mb-2">
                <div class="flex flex-col space-y-2 pb-2">
                    <toast ref="toast"></toast>
                </div>

                <div class="row mt-4">
                    <div class="col-sm-2">
                        <label for="">Featured?</label>
                        <input type="checkbox" class="form-check-input mx-2" v-model="checked" @click="isFeaturedWarning">
                    </div>
                    <div class="col d-flex justify-content-end">
                        <button 
                            type="submit" 
                            class="btn btn-lg btn-primary border border-dark rounded-pill mx-1"
                            @click="submitPost"
                        >
                            Submit
                        </button>
                    </div>
                </div>
            </section>
        </div>
    </div>
</template>

<script>
    import Toast from '../Global/Toast.vue';

    export default {
        components: { Toast },
        name: 'CreatePost',
        props: ['storeroute'],

        data: function() {
            return {
                title: "",
                checked: false,
            }
        },

        methods: {
            submitPost() {
                axios.post(this.storeroute, {
                    'user_id': this.authId,
                    'title': this.title,
                    'body': this.$refs.toast.getBody(),
                    'is_featured': this.checked
                })
                .then(response => {
                    this.flashWithRedirect(
                        "Post Created Successfully!",
                        "success",
                        response.data.redirect,
                    );
                })
                .catch(error => {
                    console.error(error);
                });
            },

            async isFeaturedWarning() {
                if (!this.checked) {
                    const confirmed = await this.check(
                        "Feature this post?", 
                        "Are you sure you want to feature this post? It will unfeature any currently featured post."
                    );
                    
                    if (!confirmed) {
                        this.checked = false;
                    }
                }
            },
        },
    };
</script>
