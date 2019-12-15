<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAcademicGroupPostTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('academic_group_post', function (Blueprint $table) {
            $table->unsignedBigInteger('academic_group_id');
            $table->unsignedBigInteger('group_id');

            $table->foreign('academic_group_id')->references('id')->on('academic_groups');
            $table->foreign('group_id')->references('id')->on('groups');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('academic_group_post');
    }
}
