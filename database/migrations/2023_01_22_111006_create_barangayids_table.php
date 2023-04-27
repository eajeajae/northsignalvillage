<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBarangayidsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('barangayids', function (Blueprint $table) {
            $table->id();
            $table->string('fullname')->nullable();
            $table->date('birthdate')->nullable();
            $table->string('contactno')->nullable();
            $table->integer('addressNo')->nullable();
            $table->string('street')->nullable();
            $table->integer('addressZone')->nullable();
            $table->string('precintNo')->nullable();
            $table->string('contactperson')->nullable();
            $table->string('guardianContact')->nullable();
            $table->string('guardianAddress')->nullable();
            $table->string('id_img')->nullable();
            $table->string('status')->default('in cart');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('typeofrequest_id');
            $table->foreign('typeofrequest_id')->references('id')->on('typeofrequests')->onDelete('cascade');
            $table->string('price');
            $table->unsignedBigInteger('transactiondetail_id')->nullable();
            $table->foreign('transactiondetail_id')->references('id')->on('transactiondetails')->onDelete('cascade');
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
        Schema::dropIfExists('barangayids');
    }
}
