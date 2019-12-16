<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveUnnecessaryTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('role_group');
        Schema::dropIfExists('user_delegate');
        Schema::dropIfExists('user_student');
        Schema::dropIfExists('user_professor');
        Schema::dropIfExists('students');
        Schema::dropIfExists('company_delegates');
        Schema::dropIfExists('professors');
        Schema::dropIfExists('academic_group_post');
        Schema::dropIfExists('groups');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::create('role_group', function (Blueprint $table) {
            $table->unsignedBigInteger('role_id');
            $table->unsignedBigInteger('group_id');

            $table->foreign('role_id')->references('id')->on('roles');
            $table->foreign('group_id')->references('id')->on('groups');
        });

        Schema::create('students', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('faculty');
            $table->string('course');
            $table->unsignedBigInteger('academic_group_id');
            $table->timestamps();

            $table->foreign('academic_group_id')->references('id')->on('academic_groups');
        });

        Schema::create('company_delegates', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('company');
            $table->string('duties');
            $table->unsignedBigInteger('job_form_id');
            $table->timestamps();

            $table->foreign('job_form_id')->references('id')->on('job_forms');
        });

        Schema::create('professors', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('faculty');
            $table->string('duties');
            $table->timestamps();
        });

        Schema::create('user_delegate', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('delegate_id');

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('delegate_id')->references('id')->on('company_delegates');
        });

        Schema::create('user_student', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('student_id');

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('student_id')->references('id')->on('students');
        });

        Schema::create('user_professor', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('professor_id');

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('professor_id')->references('id')->on('professors');
        });

        Schema::create('academic_group_post', function (Blueprint $table) {
            $table->unsignedBigInteger('academic_group_id');
            $table->unsignedBigInteger('group_id');

            $table->foreign('academic_group_id')->references('id')->on('academic_groups');
            $table->foreign('group_id')->references('id')->on('groups');
        });

        Schema::create('groups', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
        });
    }
}
