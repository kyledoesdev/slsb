@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row d-flex justify-content-center mb-2">
            <div class="col-md-8 mb-2">
                @forelse ($posts as $post)
                    <div class="card mb-4">
                        @include('includes.markdown_content')
                    </div>
                @empty
                    <span>Follow more users to see posts.</span>
                @endforelse
            </div>
        </div>
    </div>
@endsection
