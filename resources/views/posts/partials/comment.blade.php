<div class="comment mb-3">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-10 d-flex justify-content-start mb-3">
                            <div class="mb-0">
                                <a href="{{ route('profile.show', ['id' => $comment->user->username]) }}">
                                    <img 
                                        src="{{ $comment->user->profile->avatar }}" 
                                        alt="{{ $comment->user->username }}"
                                        class="d-block border border-2 border-dark rounded-pill"
                                        height="30"
                                        width="30"
                                        title="{{ $comment->user->username }}"
                                    />
                                </a>
                            </div>
                            <h5 class="mt-1 mx-2 mb-0" id="{{ $comment->id }}">{{ $comment->comment }}</h5>
                        </div>
                        @if ($comment->user_id === auth()->id())
                            <div class="col-md-2 d-flex justify-content-end">
                                <div class="col-md-2 d-flex justify-content-end mb-3">
                                    <div class="div">
                                        <button class="btn btn-sm btn-primary mx-1" value="{{ $comment->id }}" data-bs-toggle="modal" data-bs-target="#edit-comment-{{ $comment->id }}">
                                            <i class="fa-solid fa-pencil"></i>
                                        </button>
                                    </div>
                                </div>
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
                                <form action="{{ route('comment.delete', ['commentId' => $comment->id]) }}" method="POST">
                                    @csrf
                                    <div class="div">
                                        <button class="btn btn-sm btn-danger delete-comment" value="{{ $comment->id }}">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <small class="mx-1">{{ $comment->formatted_updated_at }}</small>
            <div class="col-md-2 d-flex j">
                <a class="mx-1" data-bs-toggle="modal" data-bs-target="#add-reply-{{ $comment->id }}" style="text-decoration: none; cursor: pointer;">
                    Reply
                </a>
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
            </div>
            <div class="mt-1">
                @if($comment->replies->count())
                    <div class="replies mt-1">
                        @each('posts.partials.comment', $comment->replies, 'comment')
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>