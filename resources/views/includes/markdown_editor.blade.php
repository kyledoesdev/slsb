<section class="px-4 mb-2">
    <div class="flex flex-col space-y-2 pb-2">
        <div id="editor" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"></div>
    </div>

    <input type="hidden" name="body" id="content">

    <div class="col d-flex justify-content-end form-check form-check-inline mt-3">
        <input class="form-check-input mx-2" type="checkbox" id="featured_checkbox" name="is_featured">
        <label class="form-check-label" for="flexCheckDefault">
            Featured
        </label>
    </div>

    <div class="row">
        <div class="col d-inline justify-content-end">
            <button type="submit" class="btn btn-lg btn-primary border border-dark rounded-pill m-2">
                {{ $action}}
            </button>
        </div>
    </div>
</section>
