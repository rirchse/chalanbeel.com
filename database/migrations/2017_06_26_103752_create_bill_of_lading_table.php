<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBillOfLandingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('billofladings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('bol_number', 255);
            $table->string('containers', 255)->nullable();
            $table->string('total_weight', 255)->nullable();
            $table->string('vessel', 255)->nullable();
            $table->string('cross_dock_number', 255)->nullable();
            $table->string('pick_up', 255)->nullable();
            $table->string('delivery', 255)->nullable();
            $table->text('details')->nullable();
            $table->string('work_order_id', 255);
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
        Schema::dropIfExists('bill_of_landings');
    }
}
