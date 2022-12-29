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
            <div class="col favorite-game-images">
                @forelse ($user->profile->userProfileFavoriteGames as $game)
                    <img class="m-2" src="{{ $game->formatted_box_art_url }}" alt="{{ $game->game_title }}">
                @empty
                    <span>{{ $user->username }} has no favorite games saved.</span>
                @endforelse
            </div>
        </div>
    </div>
</div>