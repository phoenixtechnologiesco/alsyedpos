<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalereturnProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('salereturn_products', function (Blueprint $table) {
            $table->bigIncrements('salereturn_products_id');
            $table->integer('salereturn_id')->unsigned()->index();
            $table->integer('product_id')->unsigned()->index();
            $table->string('salereturn_product_ref_no');
            $table->integer('warehouse_id');
            $table->string('salereturn_product_name');
            $table->string('salereturn_product_barcode');
            $table->string('salereturn_product_company')->nullable();
            $table->string('salereturn_product_brand')->nullable();
            $table->integer('salereturn_piece_per_packet');
            $table->integer('salereturn_packet_per_carton');
            $table->integer('salereturn_piece_per_carton');
            $table->integer('salereturn_pieces_total');
            $table->integer('salereturn_packets_total');
            $table->integer('salereturn_cartons_total');
            $table->integer('salereturn_quantity_total');
            $table->integer('salereturn_quantity_damage')->nullable();
            $table->integer('salereturn_trade_discount');
            $table->integer('salereturn_trade_price_piece');
            $table->integer('salereturn_trade_price_packet');
            $table->integer('salereturn_trade_price_carton');
            $table->integer('salereturn_product_sub_total');
            // $table->integer('salereturn_invoice_id')->unsigned()->index();
            // $table->foreign('salereturn_id')->references('salereturn_id')->on('sales')->onDelete('cascade');
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
        Schema::dropIfExists('salereturn_products');
    }
}
