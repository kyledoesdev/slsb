<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use GuzzleHttp\Client;
use Log;

class FollowController extends Controller {

    public function follow($id) {
        $follower = auth()->user();
        $followee = User::findOrFail($id);

        $follower->follow($followee);

        return response()->json([
            'followersCount' => count($followee->followers),
            'followingCount' => count($followee->following),
        ]);
    }

    public function unfollow($id) {
        $follower = auth()->user();
        $followee = User::findOrFail($id);

        $follower->unfollow($followee);

        return response()->json([
            'followersCount' => count($followee->followers),
            'followingCount' => count($followee->following),
        ]);
    }

    public function followersList($id) {
        $client = new Client();
        abort_if(auth()->user()->external_token == null, 401);
        $response = $client->request(
            'GET',
            'https://api.twitch.tv/helix/search/categories?query='.'factorio'.'&first=1', [
                'headers' => [
                    'Authorization' => 'Bearer '.auth()->user()->external_token,
                    'Content-Type' => 'application/json',
                    'Client-Id' => env('TWITCH_CLIENT_ID'),
                ],
            ]
        );

        $temp = json_decode($response->getBody());
        $box_art_id = $temp->data[0]->id;
        return view('test', ['box_art_id' => $box_art_id]);
    }

    public function followingList($id) {
        dd('following list');
    }

}
