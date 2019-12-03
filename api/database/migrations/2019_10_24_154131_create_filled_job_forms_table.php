<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFilledJobFormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('filled_job_forms', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('study_year');
            $table->string('motivational');
            $table->string('hobbies');
            $table->string('skills');
            $table->string('experience');
            $table->string('phone_number');
            $table->string('strengths');
            $table->string('weaknesses');
            $table->unsignedBigInteger('form_id');
            $table->timestamps();

            $table->foreign('form_id')->references('id')->on('job_forms');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('filled_job_forms');
    }
}
