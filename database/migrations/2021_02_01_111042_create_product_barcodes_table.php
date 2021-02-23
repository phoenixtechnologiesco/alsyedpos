<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductBarcodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_barcodes', function (Blueprint $table) {
            $table->bigIncrements('product_barcode_id');
            $table->integer('product_id')->unsigned()->index();
            // $table->foreign('product_id')->references('product_id')->on('products')->onDelete('cascade');
            $table->string('product_barcode')->index();
            // $table->foreign('barcode_id')->references('barcode_id')->on('barcodes')->onDelete('cascade');
            // $table->integer('barcode_id')->unsigned()->index();
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
        Schema::dropIfExists('product_barcodes');
    }
}
