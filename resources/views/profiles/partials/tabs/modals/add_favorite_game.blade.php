<!-- Button trigger modal -->
<button type="button" class="btn btn-primary border-2 border-dark" data-bs-toggle="modal" data-bs-target="#favoriteGames">
    <i class="fa fa-plus"></i> Favorite game
</button>

<div id="category-search">
    <categorysearch
        searchroute="{{ route('favorite_game.search') }}"
        storeroute="{{ route('favorite_game.store', $user->username) }}"
        deleteroute="{{ route('favorite_game.delete', auth()->user()->username )}}"
        profileusername="{{ $user->username }}"
        authusername="{{ auth()->user()->username }}"
    >
    </categorysearch>
</div>