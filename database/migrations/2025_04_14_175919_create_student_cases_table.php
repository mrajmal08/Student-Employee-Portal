<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentCasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_cases', function (Blueprint $table) {
            $table->id();
            //Foreign Key Columns
			$table->bigInteger('student_id')->unsigned()->nullable();
			$table->bigInteger('course_id')->unsigned()->nullable();
			$table->bigInteger('session_id')->unsigned()->nullable();
			$table->bigInteger('agent_id')->unsigned()->nullable();

			//Always Required Columns
			$table->timestamps();
            $table->date('deleted_at')->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
        });

        Schema::create('student_cases', function (Blueprint $table) {

			$table->foreign('student_id')->references('id')->on('students')->onUpdate('RESTRICT')->onDelete('CASCADE');
			$table->foreign('course_id')->references('id')->on('courses')->onUpdate('RESTRICT')->onDelete('CASCADE');
			$table->foreign('session_id')->references('id')->on('sessions')->onUpdate('RESTRICT')->onDelete('CASCADE');
			$table->foreign('agent_id')->references('id')->on('users')->onUpdate('RESTRICT')->onDelete('CASCADE');
			$table->foreign('created_by')->references('id')->on('users')->onUpdate('RESTRICT')->onDelete('CASCADE');
			$table->foreign('updated_by')->references('id')->on('users')->onUpdate('RESTRICT')->onDelete('CASCADE');
		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('student_cases');
    }
}
