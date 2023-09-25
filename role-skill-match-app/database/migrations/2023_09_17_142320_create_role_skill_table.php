<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('role_skill', function (Blueprint $table) {
            $table->unsignedInteger('role_id');
            $table->unsignedInteger('skill_id');
            $table->timestamps();
            $table->Softdeletes();
            // Foreign Keys
            $table->foreign('role_id')->references('role_id')->on('role');
            $table->foreign('skill_id')->references('skill_id')->on('skill');

            // Composite Primary Keys
            $table->primary(['role_id', 'skill_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('role_skill');
    }
};
