<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSchedulevaccinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schedulevaccines', function (Blueprint $table) {
            $table->id();
            $table->string('scheduleId');
            $table->string('name')->nullable();
            $table->string('contact_num')->nullable();
            $table->unsignedBigInteger('vaccine_id')->nullable();
            $table->string('vaccineName');
            $table->date('date')->nullable();
            $table->timestamps('time')->nullable();
            $table->string('addressNo')->nullable();
            $table->string('street')->nullable();
            $table->string('email')->nullable();
            $table->string('status')->default('waiting list');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('vaccine_id')->references('id')->on('vaccines')->onDelete('cascade');
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
        Schema::dropIfExists('schedulevaccines');
    }
}
