<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePreCasApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pre_cas_applications', function (Blueprint $table) {
            $table->id();
            $table->string('interview_questions')->nullable();
            $table->date('date_of_interview')->nullable();
            $table->string('name_of_interviewer')->nullable();
			$table->text('note')->nullable();
            $table->date('date_of_referral')->nullable();
            $table->string('student_notified')->nullable();
			$table->date('date_of_interview2')->nullable();
			$table->string('name_of_interviewer2')->nullable();
			$table->text('note2')->nullable();
			$table->text('outcome')->nullable();
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
        Schema::dropIfExists('pre_cas_applications');
    }
}
