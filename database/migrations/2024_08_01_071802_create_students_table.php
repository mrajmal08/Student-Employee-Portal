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
            $table->string('surname')->nullable();
            $table->string('email')->unique();
            $table->string('nationality')->nullable();
            $table->string('place_of_birth')->nullable();
			$table->string('phone_no')->nullable();
            $table->date('date_of_birth')->nullable();
			$table->string('gender')->nullable();
            $table->string('address')->nullable();
            $table->string('address2')->nullable();
            $table->string('city')->nullable();
            $table->string('county')->nullable();
            $table->string('post_code')->nullable();
			$table->string('passport')->nullable();
			$table->date('passport_start_date')->nullable();
			$table->date('passport_expiry_date')->nullable();
			$table->string('passport_status')->nullable();
			$table->bigInteger('english_test')->nullable();
			$table->string('english_test_reason')->nullable();
			$table->string('last_course')->nullable();
			$table->date('last_course_completion_year')->nullable();
			$table->bigInteger('dependant')->nullable();
            $table->bigInteger('dependant_no')->nullable();
            $table->bigInteger('dependant_financial_info')->nullable();
            $table->bigInteger('flag_for_compliance')->nullable();
            $table->bigInteger('travel_outside')->nullable();
            $table->string('travel_outside_no')->nullable();
            $table->bigInteger('travel_uk')->nullable();
            $table->string('travel_uk_no')->nullable();
            $table->bigInteger('previous_study_uk')->nullable();
            $table->bigInteger('receive_student_visa')->nullable();
            $table->bigInteger('refusal_from_uk')->nullable();
            $table->json('course_level_in_uk')->nullable();
			$table->text('academic_history')->nullable();
			$table->text('travel_history')->nullable();
			$table->text('work_experience')->nullable();
			$table->string('intake')->nullable();
			$table->text('notes')->nullable();
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
