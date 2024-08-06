<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_courses', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('student_id')->unsigned()->nullable();
			$table->bigInteger('course_id')->unsigned()->nullable();
            $table->timestamps();
            $table->date('deleted_at')->nullable();

            $table->foreign('student_id')->references('id')->on('students')->onUpdate('RESTRICT')->onDelete('CASCADE');
            $table->foreign('course_id')->references('id')->on('courses')->onUpdate('RESTRICT')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('student_courses');
    }
}
