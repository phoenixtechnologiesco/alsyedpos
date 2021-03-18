<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->bigIncrements('customer_id');
            $table->string('customer_ref_no')->index();
            $table->string('customer_type');//General, Distributer, Reseller
            $table->string('customer_name')->unique();
            $table->string('customer_shop_name')->nullable();
            $table->text('customer_shop_info')->nullable();
            $table->string('customer_email')->nullable();
            $table->string('customer_alternate_email')->nullable();
            $table->string('customer_cnic_number')->nullable();
            $table->string('customer_town')->nullable();
            $table->string('customer_area')->nullable();
            $table->text('customer_shop_address')->nullable();
            $table->text('customer_resident_address')->nullable();
            $table->string('customer_zipcode')->nullable();
            $table->string('customer_phone_number')->nullable();
            $table->string('customer_office_number')->nullable();
            $table->string('customer_alternate_number')->nullable();
            $table->decimal('customer_total_balance', 10, 2)->nullable();
            $table->decimal('customer_balance_paid', 10, 2)->nullable();
            $table->decimal('customer_balance_dues', 10, 2)->nullable();
            $table->string('customer_credit_duration')->nullable();
            $table->string('customer_credit_type')->nullable();
            $table->integer('customer_credit_limit')->nullable();
            $table->string('customer_sale_rate')->nullable();
            $table->integer('status_id')->index();
            $table->integer('customer_created_by')->index();
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
        Schema::dropIfExists('customers');
    }
}
