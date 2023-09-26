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
        Schema::create('staff_skill', function (Blueprint $table) {
            $table->unsignedInteger('staff_id');
            $table->unsignedInteger('skill_id');
            $table->unsignedInteger('proficiency_id');
            $table->timestamps();
            $table->Softdeletes();
            // Foreign Keys
            $table->foreign('staff_id')->references('staff_id')->on('staff');
            $table->foreign('skill_id')->references('skill_id')->on('skill');
            $table->foreign('proficiency_id')->references('proficiency_id')->on('proficiency');

            // Composite Primary Key
            $table->primary(['staff_id', 'skill_id']);
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('staff_skill');
    }
};
