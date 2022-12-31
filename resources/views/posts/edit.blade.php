@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h2 class="mt-1 mb-0">Edit Post #{{ $post->id }}</h2>
                </div>
                    <form method="POST" action="{{ route('post.update', $post->id) }}" id="editPostForm" >
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
                        <!-- Passing this value here to make validation easier on the backend -->
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
</div>
@endsection
