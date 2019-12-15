<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Post;

class AddAcademicGroupIdToPostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('posts', function (Blueprint $table) {
            Post::truncate();
            $table->bigInteger('academic_group_id')->unsigned()->nullable();
            $table->foreign('academic_group_id')->references('id')->on('academic_groups');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->dropForeign('academic_group_id');
            $table->dropColumn('academic_group_id');
        });
    }
}
