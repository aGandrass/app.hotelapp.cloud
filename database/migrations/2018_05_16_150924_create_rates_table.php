<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rates', function (Blueprint $table) {
            $table->increments('id');
            $table->string('_ratesuperior');
            $table->foreign('_ratesuperior')->references('ratesuperiorID')->on('ratesuperior')->onUpdate('cascade');
            $table->string('_level');
            $table->foreign('_level')->references('levelsID')->on('levels')->onUpdate('cascade');
            $table->string('_category');
            $table->foreign('_category')->references('categoryID')->on('categories')->onUpdate('cascade');
            $table->decimal('ratesgl', 10, 2)->nullable();
            $table->decimal('ratedbl', 10, 2)->nullable();
            $table->integer('_user')->unsigned();
            $table->foreign('_user')->references('id')->on('users')->onUpdate('cascade');
            $table->timestamps();
        });

        Schema::create('calendar_rate', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('calendar_id')->unsigned()->index();
            $table->foreign('calendar_id')->references('id')->on('calendars')->onDelete('cascade');

            $table->integer('rate_id')->unsigned()->index();
            $table->foreign('rate_id')->references('id')->on('rates')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rates');
        Schema::dropIfExists('calendar_rate');
    }
}
