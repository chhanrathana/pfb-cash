<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShareholdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shareholders', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name_en', 255)->nullable();
            $table->string('name_kh', 255);
            $table->double('earn_rate')->nullable();

            $table->date('date_of_birth');
            $table->string('phone_number',50)->nullable();
            $table->date('start_work_date')->nullable();
            $table->string('born_place')->nullable();
            $table->string('document_type')->nullable();
            $table->foreign('document_type')->references('id')->on('document_type');
            $table->string('document_number',50)->nullable();
            $table->string('emergency_number',50)->nullable();
            $table->string('current_place')->nullable();
            
            $table->timestamps();
            $table->softDeletes();

            $table->char('sex',1)->nullable();
            $table->foreign('sex')->references('id')->on('sexes');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shareholders');
    }
}
