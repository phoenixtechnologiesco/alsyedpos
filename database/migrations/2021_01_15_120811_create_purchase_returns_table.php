<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchaseReturnsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_returns', function (Blueprint $table) {
            $table->bigIncrements('purchase_return_id');
            $table->integer('purchase_id');
            $table->integer('purchase_ref_no');
            // $table->integer('purchase_return_supplier_id');
            $table->integer('purchase_return_product_pieces')->nullable();
            $table->integer('purchase_return_product_packets')->nullable();
            $table->integer('purchase_return_product_cartons')->nullable();
            $table->decimal('purchase_return_unit_price', 10, 2);
            $table->integer('purchase_return_product_quantity');
            $table->string('purchase_status');//received,partial,pending,ordered
            // $table->string('purchase_return_status');
            $table->date('purchase_return_date')->nullable();
            $table->decimal('purchase_return_total_price', 10, 2);
            $table->decimal('purchase_return_grandtotal_price', 10, 2);
            $table->decimal('purchase_return_amount_paid', 10, 2);
            $table->decimal('purchase_return_amount_dues', 10, 2);
            $table->string('purchase_return_payment_method');//cash,credit
            $table->string('purchase_return_payment_status');//paid,due,partial,overdue
            $table->integer('purchase_return_invoice_id')->nullable();
            $table->date('purchase_return_invoice_date')->nullable();
            $table->string('purchase_return_document')->nullable();
            // $table->text('purchase_return_note')->nullable();
            $table->integer('purchase_return_returned_by');
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
        Schema::dropIfExists('purchase_returns');
    }
}
