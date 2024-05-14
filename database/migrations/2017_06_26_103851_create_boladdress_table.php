<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBoladdressTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('boladdresses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('stop', 255)->nullable();
            $table->string('first', 255)->nullable();
            $table->string('last', 255)->nullable();
            $table->string('address', 255)->nullable();
            $table->string('city', 255)->nullable();
            $table->string('state', 255)->nullable();
            $table->string('zip', 255)->nullable();
            $table->string('contact', 255)->nullable();
            $table->string('type', 255)->nullable();
            $table->string('addr_id', 255)->nullable();
            $table->string('work_order_id', 255)->nullable();
            $table->string('bol_id', 255)->nullable();
            $table->string('user_id', 255)->nullable();
            $table->string('status')->default(0);
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
        Schema::dropIfExists('boladdresses');
    }
}
