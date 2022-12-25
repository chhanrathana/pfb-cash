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
            $table->uuid('id')->primary();      
            $table->string('member_01_kh', 255);      
            $table->string('member_01_en', 255);
            $table->string('member_02_kh', 255);      
            $table->string('member_02_en', 255);
            $table->string('member_03_kh', 255);      
            $table->string('member_03_en', 255);
            $table->string('member_04_kh', 255);      
            $table->string('member_04_en', 255);            
            $table->timestamps();
            $table->softDeletes();

            $table->uuid('loan_id')->nullable();
            $table->foreign('loan_id')->references('id')->on('loans');
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
