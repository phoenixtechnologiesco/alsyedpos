<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('product_id');
            $table->string('product_ref_no')->index();
            // $table->string('product_type')->nullable();//single,variable or standard,digital,combo
            $table->integer('warehouse_id')->index()->nullable();
            $table->string('product_name')->unique();
            $table->bigInteger('product_barcode')->index();
            // $table->string('product_barcode_type')->nullable();//C128, C39, EAN-13, EAN-8, UPC-A, UPC-E, ITF-14
            $table->string('product_company')->index()->nullable();
            $table->string('product_brand')->index()->nullable();
            // $table->string('product_unit')->nullable();//unit,packet,carton
            $table->integer('product_piece_per_packet')->nullable();
            $table->integer('product_packet_per_carton')->nullable();
            $table->integer('product_piece_per_carton')->nullable();
            $table->integer('product_pieces_total')->default(0);
            $table->decimal('product_packets_total', 10, 2)->default(0);
            $table->decimal('product_cartons_total', 10, 2)->default(0);
            $table->integer('product_pieces_available')->default(0);
            $table->decimal('product_packets_available', 10, 2)->default(0);
            $table->decimal('product_cartons_available', 10, 2)->default(0);
            $table->decimal('product_quantity_total', 10, 2);
            $table->decimal('product_quantity_available', 10, 2);
            $table->integer('product_quantity_damage')->nullable();
            $table->integer('product_alert_quantity')->nullable();
            $table->decimal('product_trade_discount', 10, 2)->nullable();
            $table->decimal('product_trade_price_piece', 10, 2)->nullable();
            $table->decimal('product_trade_price_packet', 10, 2)->nullable();
            $table->decimal('product_trade_price_carton', 10, 2)->nullable();
            $table->decimal('product_credit_price_piece', 10, 2)->nullable();
            $table->decimal('product_credit_price_packet', 10, 2)->nullable();
            $table->decimal('product_credit_price_carton', 10, 2)->nullable();
            $table->decimal('product_cash_price_piece', 10, 2)->nullable();
            $table->decimal('product_cash_price_packet', 10, 2)->nullable();
            $table->decimal('product_cash_price_carton', 10, 2)->nullable();
            $table->decimal('product_nonbulk_price_piece', 10, 2)->nullable();
            $table->decimal('product_nonbulk_price_packet', 10, 2)->nullable();
            $table->decimal('product_nonbulk_price_carton', 10, 2)->nullable();
            $table->string('product_state');//damage,faulty,etc
            $table->date('product_expiry_date')->nullable();
            $table->text('product_info')->nullable();
            $table->integer('status_id')->index();//active,inactive
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
        Schema::dropIfExists('products');
    }
}
