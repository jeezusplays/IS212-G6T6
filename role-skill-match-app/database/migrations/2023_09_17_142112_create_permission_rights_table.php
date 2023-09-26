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
        Schema::create('permission_rights', function (Blueprint $table) {
            $table->increments('permission_rights_id');
            $table->unsignedInteger('permission_id');
            $table->unsignedInteger('access_id');
            $table->timestamps();

            // Foreign Keys
            $table->foreign('permission_id')->references('permission_id')->on('permission');
            $table->foreign('access_id')->references('access_id')->on('access_rights');
            $table->Softdeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('permission_rights');
    }
};
