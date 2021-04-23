<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSaleProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sale_products', function (Blueprint $table) {
            $table->bigIncrements('sale_products_id');
            $table->integer('sale_id')->unsigned()->index();
            $table->integer('product_id')->unsigned()->index();
            $table->string('sale_product_ref_no');
            $table->integer('warehouse_id');
            $table->string('sale_product_name');
            $table->string('sale_product_barcode');
            $table->string('sale_product_company')->nullable();
            $table->string('sale_product_brand')->nullable();
            $table->integer('sale_piece_per_packet');
            $table->integer('sale_packet_per_carton');
            $table->integer('sale_piece_per_carton');
            $table->integer('sale_pieces_number');
            $table->integer('sale_packets_number');
            $table->integer('sale_cartons_number');
            $table->decimal('sale_pieces_total', 10, 2);
            $table->decimal('sale_packets_total', 10, 2);
            $table->decimal('sale_cartons_total', 10, 2);
            $table->decimal('sale_quantity_total', 10, 2);
            $table->integer('sale_quantity_damage')->nullable();
            $table->integer('sale_trade_discount');
            $table->integer('sale_trade_price_piece');
            $table->integer('sale_trade_price_packet');
            $table->integer('sale_trade_price_carton');
            $table->decimal('sale_product_sub_total', 10, 3);
            // $table->integer('sale_invoice_id')->unsigned()->index();
            // $table->foreign('sale_id')->references('sale_id')->on('sales')->onDelete('cascade');
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
        Schema::dropIfExists('sale_products');
    }
}
