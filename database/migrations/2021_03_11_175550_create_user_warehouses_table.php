<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserWarehousesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_warehouses', function (Blueprint $table) {
            $table->bigIncrements('user_warehouses_id');
            $table->integer('user_id')->unsigned()->index();
            // $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade');
            $table->integer('warehouse_id')->unsigned()->index();
            // $table->foreign('warehouse_id')->references('warehouse_id')->on('warehouses')->onDelete('cascade');
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
        Schema::dropIfExists('user_warehouses');
    }
}
