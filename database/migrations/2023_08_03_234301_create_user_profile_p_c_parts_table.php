<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void {
        Schema::create('user_profile_pc_parts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('profile_id');
            $table->foreignId('pc_part_id');
            $table->string('name')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void {
        Schema::dropIfExists('user_profile_pc_parts');
    }
};
