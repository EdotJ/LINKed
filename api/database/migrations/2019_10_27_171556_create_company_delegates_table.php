<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompanyDelegatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_delegates', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('company');
            $table->string('duties');
            $table->unsignedBigInteger('job_form_id');
            $table->timestamps();

            $table->foreign('job_form_id')->references('id')->on('job_forms');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('company_delegates');
    }
}
