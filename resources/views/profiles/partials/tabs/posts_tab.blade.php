<div class="tab-pane container fade show active" id="tab_1">
    <div class="parent-post-container mt-4">
        <div class="row">
            @foreach ($posts as $post)
                <div class="col mb-4">
                    @include('includes.post_cover', ['post' => $post])
                </div>
            @endforeach
        </div>
    </div>
</div>