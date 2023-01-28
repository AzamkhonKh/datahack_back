<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accident_participants', function (Blueprint $table) {
            $table->id();
            $table->string('source')->default('dtp');
            $table->unsignedBigInteger('source_id');
            
            $table->unsignedBigInteger('vehicle_id')->nullable();
            $table->foreign('vehicle_id')->references('id')->on('accident_vehicles');

            $table->unsignedBigInteger('accident_id')->nullable();
            $table->foreign('accident_id')->references('id')->on('accidents');

            $table->string('type')->nullable();
            $table->string('gender_type')->nullable();
            $table->string('health_condition')->nullable();
            $table->json('violation')->nullable();
            $table->integer('age')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('accident_participants');
    }
};
