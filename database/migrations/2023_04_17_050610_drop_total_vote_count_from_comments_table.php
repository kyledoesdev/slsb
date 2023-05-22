<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void {
        Schema::table('comments', function (Blueprint $table) {
            $table->dropColumn('vote_count');
        });
    }

    public function down(): void {
        Schema::table('comments', function (Blueprint $table) {
            $table->bigInteger('vote_count')->default(0)->nullable();
        });
    }
};
