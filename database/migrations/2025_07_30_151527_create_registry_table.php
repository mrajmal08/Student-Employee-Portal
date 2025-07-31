<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegistryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registry', function (Blueprint $table) {
            $table->id();

            // Foreign key to student case
            $table->unsignedBigInteger('student_id')->nullable();
            $table->unsignedBigInteger('case_id')->nullable();

            // Dropdown: Student current status
            $table->string('student_status')->nullable();
            // If "Break in study" is selected
            $table->string('break_in_study')->nullable();
            $table->date('break_return_date')->nullable();
            $table->string('break_sms_reporting')->nullable();
            $table->date('break_sms_date')->nullable();

            // If "Student withdrawn" is selected
            $table->string('student_withdrawn')->nullable();
            $table->string('withdraw_sms_reporting')->nullable();
            $table->date('withdraw_date')->nullable();
            $table->string('withdraw_screenshot')->nullable();

            // Attachments (nullable strings to hold file paths)
            $table->string('attendance_monitoring_plan')->nullable();
            $table->string('fitness_to_study_plan')->nullable();
            $table->string('pregnancy_evidence')->nullable();
            $table->string('disability')->nullable();
            $table->string('risk_assessment')->nullable();

            $table->string('transfer_of_course')->nullable();

            $table->json('sms_reporting_reasons')->nullable();
            $table->json('sms_reporting_attachments')->nullable();

            $table->string('personal_tutor')->nullable();
            $table->text('notes')->nullable();

            $table->date('course_submission_date')->nullable();
            $table->date('resubmission_date')->nullable();
            $table->date('chaser_date')->nullable();
            $table->string('new_visa_required')->nullable();

            $table->string('eligible_for')->nullable();
            $table->date('date_of_award')->nullable();
            $table->string('sms_intake')->nullable();
            $table->string('sms_reporting')->nullable();
            $table->string('student_notified')->nullable();

            // Tracking
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();

            $table->softDeletes();
            $table->timestamps();
        });

        // Add foreign keys
        Schema::table('registry', function (Blueprint $table) {
            $table->foreign('student_id')->references('id')->on('students')->onUpdate('RESTRICT')->onDelete('CASCADE');
            $table->foreign('case_id')->references('id')->on('student_cases')->onUpdate('RESTRICT')->onDelete('CASCADE');
            $table->foreign('created_by')->references('id')->on('users')->onUpdate('RESTRICT')->onDelete('SET NULL');
            $table->foreign('updated_by')->references('id')->on('users')->onUpdate('RESTRICT')->onDelete('SET NULL');
        });
    }



    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('registry');
    }
}
