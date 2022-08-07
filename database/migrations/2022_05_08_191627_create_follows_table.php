<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFollowsTable extends Migration {

    public function up() {
        Schema::create('follows', function(Blueprint $table){
            $table->id();
            $table->unsignedBigInteger('follower_user_id');
            $table->foreign('follower_user_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('followee_user_id');
            $table->foreign('followee_user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down() {
        Schema::table('follows', function(Blueprint $table) {
            $table->dropForeign('follower_user_id');
            $table->dropForeign('followee_user_id');
        });
        Schema::dropIfExists('follows');
    }
}
