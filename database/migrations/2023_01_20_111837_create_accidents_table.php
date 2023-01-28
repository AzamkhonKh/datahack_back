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
        Schema::create('accidents', function (Blueprint $table) {
            $table->id();
            $table->string('source')->default('dtp');
            $table->unsignedBigInteger('source_id');
            $table->point('location')->nullable();

            $table->unsignedBigInteger('type_id')->nullable();
            $table->foreign('type_id')->references('id')->on('accident_types');

            $table->unsignedBigInteger('region_id')->nullable();
            $table->foreign('region_id')->references('id')->on('regions');

            $table->unsignedBigInteger('district_id')->nullable();
            $table->foreign('district_id')->references('id')->on('districts');

            $table->unsignedBigInteger('road_part_id')->nullable();
            $table->foreign('road_part_id')->references('id')->on('road_parts');

            $table->unsignedBigInteger('road_surface_id')->nullable();
            $table->foreign('road_surface_id')->references('id')->on('road_surfaces');

            $table->unsignedBigInteger('road_condition_id')->nullable();
            $table->foreign('road_condition_id')->references('id')->on('road_conditions');

            $table->unsignedBigInteger('weather_condition_id')->nullable();
            $table->foreign('weather_condition_id')->references('id')->on('weather_conditions');

            $table->text('street_name')->nullable();
            $table->text('distance_from')->nullable();
            $table->text('accident_number')->nullable();
            $table->text('card_number')->nullable();
            $table->dateTime('date_accident')->nullable();
            $table->json('accident_json');
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
        Schema::dropIfExists('accidents');
    }
};
