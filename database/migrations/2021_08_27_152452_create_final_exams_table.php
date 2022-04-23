<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFinalExamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('final_exams', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('file');
            $table->integer('marks');
            $table->string('time');
            $table->bigInteger('instructor_id')->unsigned();
            $table->bigInteger('course_id')->unsigned();
            $table->enum('status', [0,1]);
            $table->foreign('instructor_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('course_id')->references('id')->on('courses')->onDelete('cascade');
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
        Schema::dropIfExists('final_exams');
    }
}
