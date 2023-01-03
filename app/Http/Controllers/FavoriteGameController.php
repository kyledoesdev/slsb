<?php

namespace App\Http\Controllers;

use App\Models\UserProfileFavoriteGame;
use App\Models\User;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Log;

class FavoriteGameController extends Controller {

    protected $client;
    protected $userProfile;

    public function __construct() {
        $this->client = new Client();
    }

    public function searchForCategory(Request $request) {
        $phrase = $request->input('search-term');

        if (!isset($phrase) || $phrase === '') {
            abort(400);
        }

        $response = $this->client->request(
            "GET",
            "https://api.twitch.tv/helix/search/categories?query={$phrase}&first=9", [
                'headers' => [
                    'Authorization' => 'Bearer '.auth()->user()->external_token,
                    'Content-Type' => 'application/json',
                    'Client-Id' => env('TWITCH_CLIENT_ID'),
                ],
            ]
        );

        $body = json_decode($response->getBody());
        $results = [];

        $favoriteGames = UserProfileFavoriteGame::query()
            ->where('profile_id', auth()->user()->getUserProfileId())
            ->pluck('game_title')
            ->toArray();

        foreach ($body->data as $game) {
            if (!in_array($game->name, $favoriteGames)) {
                array_push($results, $game);
            }
        }

        return response()->json($results);
    }
    
    public function store(Request $request) {
        $userProfile = User::query()
            ->where('username', $request->input('username'))
            ->first()
            ->profile;

        if ($userProfile && $userProfile->canHaveMoreFavoriteGames()) {
            $favoriteGame = UserProfileFavoriteGame::query()
                ->withTrashed()
                ->where('game_id', $request->input('game_id'))
                ->where('profile_id', $userProfile->getId());

            if ($favoriteGame->exists()) {
                $favoriteGame->first()->restore();

            } else {
                $favoriteGame = UserProfileFavoriteGame::updateOrCreate([
                    'game_id' => $request->input('game_id'),
                ], [
                    'game_title' => $request->input('game_title'),
                    'box_art_url' => $request->input('box_art_url'),
                    'formatted_box_art_url' => 'https://static-cdn.jtvnw.net/ttv-boxart/'.$request->input('game_id').'-285x380.jpg',
                ]);
            }

            return response()->json([
               'games' => UserProfileFavoriteGame::query()
                    ->where('profile_id', auth()->user()->getUserProfileId())
                    ->orderBy('game_title', 'ASC')
                    ->get()
            ]);
        }

        //The user can have no more favorite games
        return response()->json([
            'message' => 'You can not have more than 9 favorite games. Sorry!',
            'type' => 'tooManyGames'
        ]);
    }

    public function delete(Request $request) {
        
        $userProfile = User::query()
            ->where('username', $request->input('username'))
            ->first()
            ->profile;

        if ($userProfile) {
            $favoriteGame = UserProfileFavoriteGame::query()
                ->where('profile_id', $userProfile->getId())
                ->where('game_id', $request->input('game_id'))
                ->first();

            $favoriteGame->delete();
        }

        return response()->json([
            'games' => UserProfileFavoriteGame::query()
                ->where('profile_id', auth()->user()->getUserProfileId())
                ->orderBy('game_title', 'ASC')
                ->get()
        ]);
    }

}
