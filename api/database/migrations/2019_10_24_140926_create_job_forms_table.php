<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJobFormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_forms', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->tinyInteger('first_name');
            $table->tinyInteger('last_name');
            $table->tinyInteger('study_year');
            $table->tinyInteger('motivational');
            $table->tinyInteger('hobbies');
            $table->tinyInteger('skills');
            $table->tinyInteger('experience');
            $table->tinyInteger('phone_number');
            $table->tinyInteger('strengths');
            $table->tinyInteger('weaknesses');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('job_forms');
    }
}
