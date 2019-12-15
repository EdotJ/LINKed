<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Migrations\Migration;

class AddStatusesForFormFieldStatusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('forms_field_status')->insert([
            ['status' => 'unused'],
            ['status' => 'optional'],
            ['status' => 'required'],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('forms_field_status')->truncate();
    }
}
