<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterUsersTable extends Migration {

    public function up() {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('name');
            $table->string('username')->after('id');
            $table->string('first_name')->after('username')->nullable();
            $table->string('last_name')->after('first_name')->nullable();
            $table->unsignedBigInteger('profile_id')->after('password')->nullable();

            $table->foreign('profile_id')->references('id')->on('user_profiles')->onDelete('CASCADE');
        });
    }

    public function down() {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign('profile_id');
            $table->dropColumn('last_name');
            $table->dropColumn('first_name');
            $table->dropColumn('username');
            $table->string('name');
        });
    }
}
