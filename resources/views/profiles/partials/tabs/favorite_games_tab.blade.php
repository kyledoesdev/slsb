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
            <favoritegamestab
                :games="{{ $user->profile->userProfileFavoriteGames }}"
                storeroute="{{ route('favorite_game.store', $user->getUserName()) }}"
                deleteroute="{{ route('favorite_game.delete', auth()->user()->getUserName() )}}"
                profileusername="{{ $user->getUserName() }}"
                authusername="{{ auth()->user()->getUserName() }}"
            >
            </favoritegamestab>
        </div>
    </div>
</div>