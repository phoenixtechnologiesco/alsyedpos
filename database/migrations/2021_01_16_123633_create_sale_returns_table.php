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
            $table->integer('sale_return_ref_no');
            $table->integer('sale_return_customer_id');
            $table->integer('sale_return_total_items');
            $table->integer('sale_return_total_quantity');
            $table->integer('sale_return_free_piece')->nullable();
            $table->integer('sale_return_free_amount')->nullable();
            $table->string('sale_return_status');
            // $table->string('sale_status');//completed,pending,final,draft,quotation,
            $table->date('sale_return_date')->nullable();
            $table->decimal('sale_return_total_price', 10, 2);
            $table->decimal('sale_return_add_amount', 10, 2)->nullable();
            $table->decimal('sale_return_discount', 10, 2)->nullable();
            $table->decimal('sale_return_grandtotal_price', 10, 2);
            $table->decimal('sale_return_amount_return', 10, 2);
            $table->decimal('sale_return_amount_dues', 10, 2);
            $table->string('sale_return_payment_method');//cash,credit
            $table->string('sale_return_payment_status');//paid,due,partial,overdue
            $table->string('sale_return_invoice_id')->nullable();
            $table->date('sale_return_invoice_date')->nullable();
            $table->string('sale_return_document')->nullable();
            $table->text('sale_return_note')->nullable();
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
