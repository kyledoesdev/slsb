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
Route::get('/login/twitch', [App\Http\Controllers\Twitch\TwitchAuthenticationController::class, 'redirectToTwitchProvider']);
Route::get('/login/twitch/callback', [App\Http\Controllers\Twitch\TwitchAuthenticationController::class, 'handleTwitchProviderCallback']);
Route::get('/about-avatars', [App\Http\Controllers\AboutController::class, 'avatars'])->name('about.avatars');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/post/{id}', [App\Http\Controllers\PostController::class, 'show'])->name('post.show');

Route::middleware(['auth'])->group(function() {

    Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');

    /**
     * Posts
     */
    Route::post('/post/store', [App\Http\Controllers\PostController::class, 'store'])->name('post.store');
    
    Route::middleware('posts')->group(function() {
        Route::get('/post/{id}/edit', [App\Http\Controllers\PostController::class, 'edit'])->name('post.edit');
        Route::post('/post/{id}/update', [App\Http\Controllers\PostController::class, 'update'])->name('post.update');
        Route::post('/post/{id}/destroy', [App\Http\Controllers\PostController::class, 'destroy'])->name('post.destroy');
    });

    /**
     * User Profiles
     */
    Route::get('/twitch/categories', [App\Http\Controllers\Twitch\TwitchSearchController::class, 'search'])->name('favorite_game.search');
    Route::post('/pc_parts/store', [App\Http\Controllers\PCPartsController::class, 'store'])->name('pc_parts.store');
    Route::post('/pc_parts/update', [App\Http\Controllers\PCPartsController::class, 'update'])->name('pc_parts.update');
    Route::post('/pc_parts/delete', [App\Http\Controllers\PCPartsController::class, 'delete'])->name('pc_parts.delete');
    Route::post('/{id}/favorite_game/store', [App\Http\Controllers\FavoriteGameController::class, 'store'])->name('favorite_game.store');
    Route::post('/{id}/favorite_game/delete', [App\Http\Controllers\FavoriteGameController::class, 'delete'])->name('favorite_game.delete');

    Route::middleware(['user_profile'])->group(function() {
        Route::get('/{id}/edit', [App\Http\Controllers\UserProfileController::class, 'edit'])->name('profile.edit');
        Route::post('/{id}/update', [App\Http\Controllers\UserProfileController::class, 'update'])->name('profile.update');
        Route::get('/{id}/settings', [App\Http\Controllers\UserAccountSettingsController::class, 'index'])->name('user.settings');
        Route::post('/{id}/settings/unlink_twitch', [App\Http\Controllers\Twitch\TwitchAuthenticationController::class, 'disconnectFromTwitch'])->name('user.disconnect_from_twitch');
    });

    /**
     * Follows + Likes
     */
    Route::post('/follow/{id}', [App\Http\Controllers\FollowController::class, 'follow'])->name('user.follow');
    Route::post('/unfollow/{id}', [App\Http\Controllers\FollowController::class, 'unfollow'])->name('user.unfollow');
    Route::get('/{id}/followers', [App\Http\Controllers\FollowListController::class, 'followersList'])->name('user.follower_list');
    Route::get('/{id}/following', [App\Http\Controllers\FollowListController::class, 'followingList'])->name('user.following_list');

    Route::post('/like/{id}', [App\Http\Controllers\LikeController::class, 'like'])->name('post.like');
    Route::post('/unlike/{id}', [App\Http\Controllers\LikeController::class, 'unlike'])->name('post.unlike');

    /**
     * Comments
     */
    Route::post('/comment/{postId}/store', [App\Http\Controllers\CommentController::class, 'store'])->name('comment.store');
    Route::post('/comment/{commentId}/update', [App\Http\Controllers\CommentController::class, 'update'])->name('comment.update');
    Route::post('/comment/{commentId}/delete', [App\Http\Controllers\CommentController::class, 'delete'])->name('comment.delete');
    Route::post('/comment/{commentId}/reply', [App\Http\Controllers\CommentController::class, 'reply'])->name('comment.reply');
    
    Route::post('/comment/{commentId}/rate', [App\Http\Controllers\CommentRatingController::class, 'vote'])->name('comment.vote');
});

Route::get('{id}', [App\Http\Controllers\UserProfileController::class, 'show'])->name('profile.show');