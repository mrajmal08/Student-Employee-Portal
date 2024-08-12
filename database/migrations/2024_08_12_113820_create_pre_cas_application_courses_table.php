<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePreCasApplicationCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pre_cas_application_courses', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('pre_cas_application_id')->unsigned()->nullable();
			$table->bigInteger('course_id')->unsigned()->nullable();
            $table->timestamps();
            $table->date('deleted_at')->nullable();
            $table->foreign('pre_cas_application_id')->references('id')->on('pre_cas_applications')->onUpdate('RESTRICT')->onDelete('CASCADE');
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
        Schema::dropIfExists('pre_cas_application_courses');
    }
}
