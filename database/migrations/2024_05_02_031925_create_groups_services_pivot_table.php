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
        Schema::create('groups_services_pivot', function (Blueprint $table) {
            $table->id();
            $table->foreignId('Service_id')->references('id')->on('Services')->onDelete('cascade');

            $table->foreignId('Group_id')->references('id')->on('groups')->onDelete('cascade');
            $table->integer('quantity');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('groups_services_pivot');
    }
};
