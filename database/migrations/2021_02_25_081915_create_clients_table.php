<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('code',50);
            $table->string('name_en', 255);
            $table->string('name_kh', 255);
            $table->date('date_of_birth');
            $table->string('phone_number');
            $table->boolean('is_new')->default(1);
            $table->string('document_type_id')->nullable();
            $table->foreign('document_type_id')->references('id')->on('document_type');
            $table->string('document_number')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->char('sex',1)->nullable();
            $table->foreign('sex')->references('id')->on('sexes');

            $table->string('status',10)->nullable();
            $table->foreign('status')->references('id')->on('client_status');

            $table->uuid('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users');

            $table->string('province_id', 10)->nullable();
            $table->foreign('province_id')->references('id')->on('provinces');

            $table->string('district_id', 10)->nullable();
            $table->foreign('district_id')->references('id')->on('districts');

            $table->string('commune_id', 10)->nullable();
            $table->foreign('commune_id')->references('id')->on('communes');

            $table->string('village_id', 10)->nullable();
            $table->foreign('village_id')->references('id')->on('villages');

            $table->uuid('branch_id')->nullable();
            $table->foreign('branch_id')->references('id')->on('branches');

            $table->unique(['code','branch_id'],'clients_code_unique');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clients');
    }
}
