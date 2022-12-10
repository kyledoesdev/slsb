<div class="card overflow-auto">
    <!-- Post Title Bar -->
    <section class="card-header">
        <div class="row">
            <div class="col-md-6 d-flex justify-content-start">
                <h2 class="mb-0">{{ $post->title }}</h2>
            </div>
            <div class="col-md-6 d-flex justify-content-end">
                <a href="{{ route('profile.show', $post->user->username) }}" class="mb-0 text-dark" style="text-decoration: none;"> 
                    @ {{ $post->user->username }}
                </a>
            </div>
        </div>
    </section>

    <!-- Markdown content -->
    <section class="card-body overflow-auto mb-2" @if (Route::currentRouteName() === 'profile.show') style="max-height: 270px;" @endif>
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
</div>
