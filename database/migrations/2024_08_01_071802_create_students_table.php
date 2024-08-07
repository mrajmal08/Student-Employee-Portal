<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('email')->unique();
            $table->string('nationality')->unique();
			$table->string('phone_no')->nullable();
            $table->date('date_of_birth')->nullable();
			$table->tinyInteger('gender')->comment('1=male,2=female');
            $table->string('address')->nullable();
			$table->string('passport')->nullable();
			$table->text('academic_history')->nullable();
			$table->text('travel_history')->nullable();
			$table->text('work_experience')->nullable();
			$table->string('academic_document')->nullable();
			$table->string('lang_document')->nullable();
			$table->string('ukvi_document')->nullable();
			$table->string('application_form')->nullable();
			$table->string('outstanding_document')->nullable();
			$table->string('previous_cas')->nullable();
			$table->bigInteger('dependant_id')->nullable();
			$table->string('intake')->nullable();
			$table->text('notes')->nullable();
            $table->timestamps();
            $table->date('deleted_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('students');
    }
}
