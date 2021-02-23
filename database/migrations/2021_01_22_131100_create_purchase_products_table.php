<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchaseProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_products', function (Blueprint $table) {
            $table->bigIncrements('purchase_products_id');
            $table->integer('purchase_id')->unsigned()->index();
            $table->integer('product_id')->unsigned()->index();
            $table->string('purchase_product_ref_no');
            $table->integer('warehouse_id');
            $table->string('purchase_product_name');
            $table->string('purchase_product_barcode');
            $table->string('purchase_product_company')->nullable();
            $table->string('purchase_product_brand')->nullable();
            $table->integer('purchase_piece_per_packet');
            $table->integer('purchase_packet_per_carton');
            $table->integer('purchase_piece_per_carton');
            $table->integer('purchase_pieces_total');
            $table->integer('purchase_packets_total');
            $table->integer('purchase_cartons_total');
            $table->integer('purchase_quantity_total');
            $table->integer('purchase_quantity_damage')->nullable();
            $table->integer('purchase_trade_discount');
            $table->integer('purchase_trade_price_piece');
            $table->integer('purchase_trade_price_packet');
            $table->integer('purchase_trade_price_carton');
            $table->integer('purchase_product_sub_total');
            // $table->integer('purchase_invoice_id')->unsigned()->index();
            // $table->foreign('purchase_id')->references('purchase_id')->on('purchases')->onDelete('cascade');
            // $table->foreign('product_id')->references('product_id')->on('products')->onDelete('cascade');
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
        Schema::dropIfExists('purchase_products');
    }
}
