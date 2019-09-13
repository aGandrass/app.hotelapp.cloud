<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentsettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('paymentsettings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('_language', 10);
            $table->string('_type', 20);
            $table->string('paymentHeader', 50);
            $table->mediumText('paymentText');
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
        Schema::dropIfExists('paymentsettings');
    }
}
