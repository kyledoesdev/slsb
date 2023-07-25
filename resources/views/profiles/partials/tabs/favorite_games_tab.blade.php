<div class="tab-pane container fade" id="tab_2" style="max-height: 550px; overflow-y: auto;">
    <div class="parent-favorite-games-container">
        <div class="row">
            @if ($user->id == auth()->id())
                <div class="col d-flex justify-content-end m-2">
                    @include('profiles.partials.tabs.modals.add_favorite_game')
                </div>
            @endif
        </div>
        <div class="row">
            <favoritegamestab
                :games="{{ $user->profile->userProfileFavoriteGames }}"
                profileusername="{{ $user->username }}"
                @if (auth()->hasUser())
                    storeroute="{{ route('favorite_game.store', $user->username) }}"
                    deleteroute="{{ route('favorite_game.delete', auth()->user()->username )}}"
                    authusername="{{ auth()->user()->username }}"
                @endif
            >
            </favoritegamestab>
        </div>
    </div>
</div>