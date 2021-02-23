<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('account_payments', function (Blueprint $table) {
            $table->bigIncrements('account_payments_id');
            $table->integer('account_id')->unsigned()->index();
            // $table->foreign('account_id')->references('account_id')->on('accounts')->onDelete('cascade');
            $table->integer('payment_id')->unsigned()->index();
            // $table->foreign('payment_id')->references('payment_id')->on('payments')->onDelete('cascade');
            // $table->integer('invoice_id')->unsigned()->index();
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
        Schema::dropIfExists('account_payments');
    }
}
