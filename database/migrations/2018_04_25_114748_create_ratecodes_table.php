<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRatecodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ratecodes', function (Blueprint $table) {
            $table->string('ratecodeID')->primary();
            $table->string('description', 100);
            $table->decimal('discount', 10, 2)->nullable();
            $table->decimal('mlosdays', 10, 0)->nullable();
            $table->decimal('releasedays', 10, 0)->nullable();
            $table->integer('_user')->unsigned();
            $table->foreign('_user')->references('id')->on('users')->onUpdate('cascade');
            $table->string('_discounton');
            $table->foreign('_discounton')->references('ratesuperiorID')->on('ratesuperior')->onUpdate('cascade');
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
        Schema::dropIfExists('ratecodes');
    }
}
