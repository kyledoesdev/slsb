window.spacelampsix.post = window.spacelampsix.post || {};
window.spacelampsix.post.edit = window.spacelampsix.post.show || {};

window.spacelampsix.post.show = {

    boot: function () {
        const MAX_CHAR_COUNT = 255;

        $('#delete-comment-modal').hide();

        $('#new_comment').on('change keyup', function(e) {
            let commentLength = $(this).val().length
            console.log(commentLength)
            let remaining = MAX_CHAR_COUNT - commentLength;
            $('#charsLeft').text(remaining);
        });

        $('.delete-comment').on('click', function(e) {
            return confirm("Are you sure you want to delete this comment?");
        });
    }

}