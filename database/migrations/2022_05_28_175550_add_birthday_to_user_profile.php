<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddBirthdayToUserProfile extends Migration {

    public function up() {
        Schema::table('user_profiles', function (Blueprint $table) {
            $table->timestamp('birthday')->after('location')->nullable();
        });
    }

    public function down() {
        Schema::table('user_profiles', function (Blueprint $table) {
            $table->dropColumn('birthday');
        });
    }
}
