<div class="card overflow-auto" @if ($post->isFeatured() && get_route() === 'profile.show') style="max-height: 575px;" @endif>
    <!-- Post Title Bar -->
    <section class="card-header">
        <div class="row">
            <div class="col-md-10 d-flex justify-content-start">
                <h1 class="mb-0 mt-3">{{ $post->title }} @if(get_route() === 'profile.show'  && $post->isFeatured()) &#128204; @endif</h1>
            </div>
            <div class="col-md-2 d-flex justify-content-end">
                @if (get_route() !== 'profile.show')
                    <a 
                        class="mt-2 my-2" 
                        href="{{ route('profile.show', $post->user->username) }}" 
                        title="{{ $post->user->username }}" 
                        style="text-decoration: none;"
                    > 
                        <img 
                            class="border border-2 border-dark rounded-pill"
                            src="{{ $post->user->profile->avatar }}" 
                            alt="{{ $post->user->username }}"
                            width="50" 
                            height="50"
                        />
                    </a>
                @endif
            </div>
        </div>
    </section>

    <!-- Markdown content -->
    <section class="card-body overflow-auto mb-2">
        {!! Str::markdown($post->getBody()) !!}
    </section>

    <!-- footer -->
    <section class="card-footer">
        <div class="d-flex justify-content-between">
            <div class="justify-content-start">
                @if (auth()->hasUser())
                    <like
                        post-id= "{{ $post->getId() }}"
                        likes= "{{ auth()->user()->isLiking($post) }}"
                        count= "{{ $post->getNumOfLikes() }}"
                    />
                @else
                    <likecounter
                        like-count="{{ $post->getNumOfLikes() }}"
                    />
                @endif
            </div>
            <div class="justify-content-end">
                @if (get_route() === 'post.show' && auth()->id() == $post->user->id)
                    <a href="{{ route('post.edit', $post->id) }}" class="btn btn-dark border border-2 border-dark rounded-pill shadow-none mb-0">Edit Post</a>
                @elseif (get_route() !== 'post.show')
                    <a href="{{ route('post.show', $post->id) }}" class="btn btn-primary border border-2 border-dark rounded-pill shadow-none mb-0">
                        <i class="fa-sharp fa-solid fa-comments"></i>
                    </a>
                @endif
            </div>
        </div>
    </section>
</div>
