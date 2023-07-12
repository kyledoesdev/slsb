<?php

namespace App\Http\Controllers;

use App\Models\User;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use App\Models\UserProfileFavoriteGame;

class FavoriteGameController extends Controller {
    protected $client;
    protected $userProfile;

    public function __construct(Request $request) {
        $this->client = new Client();

        $this->userProfile = User::query()
            ->where('username', $request->route('id'))
            ->firstOrFail()
            ->profile;
    }

    public function store(Request $request) {
        $gameId = $request->input('game_id');

        if ($this->userProfile->canHaveMoreFavoriteGames()) {
            $favoriteGame = UserProfileFavoriteGame::getSpecificProfileFavoriteGame($gameId, $this->userProfile->getId(), true);

            if ($favoriteGame) {
                $favoriteGame->restore();
            } else {
                $favoriteGame = UserProfileFavoriteGame::createProfileFavoriteGame($request->all());
            }

            return response()->json([
               'games' => UserProfileFavoriteGame::getAllProfileFavoriteGames($this->userProfile->getId())
            ]);
        }

        //The user can have no more favorite games
        return response()->json([
            'message' => 'You can not have more than 9 favorite games. Sorry!',
            'type' => 'tooManyGames'
        ]);
    }

    public function delete(Request $request) {
        $favoriteGame = UserProfileFavoriteGame::getSpecificProfileFavoriteGame($request->input('game_id'), $this->userProfile->getId());

        if ($favoriteGame) {
            $favoriteGame->delete();
        }

        return response()->json([
            'games' => UserProfileFavoriteGame::getAllProfileFavoriteGames($this->userProfile->getId())
        ]);
    }

}
