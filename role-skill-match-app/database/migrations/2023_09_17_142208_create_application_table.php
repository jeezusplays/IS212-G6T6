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
        Schema::create('application', function (Blueprint $table) {
            $table->increments('application_id');
            $table->boolean('is_selected')->default(false);
            $table->date('application_date');
            $table->unsignedInteger('role_id');
            $table->unsignedInteger('staff_id');
            $table->timestamps();

            // Foreign Keys
            $table->foreign('role_id')->references('role_id')->on('role');
            $table->foreign('staff_id')->references('staff_id')->on('staff');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('application');
    }
};
