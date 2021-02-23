<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSaleReturnsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sale_returns', function (Blueprint $table) {
            $table->bigIncrements('sale_return_id');
            $table->integer('sale_id');
            $table->integer('sale_ref_no');
            $table->integer('sale_return_customer_id');
            $table->integer('sale_return_product_pieces')->nullable();
            $table->integer('sale_return_product_packets')->nullable();
            $table->integer('sale_return_product_cartons')->nullable();
            $table->decimal('sale_return_unit_price', 10, 2);
            $table->integer('sale_return_product_quantity');
            $table->string('sale_status');//final,draft,quotation,
            // $table->string('sale_return_status');
            $table->date('sale_return_date')->nullable();
            $table->decimal('sale_return_total_price', 10, 2);
            $table->decimal('sale_return_grandtotal_price', 10, 2);
            $table->decimal('sale_return_amount_paid', 10, 2);
            $table->decimal('sale_return_amount_dues', 10, 2);
            $table->string('sale_return_payment_method');//cash,credit
            $table->string('sale_return_payment_status');//paid,due,partial,overdue
            $table->integer('sale_return_invoice_id')->nullable();
            $table->date('sale_return_invoice_date')->nullable();
            $table->string('sale_return_document')->nullable();
            // $table->text('sale_return_note')->nullable();
            $table->integer('sale_return_returned_by');
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
        Schema::dropIfExists('sale_returns');
    }
}
