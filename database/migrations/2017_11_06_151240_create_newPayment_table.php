<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewpaymentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('newpayments', function (Blueprint $table) {
            $table->increments('paymentid')->unique();
            $table->string('title', 10);
            $table->integer('_salutation')->unsigned();
            $table->foreign('_salutation')->references('salutationID')->on('salutations')->onUpdate('cascade');
            $table->string('firstname', 100);
            $table->string('lastname', 100);
            $table->string('email', 100);
            $table->string('telephone', 30)->nullable();
            $table->date('arrival')->nullable();
            $table->date('departure')->nullable();
            $table->decimal('rooms', 2, 0)->nullable();
            $table->decimal('persons', 2, 0)->nullable();
            $table->decimal('children', 2, 0)->nullable();
            $table->string('category', 100)->nullable();
            $table->decimal('total', 10, 2);
            $table->string('language', 10);
            $table->string('type', 20)->nullable();
            $table->string('cardholder', 100)->nullable();
            $table->string('stripetoken', 100)->nullable();
            $table->char('paymentuniqid', 100)->unique();
            $table->char('paymentaccess', 10)->default(0);
            $table->string('paymentstatus', 10)->nullable();
            $table->dateTime('paymentopendate')->nullable();
            $table->string('stripePaymentIntentid', 100)->nullable();
            $table->string('stripePaymentIntentStatus', 100)->nullable();
            $table->string('stripeerrorhttpstatus', 20)->nullable();
            $table->string('stripeerrormessage', 100)->nullable();
            $table->string('stripeerrortype', 100)->nullable();
            $table->string('stripeerrorcode', 100)->nullable();
            $table->string('stripeerrordecline_code', 100)->nullable();
            $table->string('stripeerrorcharge', 100)->nullable();
            $table->string('stripeerrorparam', 100)->nullable();
            $table->string('paymentuniqlink', 350)->nullable();
            $table->dateTime('paymentdate')->nullable();
            $table->string('paymentip', 20)->nullable();
            $table->text('paymentbrowser')->nullable();
            $table->string('paymentreferer', 300)->nullable();
            $table->string('paymentbrand', 100)->nullable();
            $table->decimal('paymentexpmonth', 2, 0)->nullable();
            $table->decimal('paymentexpyear', 4, 0)->nullable();
            $table->decimal('paymentlast4', 4, 0)->nullable();
            $table->decimal('confirm', 1, 0)->nullable();
            $table->integer('_user')->unsigned();
            $table->foreign('_user')->references('id')->on('users')->onUpdate('cascade');
            $table->decimal('active', 1, 0)->nullable();
            $table->integer('_userSoftdelete')->unsigned()->nullable();
            $table->foreign('_userSoftdelete')->references('id')->on('users')->onUpdate('cascade');
            $table->integer('_userLastEdit')->unsigned()->nullable();
            $table->foreign('_userLastEdit')->references('id')->on('users')->onUpdate('cascade');
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
        Schema::dropIfExists('newpayments');
    }
}
