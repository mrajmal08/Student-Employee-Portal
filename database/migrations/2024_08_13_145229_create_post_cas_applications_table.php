<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostCasApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_cas_applications', function (Blueprint $table) {
            $table->id();
            $table->string('cas_no')->nullable();
            $table->date('cas_date')->unique();
            $table->text('vignette_doc')->nullable();
			$table->text('vignette_stamp_doc')->nullable();
            $table->date('date_of_entry')->nullable();
            $table->string('after_vignette')->nullable();
			$table->string('before_vignette')->nullable();
			$table->string('student_notified')->nullable();
			$table->string('is_egates')->nullable();
			$table->string('e_ticket')->nullable();
			$table->string('brp_received')->nullable();
			$table->string('correct_identified')->nullable();
			$table->string('brp_error')->nullable();
			$table->date('reporting_date')->nullable();
			$table->date('brp_start_date')->nullable();
			$table->date('brp_end_date')->nullable();
			$table->date('sms_reporting_date')->nullable();
			$table->string('sms_screen_shot')->nullable();
			$table->text('brp_doc')->nullable();
			$table->text('brp_correction_note')->nullable();
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
        Schema::dropIfExists('post_cas_applications');
    }
}
