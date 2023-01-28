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
        Schema::create('accident_vehicles', function (Blueprint $table) {
            $table->id();
            $table->string('source')->default('dtp');
            $table->unsignedBigInteger('source_id');
            $table->json('technical_issues')->nullable();
            $table->json('vehicle_brand')->nullable();
            $table->json('vehicle_model')->nullable();
            $table->json('vehicle_type')->nullable();
            $table->json('vehicle_color')->nullable();
            $table->integer('year_manufacture')->nullable();


            $table->unsignedBigInteger('accident_id')->nullable();
            $table->foreign('accident_id')->references('id')->on('accidents');
            
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
        Schema::dropIfExists('accident_vehicles');
    }
};
