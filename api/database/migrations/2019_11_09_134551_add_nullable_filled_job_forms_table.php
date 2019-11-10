<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNullableFilledJobFormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('filled_job_forms', function(Blueprint $table) {
            $table->string('first_name')->nullable()->change();
            $table->string('last_name')->nullable()->change();
            $table->string('study_year')->nullable()->change();
            $table->string('motivational')->nullable()->change();
            $table->string('hobbies')->nullable()->change();
            $table->string('skills')->nullable()->change();
            $table->string('experience')->nullable()->change();
            $table->string('phone_number')->nullable()->change();
            $table->string('strengths')->nullable()->change();
            $table->string('weaknesses')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('filled_job_forms', function(Blueprint $table) {
            $table->string('first_name')->nullable(false)->change();
            $table->string('last_name')->nullable(false)->change();
            $table->string('study_year')->nullable(false)->change();
            $table->string('motivational')->nullable(false)->change();
            $table->string('hobbies')->nullable(false)->change();
            $table->string('skills')->nullable(false)->change();
            $table->string('experience')->nullable(false)->change();
            $table->string('phone_number')->nullable(false)->change();
            $table->string('strengths')->nullable(false)->change();
            $table->string('weaknesses')->nullable(false)->change();
        });
    }
}
