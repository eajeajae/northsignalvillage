<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateScholarshipsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('scholarships', function (Blueprint $table) {
            $table->id();
            $table->string('scholarFname')->nullable();
            $table->string('scholarPhonenum')->nullable();
            $table->string('scholarSchool')->nullable();
            $table->string('scholarCourse')->nullable();
            $table->string('scholarEmail')->nullable();
            $table->string('scholarCor_img')->nullable();
            $table->string('scholarGrade_img')->nullable();
            $table->string('status')->default('processing');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('scholarships');
    }
}
