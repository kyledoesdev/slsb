<section class="px-4 mb-2">
    <div class="flex flex-col space-y-2 pb-2">
        <div id="editor" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"></div>
    </div>

    <input type="hidden" name="body" id="content">
    
    @if ($post)
        <input type="hidden" name="post_id" value="{{ $post->getId() }}">
    @endif

    <div class="row mt-4">
        <div class="col d-flex form-check form-check-inline mt-3">
            <input 
                class="form-check-input mx-2" 
                type="checkbox" 
                id="featured_checkbox" 
                name="is_featured" 
                @if ($post && $post->is_featured == true) checked @endif
            />
            <label class="form-check-label">
                Featured
            </label>
        </div>

        <div class="col d-flex justify-content-end">
            <button 
                type="submit" 
                class="btn btn-lg btn-primary border border-dark rounded-pill mx-1"
                @if (get_route() === 'post.edit') form="update-post-form" @else form="create-post-form" @endif
            >
                {{ $action}}
            </button>
            <button 
                type="button" 
                class="btn btn-lg btn-dark border border-dark rounded-pill mx-1"
                onclick="history.back()"
            >
                Cancel
            </button>
        </div>
    </div>
</section>
