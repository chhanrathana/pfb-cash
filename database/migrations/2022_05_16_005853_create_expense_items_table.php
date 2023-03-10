<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExpenseItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('expense_items', function (Blueprint $table) {
            $table->uuid('id')->primary();    
            $table->timestamp('expense_datetime');
            $table->string('description', 255);
            $table->double('expense_amount')->default(0);       
            $table->timestamps();
            $table->softDeletes();

            $table->uuid('expense_type_id')->nullable();
            $table->foreign('expense_type_id')->references('id')->on('expense_types');

            $table->uuid('branch_id')->nullable();
            $table->foreign('branch_id')->references('id')->on('branches');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('expense_items');
    }
}
