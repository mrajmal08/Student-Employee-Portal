<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInterviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('interviews', function (Blueprint $table) {
            $table->id();
			$table->bigInteger('case_id')->unsigned()->nullable();
            $table->bigInteger('status_id')->unsigned()->nullable();

            $table->string('interviewer_name')->nullable();
            $table->date('interview_date')->nullable();
            $table->time('start_time')->nullable();
            $table->time('end_time')->nullable();
            $table->date('referral_date')->nullable();
            $table->string('student_notified')->nullable();
            $table->text('sample_questions')->nullable();
            $table->text('recording1')->nullable();
            $table->text('recording2')->nullable();
            $table->string('compliance_interviewer_name')->nullable();
            $table->date('compliance_interview_date')->nullable();
            $table->time('compliance_start_time')->nullable();
            $table->time('compliance_end_time')->nullable();
            $table->date('compliance_referral_date')->nullable();
            $table->string('compliance_student_notified')->nullable();
            $table->text('compliance_sample_questions')->nullable();
            $table->integer('is_scheduled')->nullable();
            $table->text('recording3')->nullable();
            $table->text('recording4')->nullable();

            $table->timestamps();
            $table->softDeletes();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
        });

        Schema::create('interviews', function (Blueprint $table) {

			$table->foreign('case_id')->references('id')->on('student_cases')->onUpdate('RESTRICT')->onDelete('CASCADE');
			$table->foreign('status_id')->references('id')->on('interview_statuses')->onUpdate('RESTRICT')->onDelete('CASCADE');
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
        Schema::dropIfExists('interviews');
    }
}
