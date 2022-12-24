<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLoanGuarantorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loan_guarantor', function (Blueprint $table) {
            $table->uuid('loan_id')->nullable();
            $table->foreign('loan_id')->references('id')->on('loans');
            $table->uuid('guarantor_id')->nullable();
            $table->foreign('guarantor_id')->references('id')->on('guarantor');
            $table->string('remark')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('loan_guarantor');
    }
}
