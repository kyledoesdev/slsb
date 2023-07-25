<div class="card card-body border border-3 border-dark mt-4">
    <div class="row m-2">
        <h1 class="mt-2 mb-2">Add a Comment:</h1>
        <form action="{{ route('comment.store', ['postId' => $post->id]) }}" method="POST">
            @csrf
            <textarea 
                class="form-control m-0"
                name="comment" 
                id="new_comment" 
                cols="30" 
                rows="10"
                maxlength="256"
                oninput="displayCharsLeft(this, 256)"
            ></textarea>
            <div class="row">
                <div class="col d-flex justify-content-start mt-1">
                    <i id="charsLeft"></i>
                </div>
                <div class="col d-flex justify-content-end m-2">
                    <button class="btn btn-sm btn-primary"><i class="fa-regular fa-paper-plane"></i></button>
                </div>
            </div>
            <input type="hidden" name="post_id" value="{{ $post->id }}" />
        </form>
    </div>
    <hr>
    <div class="row">
        <div class="col-md-10">
            <h1 class="mt-2 mb-2">Comments: </h1>
        </div>
    </div>
    <div class="mx-3">
        @foreach($comments as $comment)
            <div class="comment mb-3">
                <div class="card col-md-8">
                    @include('posts.partials.comment', [
                        'comment' => $comment,
                    ])
                </div>
            </div>
        @endforeach
    </div>
</div>