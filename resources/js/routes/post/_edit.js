import { editor } from "../../toast-ui-editor";

window.spacelampsix.post = window.spacelampsix.post || {};
window.spacelampsix.post.edit = window.spacelampsix.post.edit || {};

window.spacelampsix.post.edit = {

    boot: function () {
        let body = $('#post-body').val();
        editor.setMarkdown(body);

        let checkbox = $('#featured_checkbox');
        checkbox.on('click', () => {
            confirm('Are you sure you want to make this post featured? It will un-feature your current featured post.');
        });

        if (document.querySelector('#editPostForm')) {
            document.querySelector('#editPostForm').addEventListener('submit', e => {
                e.preventDefault();
                document.querySelector('#content').value = editor.getMarkdown();
                e.target.submit();
            });
        }
    }

}