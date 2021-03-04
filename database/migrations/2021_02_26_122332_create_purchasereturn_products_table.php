<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchasereturnProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchasereturn_products', function (Blueprint $table) {
            $table->bigIncrements('purchasereturn_products_id');
            $table->integer('purchasereturn_id')->unsigned()->index();
            $table->integer('product_id')->unsigned()->index();
            $table->string('purchasereturn_product_ref_no');
            $table->integer('warehouse_id');
            $table->string('purchasereturn_product_name');
            $table->string('purchasereturn_product_barcode');
            $table->string('purchasereturn_product_company')->nullable();
            $table->string('purchasereturn_product_brand')->nullable();
            $table->integer('purchasereturn_piece_per_packet');
            $table->integer('purchasereturn_packet_per_carton');
            $table->integer('purchasereturn_piece_per_carton');
            $table->integer('purchasereturn_pieces_total');
            $table->integer('purchasereturn_packets_total');
            $table->integer('purchasereturn_cartons_total');
            $table->integer('purchasereturn_quantity_total');
            $table->integer('purchasereturn_quantity_damage')->nullable();
            $table->integer('purchasereturn_trade_discount');
            $table->integer('purchasereturn_trade_price_piece');
            $table->integer('purchasereturn_trade_price_packet');
            $table->integer('purchasereturn_trade_price_carton');
            $table->integer('purchasereturn_product_sub_total');
            // $table->integer('purchasereturn_invoice_id')->unsigned()->index();
            // $table->foreign('purchasereturn_id')->references('purchasereturn_id')->on('purchases')->onDelete('cascade');
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
        Schema::dropIfExists('purchasereturn_products');
    }
}
