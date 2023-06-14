<div class="modal modal-lg fade" id="add-reply-{{ $comment->id }}" tabindex="-1" aria-labelledby="add-reply-{{ $comment->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('comment.reply', ['commentId' => $comment->id]) }}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5">Add your reply</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <textarea 
                        class="form-control m-0"
                        name="comment" 
                        id="new_comment" 
                        cols="30" 
                        rows="10"
                        maxlength="255"
                    ></textarea>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="post_id" value="{{ $comment->post_id }}" />
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </form>
    </div>
</div>