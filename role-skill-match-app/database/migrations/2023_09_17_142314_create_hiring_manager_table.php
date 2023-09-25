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
        Schema::create('hiring_manager', function (Blueprint $table) {
            $table->unsignedInteger('role_id');
            $table->unsignedInteger('staff_id');
            $table->timestamps();

            // Foreign Keys
            $table->foreign('role_id')->references('role_id')->on('role');
            $table->foreign('staff_id')->references('staff_id')->on('staff');

            // Composite Primary Keys
            $table->primary(['role_id', 'staff_id']);
            $table->Softdeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hiring_manager');
    }
};
