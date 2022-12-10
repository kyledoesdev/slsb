<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'HomeController@index')->name('home');
Route::get('login/twitch', [App\Http\Controllers\TwitchController::class, 'redirectToTwitchProvider']);
Route::get('login/twitch/callback', [App\Http\Controllers\TwitchController::class, 'handleTwitchProviderCallback']);
Route::get('/about-avatars', [App\Http\Controllers\AboutController::class, 'avatars'])->name('about.avatars');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth'])->group(function() {

    Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

    /**
     * Posts
     */
    Route::get('/post/{id}', [App\Http\Controllers\PostController::class, 'show'])->name('post.show');
    Route::get('/post/create', [App\Http\Controllers\PostController::class, 'create'])->name('post.create');
    
    Route::middleware('posts')->group(function() {
        Route::get('post/{id}/edit', [App\Http\Controllers\PostController::class, 'edit'])->name('post.edit');
        Route::post('post/store', [App\Http\Controllers\PostController::class, 'store'])->name('post.store');
        Route::post('post/{id}/update', [App\Http\Controllers\PostController::class, 'update'])->name('post.update');
        Route::post('post/{id}/destroy', [App\Http\Controllers\PostController::class, 'destroy'])->name('post.destroy');
    });

    /**
     * Follows + Likes
     */
    Route::post('/follow/{id}', [App\Http\Controllers\FollowController::class, 'follow'])->name('user.follow');
    Route::post('/unfollow/{id}', [App\Http\Controllers\FollowController::class, 'unfollow'])->name('user.unfollow');
    Route::get('/{id}/followers', [App\Http\Controllers\FollowController::class, 'followersList'])->name('user.follower_list');
    Route::get('/{id}/following', [App\Http\Controllers\FollowController::class, 'followingList'])->name('user.following_list');

    Route::post('/like/{id}', [App\Http\Controllers\LikeController::class, 'like'])->name('post.like');
    Route::post('/unlike/{id}', [App\Http\Controllers\LikeController::class, 'unlike'])->name('post.unlike');

    /**
     * User Profiles
     */
    Route::get('/{id}', [App\Http\Controllers\UserProfileController::class, 'show'])->name('profile.show');
    
    Route::middleware(['user_profile'])->group(function() {
        Route::get('/{id}/edit', [App\Http\Controllers\UserProfileController::class, 'edit'])->name('profile.edit');
        Route::post('/{id}/update', [App\Http\Controllers\UserProfileController::class, 'update'])->name('profile.update');
        Route::get('{id}/settings', [App\Http\Controllers\UserAccountSettingsController::class, 'index'])->name('user.settings');
        Route::post('{id}/settings/unlink_twitch', [App\Http\Controllers\TwitchController::class, 'disconnectFromTwitch'])->name('user.disconnect_from_twitch');
    
        /**
         * Favorite Game Tab
         */
        Route::post('{id}/favorite_game/store', [App\Http\Controllers\FavoriteGameController::class, 'store'])->name('favorite_game.store');
        Route::post('{id}/favorite_game/delete', [App\Http\Controllers\FavoriteGameController::class, 'delete'])->name('favorite_game.delete');
    });
});