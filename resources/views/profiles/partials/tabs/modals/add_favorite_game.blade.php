<!-- Button trigger modal -->
<button type="button" class="btn btn-primary border-2 border-dark" data-bs-toggle="modal" data-bs-target="#favoriteGames">
    <i class="fa fa-plus"></i> Favorite game
</button>

<div id="category-search">
    <categorysearch
        searchroute="{{ route('favorite_game.search') }}"
        storeroute="{{ route('favorite_game.store', $user->getUserName()) }}"
        deleteroute="{{ route('favorite_game.delete', auth()->user()->getUserName() )}}"
        profileusername="{{ $user->getUserName() }}"
        authusername="{{ auth()->user()->getUserName() }}"
    >
    </categorysearch>
</div>