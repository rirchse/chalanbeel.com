<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTicketTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->increments('id');
            $table->string('state', 255)->nullable();
            $table->string('last_free_day', 255)->nullable();
            $table->string('last_rec_day', 255)->nullable();
            $table->string('appt_time', 255)->nullable();
            $table->string('unload_time', 255)->nullable();
            $table->string('day_rate', 255)->nullable();
            $table->string('night_rate', 255)->nullable();
            $table->string('forklift_charge', 255)->nullable();
            $table->string('wait_time_rate', 255)->nullable();
            $table->string('driver_wait_time', 255)->nullable;
            $table->string('in_line', 255)->nullable;
            $table->string('in_gate', 255)->nullable;
            $table->string('cross_dock', 255)->nullable;
            $table->string('exit', 255)->nullable;
            $table->string('account_code', 255)->nullable;
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
        Schema::dropIfExists('tickets');
    }
}
