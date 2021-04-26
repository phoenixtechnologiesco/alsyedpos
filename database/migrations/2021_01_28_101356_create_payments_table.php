<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->bigIncrements('payment_id');
            $table->string('payment_ref_no')->index()->nullable();
            $table->string('payment_type')->nullable(); // 'initial/opening_balance', 'opening_stock', 'credit', 'debit', 'deposit', 'transfer', 'refund', 'sale_return', 'purchase_return'
            $table->integer('sale_id')->index()->nullable();
            $table->integer('purchase_id')->index()->nullable();
            $table->integer('payment_customer_id')->index()->nullable();
            $table->integer('payment_supplier_id')->index()->nullable();
            $table->string('payment_method')->nullable(); // 'cash', 'credit', 'deposit', 'card', 'cheque', 'other'
            // $table->decimal('payable_amount', 22, 4)->default(0);
            // $table->decimal('recieved_amount', 22, 4)->default(0);
            $table->decimal('payment_amount_paid', 22, 4)->default(0);
            $table->decimal('payment_amount_balance', 22, 4)->default(0);
            $table->decimal('customer_amount_paid', 22, 4)->default(0);
            $table->decimal('customer_amount_dues', 22, 4)->default(0);
            $table->decimal('supplier_amount_recieved', 22, 4)->default(0);
            $table->decimal('supplier_amount_dues', 22, 4)->default(0);
            $table->string('payment_cheque_no')->nullable();
            $table->date('payment_cheque_date')->nullable();
            $table->integer('account_id')->index()->nullable();
            $table->text('payment_note')->nullable()->nullable();
            $table->string('payment_status');// 'paid', 'due', 'partial', 'overdue'
            // $table->integer('parent_id');
            $table->string('sale_purch_invoice_id')->index()->nullable();
            $table->string('payment_invoice_id')->index()->nullable();
            $table->dateTime('payment_invoice_date')->nullable();
            // $table->dateTime('payment_date');
            $table->string('payment_document')->nullable();
            $table->integer('payment_created_by')->index()->unsigned();
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
        Schema::dropIfExists('payments');
    }
}
