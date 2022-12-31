<div class="tab-pane container fade" id="tab_2">
    <div class="parent-favorite-games-container">
        <div class="row">
            @if ($user->getId() == auth()->id())
                <div class="col d-flex justify-content-end m-2">
                    @include('profiles.partials.tabs.modals.add_favorite_game')
                </div>
            @endif
        </div>
        <div class="row">
            @forelse ($user->profile->userProfileFavoriteGames as $game)
                <div class="col d-flex justify-content-center m-0 p-0">
                    <img class="mb-2" src="{{ $game->formatted_box_art_url }}" alt="{{ $game->game_title }}">
                    <button class="btn btn-sm btn-primary" style="max-height: 30px; transform: translate(-115%, 15%);">
                        <i class="fa fa-times pb-2"></i>
                    </button>
                </div>
                
            @empty
                <span>{{ $user->username }} has no favorite games saved.</span>
            @endforelse
        </div>
    </div>
</div>