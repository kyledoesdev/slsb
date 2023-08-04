<template>
    <div id="toaster">
        <div id="editor"></div>
    </div>
</template>

<script>
    import Editor from '@toast-ui/editor';
    import "@toast-ui/editor/dist/toastui-editor.css";
    import "@toast-ui/editor/dist/theme/toastui-editor-dark.css";

    export default {
        name: 'Toast',
        props: ['content'],

        data: function() {
            return {
                toast: null,
                body: this.content
            }
        },

        methods: {
            getBody() {
                return this.toast.getMarkdown();
            },
        },

        mounted() {
            this.toast = new Editor({
                el: document.querySelector("#editor"),
                height: "500px",
                initialEditType: "markdown",
                theme: 'dark',
                initialValue: this.body
            });
        }
    }
</script>