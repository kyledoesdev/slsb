<div class="modal modal-lg fade" id="edit-comment-{{ $comment->id }}" tabindex="-1" aria-labelledby="edit-comment-{{ $comment->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('comment.update', ['commentId' => $comment->id]) }}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Edit your comment</h1>
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
                    >{{ $comment->comment }}</textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </form>
    </div>
</div>