<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchases', function (Blueprint $table) {
            $table->bigIncrements('purchase_id');
            $table->integer('purchase_ref_no')->index();
            $table->integer('purchase_supplier_id')->index();
            $table->integer('purchase_total_items');
            $table->integer('purchase_total_quantity');
            $table->integer('purchase_free_piece')->nullable();
            $table->integer('purchase_free_amount')->nullable();
            $table->string('purchase_status');//received,partial,pending,ordered,  final,quotation,
            $table->text('purchase_note')->nullable();
            // $table->date('purchase_date')->nullable();
            $table->decimal('purchase_total_price', 10, 2);
            $table->decimal('purchase_add_amount', 10, 2)->nullable();
            $table->decimal('purchase_discount', 10, 2)->nullable();
            $table->decimal('purchase_grandtotal_price', 10, 2);
            $table->decimal('purchase_total_amount_paid', 10, 2);
            $table->decimal('purchase_total_amount_dues', 10, 2);
            $table->string('purchase_payment_method');//cash,credit
            $table->string('purchase_payment_status');//paid,due,partial,overdue
            $table->text('purchase_payment_note')->nullable();
            // $table->decimal('purchase_payterm_number', 8, 2)->nullable();
            // $table->string('purchase_payterm_duration')->nullable();
            $table->string('purchase_document')->nullable();
            $table->integer('purchase_invoice_id')->index()->nullable();
            $table->date('purchase_invoice_date')->nullable();
            $table->integer('purchase_added_by');
            // $table->integer('purchase_payment_id')->index()->nullable();
            $table->integer('warehouse_id')->index()->nullable();
            // $table->string('purchase_warehouse')->index()->nullable();
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
        Schema::dropIfExists('purchases');
    }
}
