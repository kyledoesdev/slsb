<div class="tab-pane container active" id="tab_1">
    <div class="parent-post-container mt-4">
        @foreach ($posts as $post)
            <div class="col-auto mb-4">
                @include('includes.markdown_content', ['post' => $post])
            </div>
        @endforeach
    </div>
</div>