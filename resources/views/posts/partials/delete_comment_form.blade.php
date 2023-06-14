<form action="{{ route('comment.delete', ['commentId' => $comment->id]) }}" method="POST" id="delete-comment-{{$comment->id}}">
    @csrf
</form>