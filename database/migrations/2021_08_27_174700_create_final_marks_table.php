<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFinalMarksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('final_marks', function (Blueprint $table) {
            $table->id();
            $table->string('file');
            $table->integer('marks')->nullable();
            $table->bigInteger('student_id')->unsigned();
            $table->bigInteger('instructor_id')->unsigned();
            $table->bigInteger('exam_id')->unsigned();
            $table->enum('status', [0,1])->default('0');
            $table->foreign('instructor_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('student_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('exam_id')->references('id')->on('final_exams')->onDelete('cascade');
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
        Schema::dropIfExists('final_marks');
    }
}
