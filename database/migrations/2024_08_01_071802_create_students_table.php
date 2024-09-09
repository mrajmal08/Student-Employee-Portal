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
            $table->string('name')->nullable();
            $table->string('email')->unique();
            $table->string('nationality')->nullable();
			$table->string('phone_no')->nullable();
            $table->date('date_of_birth')->nullable();
			$table->tinyInteger('gender')->comment('1=male,2=female');
            $table->string('address')->nullable();
            $table->string('address2')->nullable();
            $table->string('city')->nullable();
            $table->string('county')->nullable();
            $table->string('post_code')->nullable();
			$table->string('passport')->nullable();
			$table->text('academic_history')->nullable();
			$table->text('travel_history')->nullable();
			$table->text('work_experience')->nullable();
			$table->string('intake')->nullable();
			$table->text('notes')->nullable();
            $table->bigInteger('dependant_no')->nullable();
            $table->bigInteger('agent_id')->nullable();
            $table->bigInteger('course_id')->nullable();
            $table->string('preferred_method')->nullable();
            $table->string('traveling_alone')->nullable();
            $table->bigInteger('status_id')->nullable();
            $table->string('stakeholder')->nullable();
			$table->string('previous_cas')->nullable();
			$table->string('academic_document')->nullable();
			$table->string('passport_doc')->nullable();
			$table->string('brp_doc')->nullable();
			$table->string('financial_statement_doc')->nullable();
			$table->string('qualification_doc')->nullable();
			$table->string('lang_doc')->nullable();
			$table->string('miscellaneous_doc')->nullable();
			$table->string('tb_certificate_doc')->nullable();
			$table->string('previous_cas_doc')->nullable();
			$table->string('referral')->nullable();
			$table->string('screened_by')->nullable();
            $table->timestamps();
            $table->date('deleted_at')->nullable();
            $table->bigInteger('created_by')->nullable();
            $table->bigInteger('updated_by')->nullable();
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
