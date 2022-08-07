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

Route::middleware(['auth'])->group(function() {

    Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

    Route::resource('post', PostController::class)
        ->except(['destroy']);
    Route::post('post/{id}/destroy', 'PostController@destroy')->name('post.destroy');

    Route::post('/follow/{id}', [App\Http\Controllers\FollowController::class, 'follow'])->name('user.follow');
    Route::post('/unfollow/{id}', [App\Http\Controllers\FollowController::class, 'unfollow'])->name('user.unfollow');
    Route::get('/p/{id}/followers', [App\Http\Controllers\FollowController::class, 'followersList'])->name('user.follower_list');
    Route::get('/p/{id}/following', [App\Http\Controllers\FollowController::class, 'followingList'])->name('user.following_list');

    Route::post('/like/{id}', [App\Http\Controllers\LikeController::class, 'like'])->name('post.like');
    Route::post('/unlike/{id}', [App\Http\Controllers\LikeController::class, 'unlike'])->name('post.unlike');

    Route::get('/p/{id}', [App\Http\Controllers\UserProfileController::class, 'index'])->name('profile');
    Route::get('/p/{id}/edit', [App\Http\Controllers\UserProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/p/{id}/update', [App\Http\Controllers\UserProfileController::class, 'update'])->name('profile.update');

    Route::get('/settings', [App\Http\Controllers\UserAccountSettingsController::class, 'index'])->name('user.settings');
    Route::post('/settings/unlink_twitch', [App\Http\Controllers\TwitchController::class, 'disconnectFromTwitch'])->name('user.disconnect_from_twitch');

});


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

