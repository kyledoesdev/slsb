<?php

namespace App\Http\Controllers\Twitch;

use App\Models\UserProfileFavoriteGame;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class TwitchSearchController {

    protected $client;

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

        $data = collect(json_decode($response->getBody())->data);

        $favoriteGames = UserProfileFavoriteGame::query()
            ->where('profile_id', auth()->user()->getUserProfileId())
            ->pluck('game_title');

        $data = $data->reject(function($game) use ($favoriteGames) {
            return $favoriteGames->contains($game->name);
        });

        return response()->json($data->flatten());
    }
}
