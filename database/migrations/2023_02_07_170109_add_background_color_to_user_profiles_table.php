<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up() {
        Schema::table('user_profiles', function (Blueprint $table) {
            $table->string('background_color')->after('avatar')->nullable();
        });
    }

    public function down() {
        Schema::table('user_profiles', function (Blueprint $table) {
            $table->dropColumn('background_color');
        });
    }
};
