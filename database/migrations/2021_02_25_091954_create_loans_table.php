<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLoansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loans', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('code', 50);
            $table->double('principal_amount')->nullable();
            $table->integer('term')->nullable();
            $table->double('pending_amount')->nullable();
            $table->double('last_pending_amount')->nullable();
            $table->double('rate')->nullable();
            $table->double('commission_rate')->nullable();
            $table->date('registration_date')->nullable();
            $table->date('started_payment_date')->nullable();
            $table->date('last_payment_date')->nullable();
            $table->date('finish_payment_date')->nullable();
            $table->double('finish_discount')->nullable();
            $table->double('finish_discount_amount')->nullable();
            $table->double('admin_rate')->nullable();
            $table->double('admin_amount')->nullable();
            $table->string('purpose')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->string('status',10)->nullable();
            $table->foreign('status')->references('id')->on('loan_status');

            $table->uuid('client_id')->nullable();
            $table->foreign('client_id')->references('id')->on('clients');

            $table->uuid('staff_id')->nullable();
            $table->foreign('staff_id')->references('id')->on('staffs');

            $table->uuid('interest_rate_id')->nullable();
            $table->foreign('interest_rate_id')->references('id')->on('interest_rates');

            $table->uuid('branch_id')->nullable();
            $table->foreign('branch_id')->references('id')->on('branches');

            $table->unique(['code','branch_id'],'loans_code_unique');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('loans');
    }
}
