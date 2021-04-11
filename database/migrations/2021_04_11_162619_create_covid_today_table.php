<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCovidTodayTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('covid_today', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('total_covid');
            $table->bigInteger('today_covid');
            $table->bigInteger('today_recovered');
            $table->bigInteger('total_recovered');
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
        Schema::dropIfExists('covid_today');
    }
}
