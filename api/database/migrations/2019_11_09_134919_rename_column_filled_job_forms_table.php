<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RenameColumnFilledJobFormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('filled_job_forms', function(Blueprint $table) {
            $table->renameColumn('motivational', 'motivation');
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
            $table->renameColumn('motivation', 'motivational');
        });
    }
}
