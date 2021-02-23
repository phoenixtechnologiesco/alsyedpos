<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accounts', function (Blueprint $table) {
            $table->bigIncrements('account_id');
            $table->integer('account_ref_no')->index();
            $table->integer('account_customer_id')->index();
            $table->integer('account_supplier_id')->index();
            $table->string('account_name')->index();
            $table->string('account_status');//active,inactive, default,
            $table->text('account_note')->nullable();
            $table->string('account_type');//debit,credit //capital,saving current
            // $table->string('account_payment_type');//sale,purchase
            // $table->string('account_payment_method');//cash,credit,deposit
            // $table->string('account_payment_status');//paid,due,partial,overdue
            $table->decimal('account_initial_balance', 10, 2);
            $table->decimal('account_total_amount', 10, 2);
            $table->decimal('account_amount_paid', 10, 2);
            $table->decimal('account_amount_dues', 10, 2);
            $table->string('account_document');
            $table->integer('account_created_by')->index();
            // $table->date('account_date')->nullable();
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
        Schema::dropIfExists('accounts');
    }
}
