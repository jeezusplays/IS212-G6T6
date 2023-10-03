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
        Schema::create('role_listing', function (Blueprint $table) {
            $table->increments('listing_id');
            $table->unsignedInteger('role_id');
            $table->text('description');
            $table->unsignedInteger('department_id');
            $table->unsignedInteger('country_id');
            $table->integer('work_arrangement');
            $table->integer('vacancy');
            $table->integer('status');
            $table->date('deadline');
            $table->unsignedInteger('created_by');
            $table->timestamps();
            $table->Softdeletes();

            // Foreign Keys
            // $table->foreign('listing_id')->references('listing_id')->on('hiring_manager');
            $table->foreign('department_id')->references('department_id')->on('department');
            $table->foreign('country_id')->references('country_id')->on('country');
            $table->foreign('created_by')->references('staff_id')->on('staff');
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('role');
    }
};
