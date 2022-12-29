<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFavoriteGamesTable extends Migration {

    public function up() {
        Schema::create('user_profile_favorite_games', function (Blueprint $table) {
            $table->id();
            $table->foreignId('profile_id');
            $table->string('game_id');
            $table->string('game_title');
            $table->string('box_art_url');
            $table->string('formatted_box_art_url');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down() {
        Schema::dropIfExists('favorite_games');
    }
}
