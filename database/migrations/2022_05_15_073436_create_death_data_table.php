<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeathDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('death_data', function (Blueprint $table) {
            $table->id();
            $table->foreignId('family_card_id')->constrained();
            $table->bigInteger('NIK')->unique()->index();
            $table->string('full_name')->index();
            $table->enum('religion', ['Islam', 'Kristen', 'Budha', 'Hindu', 'Konghucu', 'Katolik'])->index();
            $table->string('birth_place')->index();
            $table->dateTime('birthdate')->index();
            $table->dateTime('deathdate')->index();
            // $table->integer('population_mortality_statistic');
            $table->string('address');
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
        Schema::dropIfExists('death_data');
    }
}
