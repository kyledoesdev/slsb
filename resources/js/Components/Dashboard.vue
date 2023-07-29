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
                    <div id="editor"></div>
                </div>

                <div class="row mt-4">
                    <div class="col-sm-2">
                        <label for="">Featured?</label>
                        <input type="checkbox" class="form-check-input mx-2" v-model="isFeatured">
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
    import Editor from '@toast-ui/editor';
    import "@toast-ui/editor/dist/toastui-editor.css";
    import "@toast-ui/editor/dist/theme/toastui-editor-dark.css";

    export default {
        name: 'Dashboard',
        props: ['storeroute'],

        data: function() {
            return {
                editor: null,
                title: "",
                isFeatured: false
            }
        },

        methods: {
            submitPost() {
                axios.post(this.storeroute, {
                    'user_id': this.authId,
                    'title': this.title,
                    'body': this.editor.getMarkdown(),
                    'is_featured': this.isFeatured
                })
                .then(response => {
                    window.location.href = response.data.redirect
                })
                .catch(error => {
                    console.error(error);
                });
            }

        },

        mounted() {
            this.editor = new Editor({
                el: document.querySelector("#editor"),
                height: "500px",
                initialEditType: "markdown",
                theme: 'dark'
            });
        }
    };
</script>
