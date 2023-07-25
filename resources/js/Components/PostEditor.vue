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
                <div id="editor"></div>
            </div>

            <div class="row mt-4">
                <div class="col-sm-2">
                    <label for="">Featured?</label>
                    <input type="checkbox" class="form-check-input mx-2" v-model="this.isFeaturePost" @click="isFeaturedWarning">
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
    import Editor from '@toast-ui/editor';
    import "@toast-ui/editor/dist/toastui-editor.css";
    import "@toast-ui/editor/dist/theme/toastui-editor-dark.css";

    export default {

        props: ['authid', 'postid', 'title', 'content', 'isFeatured', 'updateroute'],

        data: function() {
            return {
                user_id: this.authid,
                title: this.title,
                body: this.content,
                isFeaturePost: this.isFeatured,
                editor: null,
                post_id: this.postid,
            }
        },

        methods: {
            submitPost() {
                axios.post(this.updateroute, {
                    'user_id': this.user_id,
                    'post_id': this.post_id,
                    'title': this.title,
                    'body': this.editor.getMarkdown(),
                    'is_featured': this.isFeaturePost
                })
                .then(response => {
                    window.location.href = response.data.redirect
                })
                .catch(error => {
                    console.error(error);
                });
            },

            isFeaturedWarning() {
                //todo condtionalize for if checked already
                alert("This will alter the pinned post to your profile.");
            }

        },

        mounted() {
            this.editor = new Editor({
                el: document.querySelector("#editor"),
                height: "500px",
                initialEditType: "markdown",
                theme: 'dark',
                initialValue: this.body
            });
        }
    };
</script>
