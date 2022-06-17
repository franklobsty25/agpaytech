<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCountriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('countries', function (Blueprint $table) {
            $table->id();
            $table->char('continent_code', 2);
            $table->char('currency_code', 3);
            $table->char('iso2_code', 3);
            $table->char('iso3_code', 3);
            $table->integer('iso_numeric_code');
            $table->char('fips_code', 2);
            $table->string('calling_code');
            $table->string('common_name');
            $table->string('official_name');
            $table->string('endonym');
            $table->string('demonym');
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
        Schema::dropIfExists('countries');
    }
}
