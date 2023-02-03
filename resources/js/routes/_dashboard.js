window.spacelampsix.dashboard = window.spacelampsix.dashboard || {};

window.spacelampsix.dashboard = {
    boot : function () {
        let checkbox = $('#featured_checkbox');
        checkbox.on('click', () => {
            confirm('Are you sure you want to make this post featured? It will un-feature your current featured post.');
        });

        if (document.querySelector('#createPostForm')) {
            document.querySelector('#createPostForm').addEventListener('submit', e => {
                e.preventDefault();
                document.querySelector('#content').value = spacelampsix.toast.getMarkdown();
                e.target.submit();
            });
        }
    }
}


