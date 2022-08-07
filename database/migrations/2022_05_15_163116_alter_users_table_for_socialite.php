<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterUsersTableForSocialite extends Migration {

    public function up() {
        Schema::table('users', function(Blueprint $table) {
            $table->string('external_id')->after('id')->nullable();
            $table->string('password')->nullable()->change(); //for social login
            $table->string('external_token')->after('remember_token')->nullable();
            $table->string('external_refresh_token')->after('external_token')->nullable();
            $table->timestamp('connected_timestamp')->after('external_refresh_token')->nullable();
        });
    }

    public function down() {
        Schema::table('users', function(Blueprint $table) {
            $table->dropColumn('external_id');
            $table->string('password')->change();
            $table->dropColumn('external_token');
            $table->dropColumn('external_refresh_token');
            $table->dropColumn('connected_timestamp');
        });
    }
}
