<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->bigIncrements('company_id');
            $table->string('company_ref_no')->index();
            $table->string('company_parent')->index()->nullable();
            // $table->string('company_type')->nullable();
            $table->string('company_name')->unique();
            // $table->string('company_image')->nullable();
            $table->text('company_description')->nullable();
            // $table->string('company_slug')->nullable();
            $table->integer('status_id')->index();
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
        Schema::dropIfExists('companies');
    }
}
