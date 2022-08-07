<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddLocationToUserProfiles extends Migration {

    public function up() {
        Schema::table('user_profiles', function (Blueprint $table) {
            $table->string('location')->after('bio')->nullable();
        });
    }

    public function down() {
        Schema::table('user_profiles', function (Blueprint $table) {
            $table->dropColumn('location');
        });
    }
}
