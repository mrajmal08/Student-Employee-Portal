<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsMediaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students_media', function (Blueprint $table) {
            $table->id();
            $table->bigIncrements('student_id')->nullable();
            $table->string('document_name')->nullable();
            $table->string('academic_document')->nullable();
			$table->string('passport_doc')->nullable();
			$table->string('brp_doc')->nullable();
			$table->string('financial_statement_doc')->nullable();
			$table->string('qualification_doc')->nullable();
			$table->string('lang_doc')->nullable();
			$table->string('miscellaneous_doc')->nullable();
			$table->string('tb_certificate_doc')->nullable();
			$table->string('previous_cas_doc')->nullable();
            $table->timestamps();
            $table->date('deleted_at')->nullable();
            $table->bigIncrements('created_by')->nullable();
            $table->bigIncrements('updated_by')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('students_media');
    }
}
