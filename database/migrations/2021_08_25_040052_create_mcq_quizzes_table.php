<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMcqQuizzesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mcq_quizzes', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('time');
            $table->bigInteger('chapter_id')->unsigned();
            $table->enum('status', [0,1]);
            $table->foreign('chapter_id')->references('id')->on('chapters')->onDelete('cascade');
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
        Schema::dropIfExists('mcq_quizzes');
    }
}
