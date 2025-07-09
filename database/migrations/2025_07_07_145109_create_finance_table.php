<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFinanceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('finance', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('case_id')->unsigned()->nullable();
            $table->bigInteger('course_id')->unsigned()->nullable();
            $table->string('course_fees')->nullable();
            $table->string('first_year_fees')->nullable();
            $table->string('living_cost_inside_london')->nullable();
            $table->string('living_cost_outside_london')->nullable();
            $table->string('total_fund')->nullable();
            $table->json('living_cost_plan')->nullable();
            $table->text('other')->nullable();
            $table->string('education_loan')->nullable();
            $table->string('loan_doc')->nullable();
            $table->string('another_education_loan')->nullable();
            $table->string('another_loan_doc')->nullable();
            $table->string('fees_deposit')->nullable();
            $table->string('deposit_doc')->nullable();
            $table->string('another_deposit')->nullable();
            $table->string('another_deposit_doc')->nullable();
            $table->string('funds_amount_paid')->nullable();
            $table->string('edu_loan_paid')->nullable();
            $table->string('fees_outstanding')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
        });

        Schema::create('finance', function (Blueprint $table) {

            $table->foreign('case_id')->references('id')->on('student_cases')->onUpdate('RESTRICT')->onDelete('CASCADE');
            $table->foreign('course_id')->references('id')->on('courses')->onUpdate('RESTRICT')->onDelete('CASCADE');
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
        Schema::dropIfExists('finance');
    }
}
