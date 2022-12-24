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
            $table->uuid('id')->primary();
            $table->date('start_payment_date');
            $table->date('payment_date');
            $table->date('last_payment_paid_date')->nullable();
            $table->integer('sort');
            $table->double('deduct_amount');
            $table->double('deduct_paid_amount')->default(0);
            $table->integer('interval');
            $table->double('interest_amount');
            $table->double('commission_amount');
            $table->double('total_amount');
            $table->double('total_paid_amount')->default(0);
            $table->double('penalty_amount')->default(0);
            $table->double('pending_amount');
            $table->double('cross_amount');
            $table->string('remark')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->uuid('loan_id')->nullable();
            $table->foreign('loan_id')->references('id')->on('loans');

            $table->string('status',10)->nullable();
            $table->foreign('status')->references('id')->on('payment_status');
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
