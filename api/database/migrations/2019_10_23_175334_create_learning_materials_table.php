<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLearningMaterialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('learning_materials', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->string('path');
            $table->unsignedBigInteger('user_id');
            $table->double('size', 12, 2)->default(0);
            $table->timestamps();
            $table->boolean('private')->default((0));
        
            $table->foreign('user_id')->references('id')->on('users');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('learning_materials');
    }
}
