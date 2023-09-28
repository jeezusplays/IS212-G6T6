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
            $table->unsignedInteger('listing_id');
            $table->unsignedInteger('staff_id');
            $table->timestamps();
            $table->Softdeletes();
            // Foreign Keys
            $table->foreign('listing_id')->references('listing_id')->on('role_listing');
            $table->foreign('staff_id')->references('staff_id')->on('staff');

            // Composite Primary Keys
            $table->primary(['listing_id', 'staff_id']);
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
