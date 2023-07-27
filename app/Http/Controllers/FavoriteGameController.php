<?php

namespace App\Http\Controllers;

use App\Models\User;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use App\Models\FavoriteGame;

class FavoriteGameController extends Controller {
    protected $userProfile;

    public function __construct(Request $request) {
        $this->userProfile = User::query()
            ->where('username', $request->route('id'))
            ->firstOrFail()
            ->profile;
    }

    public function store(Request $request) {
        $gameId = $request->input('game_id');

        if ($this->userProfile->canHaveMoreFavoriteGames()) {
            $favoriteGame = FavoriteGame::getSpecificProfileFavoriteGame($gameId, $this->userProfile->id, true);

            if ($favoriteGame) {
                $favoriteGame->restore();
            } else {
                $favoriteGame = FavoriteGame::createProfileFavoriteGame($request->all());
            }

            return response()->json([
               'games' => FavoriteGame::getAllProfileFavoriteGames($this->userProfile->id)
            ]);
        }

        //The user can have no more favorite games
        return response()->json([
            'message' => 'You can not have more than 9 favorite games. Sorry!',
            'type' => 'tooManyGames'
        ]);
    }

    public function delete(Request $request) {
        $favoriteGame = FavoriteGame::getSpecificProfileFavoriteGame($request->input('game_id'), $this->userProfile->id);

        if ($favoriteGame) {
            $favoriteGame->delete();
        }

        return response()->json([
            'games' => FavoriteGame::getAllProfileFavoriteGames($this->userProfile->id)
        ]);
    }

}
