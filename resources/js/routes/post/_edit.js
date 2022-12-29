window.spacelampsix.post = window.spacelampsix.post || {};
window.spacelampsix.post.edit = window.spacelampsix.post.edit || {};

window.spacelampsix.post.edit = {

    boot: function () {
        let body = $('#post-body').val();
        editor.setMarkdown(body);

        if (document.querySelector('#editPostForm')) {
            document.querySelector('#editPostForm').addEventListener('submit', e => {
                e.preventDefault();
                document.querySelector('#content').value = editor.getMarkdown();
                e.target.submit();
            });
        }
    }

}