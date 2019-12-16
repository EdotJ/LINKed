<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLearningMaterialTagTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('learning_material_tag', function (Blueprint $table) {
            $table->unsignedBigInteger('learning_material_id');
            $table->unsignedBigInteger('tag_id');
            $table->bigIncrements('row_id')->unique();
            $table->foreign('learning_material_id')->references('id')->on('learning_materials');
            $table->foreign('tag_id')->references('id')->on('tags');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('learning_material_tag');
    }
}
