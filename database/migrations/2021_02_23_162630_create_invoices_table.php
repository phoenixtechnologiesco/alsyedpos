<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->bigIncrements('invoice_id');
            $table->string('invoice_no');
            $table->integer('sale_id')->index()->nullable();
            $table->integer('sale_return_id')->index()->nullable();
            $table->integer('purchase_id')->index()->nullable();
            $table->integer('purchase_return_id')->index()->nullable();
            $table->integer('payment_id')->index()->nullable();
            $table->date('invoice_date')->nullable();
            // $table->string('total_payable_amount');
            // $table->string('total_amount_paid');
            // $table->string('payment_method');
            // $table->integer('customer_id');
            // $table->integer('supplier_id');
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
        Schema::dropIfExists('invoices');
    }
}
