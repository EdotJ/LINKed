<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFilledJobFormUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('filled_job_form_user', function (Blueprint $table) {
            $table->unsignedBigInteger('filled_job_form_id');
            $table->unsignedBigInteger('user_id');

            $table->foreign('filled_job_form_id')->references('id')->on('filled_job_forms');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('filled_job_form_user');
    }
}
