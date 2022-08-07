<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserTypesTable extends Migration {

    public function up() {
        Schema::create('user_types', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        Schema::table('users', function(Blueprint $table) {
            $table->unsignedBigInteger('user_type_id')->after('profile_id');
            $table->foreign('user_type_id')->references('id')->on('user_types');
        });
    }

    public function down() {
        Schema::table('users', function(Blueprint $table) {
            $table->dropForeign('user_type_id');
        });
        Schema::dropIfExists('user_types');
    }
}
