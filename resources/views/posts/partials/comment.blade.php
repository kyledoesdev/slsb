<div class="card-body pb-0">
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-10 d-flex justify-content-start mb-2 mt-2">
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
                <div class="col-md-2 d-flex justify-content-start mb-0 mt-3">
                    <small class="mx-1 mb-0 pb-0" title="{{ $comment->formatted_updated_at}}">
                        {{ $comment->created_at->diffForHumans() }}
                    </small>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-2">
        <div class="col-md-6">
            @if(auth()->hasUser())
                <div class="mb-2">
                    <ratingbtngroup
                        id="{{ $comment->id }}"
                        vote_count="{{ count($comment->commentRatings->where('rating_type', 'up')) }}"
                        hasrating="{{ auth()->user()->hasRatingForComment($comment) }}"
                        uprating="{{ auth()->user()->getRatingTypeForComment($comment, 'up') }}"
                        downrating="{{ auth()->user()->getRatingTypeForComment($comment, 'down') }}"
                        commentuser="{{ $comment->user_id }}"
                        authuser="{{ auth()->id() }}"
                    />
                </div>
                @include('posts.partials.edit_comment_modal', ['comment' => $comment])
                @include('posts.partials.reply_comment_modal', ['comment' => $comment])
                @include('posts.partials.delete_comment_form', ['comment' => $comment])
            @else
                <div class="btn-group">
                    <button type="button" class="btn btn-outline-primary border border-1 border-dark pt-1 pb-1" disabled>
                        <i class="fa-solid fa-arrow-up"></i><span class="p-1 text-dark">{{ count($comment->commentRatings->where('rating_type', 'up')) }}</span>
                    </button>
                    <button type="button" class="btn btn-outline-secondary border border-1 border-dark pt-1 pb-1" disabled>
                        <i class="fa-solid fa-arrow-down"></i>
                    </button>
                </div>
            @endif
        </div>
        <br />
        @if(!empty($commentsByParentId->get($comment->id)))
            <div class="replies mt-1">
                @foreach ($commentsByParentId->get($comment->id) as $reply)
                    @if ($loop->index <= 5) {{-- temp --}}
                        @include('posts.partials.comment', [
                            'comment' => $reply,
                        ])
                    @endif
                @endforeach
            </div>
        @endif
    </div>
</div>