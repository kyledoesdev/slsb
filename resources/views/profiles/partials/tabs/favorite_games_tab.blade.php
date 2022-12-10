<div class="tab-pane container fade" id="tab_2">
    <div class="row">
        <div class="col">
            test
        </div>
        @if ($user->getId() == auth()->id())
            <div class="col">
                <form method="GET">
                    <label for="game-input">Enter a game</label> 
                    <input type="text" class="form-control" id="game-input"  />
                    <button type="submit" class="btn btn-sm btn-secondary" id="submit-game-input">Submit</button>
                </form>
            </div>
        @endif
    </div>
</div>