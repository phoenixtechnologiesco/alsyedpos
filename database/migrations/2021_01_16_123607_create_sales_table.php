<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->bigIncrements('sale_id');
            $table->string('sale_ref_no')->index();
            $table->string('sale_customer_id')->index();
            // $table->string('sale_customer_name')->index();
            $table->integer('sale_total_items');
            $table->integer('sale_total_quantity');
            $table->integer('sale_free_piece')->nullable();
            $table->integer('sale_free_amount')->nullable();
            $table->string('sale_status');//completed/pending,final,draft,quotation,
            $table->text('sale_note')->nullable();
            // $table->date('sale_date')->nullable();
            $table->decimal('sale_total_price', 10, 2);
            $table->decimal('sale_add_amount', 10, 2)->nullable();
            $table->decimal('sale_discount', 10, 2)->nullable();
            $table->decimal('sale_grandtotal_price', 10, 2);
            $table->decimal('sale_total_amount_paid', 10, 2);
            $table->decimal('sale_total_amount_dues', 10, 2);
            $table->string('sale_payment_method');//cash,credit
            $table->string('sale_payment_status');//paid,due,partial,overdue
            $table->text('sale_payment_note')->nullable();
            $table->string('sale_document')->nullable();
            $table->integer('sale_invoice_id')->index()->nullable();
            $table->date('sale_invoice_date')->nullable();
            // $table->decimal('sale_payterm_number', 8, 2)->nullable();
            // $table->string('sale_payterm_duration')->nullable();
            $table->integer('sale_added_by');
            // $table->integer('sale_payment_id')->index();
            $table->integer('sale_warehouse_id')->index()->nullable();
            // $table->string('sale_warehouse')->index()->nullable();
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
        Schema::dropIfExists('sales');
    }
}
