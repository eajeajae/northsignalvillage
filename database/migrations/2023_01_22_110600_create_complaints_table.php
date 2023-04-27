<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComplaintsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('complaints', function (Blueprint $table) {
            $table->id();
            $table->string('caseNo')->unique();
            $table->string('complainantName');
            $table->integer('cAddressno')->nullable();
            $table->string('cStreet')->nullable();
            $table->integer('cAddresszone')->nullable();
            $table->string('respondentName');
            $table->string('respondentAge');
            $table->integer('rAddressno')->nullable();
            $table->string('rStreet')->nullable();
            $table->integer('rAddresszone')->nullable();
            $table->string('complaintDesc');
            $table->integer('locationAddressno')->nullable();
            $table->string('locationStreet')->nullable();
            $table->string('complaintWhy');
            $table->string('complainantPrayer');
            $table->string('complaintDate');
            $table->string('complainantAgrees');
            $table->string('status')->default('pending');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('typeofrequest_id');
            $table->foreign('typeofrequest_id')->references('id')->on('typeofrequests')->onDelete('cascade');
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
        Schema::dropIfExists('complaints');
    }
}
