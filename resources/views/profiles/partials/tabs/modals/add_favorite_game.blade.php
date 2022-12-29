<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#favoriteGames">
    <i class="fa fa-plus"></i> Favorite game
</button>

<div class="modal fade" id="favoriteGames" tabindex="-1" aria-labelledby="favoriteGamesLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="favoriteGamesLabel">Add new favorite game.</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="col">
                    <form method="GET">
                        <h5 class="mb-0">Search for a game and add it to your favorite games section.</h5 class="mx-3 mt-3 mb-0">
                        <div class="input-group mt-1">
                            <input type="text" class="form-control" id="game-input"  placeholder="Enter A Game">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-primary" id="submit-game-input"><i class="fa fa-search"></i></button>
                                <button type="submit" class="btn btn-dark" id="reset"><i class="fa fa-redo"></i></button>
                            </div>
                            <div class="container mt-2">
                                <div class="row queried-images"></div>
                            </div>
                          </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>