<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemoveFkFromCompanyDelegatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('company_delegates', function (Blueprint $table) {
            $table->dropForeign(['job_form_id']);
            $table->dropColumn('job_form_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('company_delegates', function (Blueprint $table) {
            $table->unsignedBigInteger('job_form_id');
            $table->foreign('job_form_id')->references('id')->on('job_forms');
        });
    }
}
