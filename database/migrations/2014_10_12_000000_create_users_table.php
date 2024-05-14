<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->string('first_name', 32)->nullable();
            $table->string('last_name', 32)->nullable();
            $table->string('email', 50)->unique();
            $table->string('password', 64);
            $table->string('contact', 18)->nullable();
            $table->string('dob', 20)->nullable();
            $table->string('address', 255)->nullable();
            $table->string('city', 32)->nullable();
            $table->string('state', 32)->nullable();
            $table->string('zip', 10)->nullable();
            $table->string('country', 32)->nullable();
            $table->string('type', 32)->nullable();
            $table->string('image', 255)->nullable();
            $table->string('status', 1)->default(0);
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
