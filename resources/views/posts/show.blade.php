@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row d-flex justify-content-center mb-2">
        @if (auth()->user() == $post->user)
            <div class="col-md-8 bg-light mb-2">
                <div class="d-flex justify-content-end">
                    <a href="{{ route('post.edit', $post->id) }}" class="btn btn-success mx-1">Edit Post</a>
                    <form action="{{ route('post.destroy', $post->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-danger" onclick="confirm('Are you sure you want to delete this post?');">Delete Post</button>
                    </form>
                </div>
            </div>
        @endif
        <div class="col-md-8">
            @include('includes.markdown_content')
        </div>
    </div>
</div>

@endsection
