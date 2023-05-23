<div class="card">
    <div class="card-body">
      <h3 class="card-title">{{ $post->title }}</h3>
      <h6 class="card-subtitle mb-2 text-muted" title="{{ $post->getFormattedCreatedAt() }}">{{ $post->created_at->diffForHumans() }}</h6>
      <a href="{{ route('post.show', ['id' => $post->id]) }}" style="text-decoration: none;">Read More ...</a>
    </div>
</div>