<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug');
            $table->string('short_desc');
            $table->text('course_details');
            $table->integer('course_fee');
            $table->integer('total_student')->default(0);
            $table->integer('chapter')->default(0);
            $table->integer('lecture')->default(0);
            $table->string('image');
            $table->enum('status', [0,1])->default(0);
            $table->enum('is_approve', [0,1])->default(0);
            $table->bigInteger('category_id')->unsigned();
            $table->bigInteger('instructor_id')->unsigned();
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->foreign('instructor_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('courses');
    }
}
