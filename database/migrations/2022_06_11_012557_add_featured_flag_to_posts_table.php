<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFeaturedFlagToPostsTable extends Migration {

    public function up() {
        Schema::table('posts', function (Blueprint $table) {
            $table->boolean('is_featured')->after('total_like_count')->default(false);
        });
    }

    public function down() {
        Schema::table('posts', function (Blueprint $table) {
            $table->dropColumn('is_featured');
        });
    }
}
