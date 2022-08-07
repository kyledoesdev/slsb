<!-- Post Title Bar -->
<section class="card-header">
    <div class="row">
        <div class="col-md-6 d-flex justify-content-start">
            <h2 class="mb-0">{{ $post->title }}</h2>
        </div>
        <div class="col-md-6 d-flex justify-content-end">
            <span class="mb-0">@ {{ $post->user->username }}</span>
        </div>
    </div>
</section>

<!-- Markdown content -->
<section class="card-body mb-2">
    {!! Str::markdown($post->getBody()) !!}
</section>

<!-- Likes section -->
<section class="card-footer">
    <div class="d-flex justify-content-between">
        <div class="justify-content-start">
            @auth
                <like
                    post-id= "{{ $post->getId() }}"
                    likes= "{{ auth()->user()->isLiking($post) }}"
                    count= "{{ $post->getNumOfLikes() }}"
                />
            @endauth
            @guest
                <div>
                    <likecounter
                        like-count="{{ $post->getNumOfLikes() }}"
                    />
                </div>
            @endguest
        </div>
        <div class="justify-content-end">
           @if (Route::currentRouteName() != 'post.show')
                <a href="{{ route('post.show', $post->id) }}" class="btn btn-primary rounded-pill shadow-none mb-0">View</a>
           @endif
        </div>
    </div>
</section>
