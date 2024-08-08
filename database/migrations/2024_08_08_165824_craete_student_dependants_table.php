<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CraeteStudentDependantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_dependants', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('student_id')->unsigned()->nullable();
			$table->bigInteger('dependant_id')->unsigned()->nullable();
            $table->timestamps();
            $table->date('deleted_at')->nullable();
            $table->foreign('student_id')->references('id')->on('students')->onUpdate('RESTRICT')->onDelete('CASCADE');
            $table->foreign('dependant_id')->references('id')->on('dependants')->onUpdate('RESTRICT')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('student_dependants');
    }

}
