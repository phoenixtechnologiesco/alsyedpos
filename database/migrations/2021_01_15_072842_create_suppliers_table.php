<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuppliersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('suppliers', function (Blueprint $table) {
            $table->bigIncrements('supplier_id');
            $table->string('supplier_ref_no')->index();
            $table->string('supplier_type')->nullable();//General,Booker
            $table->string('supplier_name')->unique();
            $table->string('supplier_shop_name')->nullable();
            $table->text('supplier_shop_info')->nullable();
            $table->string('supplier_email')->unique()->nullable();
            $table->string('supplier_alternate_email')->unique()->nullable();
            $table->string('supplier_cnic_number')->nullable();
            $table->string('supplier_town')->nullable();
            $table->string('supplier_area')->nullable();
            $table->text('supplier_shop_address')->nullable();
            $table->text('supplier_resident_address')->nullable();
            $table->string('supplier_zipcode')->nullable();
            $table->string('supplier_phone_number')->unique()->nullable();
            $table->string('supplier_office_number')->unique()->nullable();
            $table->string('supplier_alternate_number')->nullable();
            $table->decimal('supplier_total_balance', 10, 2)->nullable();
            $table->decimal('supplier_balance_paid', 10, 2)->nullable();
            $table->decimal('supplier_balance_dues', 10, 2)->nullable();
            $table->integer('status_id')->index();
            $table->integer('supplier_created_by')->index();
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
        Schema::dropIfExists('suppliers');
    }
}
