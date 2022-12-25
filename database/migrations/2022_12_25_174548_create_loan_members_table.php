<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLoanMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loan_members', function (Blueprint $table) {
            $table->uuid('loan_id')->nullable();
            $table->foreign('loan_id')->references('id')->on('loans');
            $table->uuid('member_id')->nullable();
            $table->foreign('member_id')->references('id')->on('members');
            $table->string('remarks')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('loan_members');
    }
}
