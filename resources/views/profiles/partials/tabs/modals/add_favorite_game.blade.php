<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#favoriteGames">
    <i class="fa fa-plus"></i> Favorite game
</button>

<div id="category-search">
    <categorysearch
        searchroute="{{ route('favorite_game.search') }}"
    >
    </categorysearch>
</div>