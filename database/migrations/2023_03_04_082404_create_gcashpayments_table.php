<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGcashpaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gcashpayments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('transactiondetail_id')->index();
            $table->string('gcashName');
            $table->string('gcashNumber');
            $table->string('amountPaid');
            $table->string('transactionId')->unique();
            $table->string('payment_img');
            $table->string('status')->default('for verification');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('gcashpayments');
    }
}
