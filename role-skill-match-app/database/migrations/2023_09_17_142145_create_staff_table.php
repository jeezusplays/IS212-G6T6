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
        Schema::create('staff', function (Blueprint $table) {
            $table->increments('staff_id');
            $table->string('staff_fname');
            $table->string('staff_lname');
            $table->unsignedInteger('department_id');
            $table->unsignedInteger('country_id');
            $table->unsignedInteger('access_id');
            $table->string('email');
            $table->timestamps();

            // Foreign Keys
            $table->foreign('department_id')->references('department_id')->on('department');
            $table->foreign('country_id')->references('country_id')->on('country');
            $table->foreign('access_id')->references('access_id')->on('access_rights');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('staff');
    }
};
