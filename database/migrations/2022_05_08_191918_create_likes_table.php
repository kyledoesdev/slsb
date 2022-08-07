<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLikesTable extends Migration {

    public function up() {
        Schema::create('likes', function(Blueprint $table){
            $table->id();
            $table->unsignedBigInteger('likers_user_id');
            $table->foreign('likers_user_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('post_id');
            $table->foreign('post_id')->references('id')->on('posts')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down() {
        Schema::table('likes', function(Blueprint $table){
            $table->dropForeign('likers_user_id');
            $table->dropForeign('post_id');
        });
        Schema::dropIfExists('likes');
    }
}
