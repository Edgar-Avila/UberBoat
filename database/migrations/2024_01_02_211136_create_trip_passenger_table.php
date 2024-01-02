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
        Schema::create('trip_passenger', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('trip_id');
            $table->unsignedBigInteger('passenger_id');

            $table->foreign('trip_id')->references('id')->on('trips')->onDelete('cascade');
            $table->foreign('passenger_id')->references('id')->on('passengers')->onDelete('cascade');

            $table->smallInteger('rating')->nullable();
            $table->text('comment')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trip_passenger');
    }
};
