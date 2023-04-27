<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCertificatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('certificates', function (Blueprint $table) {
            $table->id();
            $table->string('control_no')->unique();
            $table->string('purpose');
            $table->string('isRegistered');
            $table->string('havePendingCase');
            $table->string('name');
            $table->string('gender');
            $table->string('birthdate');
            $table->string('p_birth');
            $table->string('nationality');
            $table->string('contact_num');
            $table->string('c_status');
            $table->integer('addressNo')->nullable();
            $table->string('street')->nullable();
            $table->integer('addressZone')->nullable();
            $table->string('provincialAddress')->nullable();
            $table->string('yearLiving');
            $table->string('areYouSure');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('typeforequest_id');
            $table->foreign('typeforequest_id')->references('id')->on('typeofrequests')->onDelete('cascade');
            $table->string('typeofdoc');
            $table->string('price');
            $table->string('status')->default('in cart');
            $$table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('certificates');
    }
}
