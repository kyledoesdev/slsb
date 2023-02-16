<div class="card overflow-auto" @if ($post->isFeatured()) style="max-height: 600px;" @endif>
    <!-- Post Title Bar -->
    <section class="card-header">
        <div class="row">
            <div class="col-md-6 d-flex justify-content-start">
                <h1 class="mb-0 mt-2">{{ $post->title }}</h1>
            </div>
            <div class="col-md-6 d-flex justify-content-end">
                <a href="{{ route('profile.show', $post->user->username) }}" class="border border-1 border-dark mb-0 mt-2 p-2 text-dark" style="text-decoration: none;"> 
                    @ {{ $post->user->username }}
                </a>
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
                @auth
                    <like
                        post-id= "{{ $post->getId() }}"
                        likes= "{{ auth()->user()->isLiking($post) }}"
                        count= "{{ $post->getNumOfLikes() }}"
                    />
                @endauth
                @guest
                    <likecounter
                        like-count="{{ $post->getNumOfLikes() }}"
                    />
                @endguest
            </div>
            <div class="justify-content-end">
                @if (get_route() === 'post.show' && auth()->user() == $post->user)
                    <a href="{{ route('post.edit', $post->id) }}" class="btn btn-dark border border-2 border-dark rounded-pill shadow-none mb-0">Edit Post</a>
                @else
                    <a href="{{ route('post.show', $post->id) }}" class="btn btn-primary border border-2 border-dark rounded-pill shadow-none mb-0">View</a>
                @endif
            </div>
        </div>
    </section>
</div>
