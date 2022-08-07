<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration {

    public function up() {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('title');
            $table->text('body'); //this is required to be a text field so we can store > 256 chars
            $table->unsignedBigInteger('total_like_count')->default(0);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    public function down() {
        Schema::table('posts', function (Blueprint $table) {
            $table->dropForeign('user_id');
        });
        Schema::dropIfExists('posts');
    }
}
