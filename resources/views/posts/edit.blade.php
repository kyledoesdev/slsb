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
                    <div>
                        <posteditor 
                            postid="{{ $post->id }}"
                            title="{{ $post->title }}"
                            isFeatured="{{ $post->is_featured }}"
                            content="{{ $post->body }}"
                            updateroute="{{ route('post.update', $post->id) }}"
                        />
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
