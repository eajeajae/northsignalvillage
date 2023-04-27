<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->date('birthdate')->nullable();
            $table->integer('age')->nullable();
            $table->string('gender')->nullable();
            $table->integer('addressNo')->nullable();
            $table->string('street')->nullable();
            $table->integer('addressZone')->nullable();
            $table->string('phoneNum')->nullable();
            $table->string('avatar')->nullable();
            $table->string('valid_id')->nullable()->default('');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('role')->default('resident');
            $table->string('status')->default('not verified');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
