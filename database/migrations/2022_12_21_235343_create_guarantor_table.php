<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGuarantorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('guarantor', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('full_name')->nullable();
            $table->string('sex')->nullable();
            $table->foreign('sex')->references('id')->on('sexes');
            $table->date('date_of_birth')->nullable();
            $table->string('document_type')->nullable();
            $table->foreign('document_type')->references('id')->on('document_type');
            $table->string('document_number')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('province_id')->nullable();
            $table->foreign('province_id')->references('id')->on('provinces');
            $table->string('district_id')->nullable();
            $table->foreign('district_id')->references('id')->on('districts');
            $table->string('commune_id')->nullable();
            $table->foreign('commune_id')->references('id')->on('communes');
            $table->string('village_id')->nullable();
            $table->foreign('village_id')->references('id')->on('villages');
            $table->string('full_address_input')->nullable();
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
        Schema::dropIfExists('guarantor');
    }
}
