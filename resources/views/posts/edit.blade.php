@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col">
                            <h2 class="mt-2 mb-0">Edit Post #{{ $post->id }}</h2>
                        </div>
                        <div class="col d-flex justify-content-end">
                            <form action="{{ route('post.destroy', $post->id) }}" method="POST" id="delete-post-form">
                                @csrf
                                <button 
                                    type="submit" 
                                    class="btn btn-lg btn-danger border border-dark rounded-pill" 
                                    onclick="return confirm('Are you sure you want to delete this post?');"
                                    form="delete-post-form"
                                >
                                    Delete Post
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                <form method="POST" action="{{ route('post.update', $post->id) }}" id="update-post-form" >
                    @csrf
                    <div class="col-md-8 pt-4 px-4">
                        <div class="mb-2">
                            <h2 class="form-label">Update Title<i style="color: red">*</i></h2>
                            <input class="form-control" type="text" name="title" placeholder="My title" value="{{ $post->title }}" />
                        </div>
                    </div>
                    <div class="col-md-8 pt-2 px-4">
                        <div class="mb-2">
                            <h2 class="form-label">Write up your post body</h2>
                            <input type="hidden" id="post-body" value="{{ $post->body }}" />
                        </div>
                    </div>
                    
                    <input type="hidden" name="user_id" value="{{ auth()->id() }}"/>
                    <!-- This is the markdown editor partial -->
                    @include('includes.markdown_editor', [
                        'action' => 'Update',
                        'post' => $post,
                    ])
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
