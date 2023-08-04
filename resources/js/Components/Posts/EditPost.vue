<template>
    <div class="card-body">
        <div class="col-md-8 pt-4 px-4">
            <div class="mb-2">
                <h2 class="form-label">Update Title<i style="color: red">*</i></h2>
                <input class="form-control" type="text" name="title" v-model="this.title" />
            </div>
        </div>
        <div class="col-md-8 pt-2 px-4">
            <div class="mb-2">
                <h2 class="form-label">Write up your post body</h2>
            </div>
        </div>
        <section class="px-4 mb-2">
            <div class="flex flex-col space-y-2 pb-2">
                <toast ref="toast" :content="this.content"></toast>
            </div>

            <div class="row mt-4">
                <div class="col-sm-2">
                    <label for="">Featured?</label>
                    <input type="checkbox" class="form-check-input mx-2" v-model="this.checked" @click="isFeaturedWarning">
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
</template>

<script>
    import Toast from '../Global/Toast.vue';

    export default {
        components: { Toast },
        name: 'editpost',
        props: {
            postid: {
                type: Number,
                required: true,
            },
            title: {
                type: String,
                required: true,
            },
            content: {
                type: String,
                required: true,
            },
            isFeatured: {
                type: Boolean,
                required: true,
            },
            updateroute: {
                type: String,
                required: true,
            },
        },

        data: function() {
            return {
                title: this.title,
                body: this.content,
                checked: this.isFeatured,
                post_id: this.postid,
            }
        },

        methods: {
            submitPost() {
                axios.post(this.updateroute, {
                    'user_id': this.authId,
                    'post_id': this.post_id,
                    'title': this.title,
                    'body': this.$refs.toast.getBody(),
                    'is_featured': this.checked
                })
                .then(response => {
                    if (response.data && response.data.message) {
                        this.flash("Success", response.data.message);
                    }
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
