<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDependantTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dependants', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('nationality')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('travel_outside')->nullable();
            $table->text('travel_history')->nullable();
            $table->text('financial_doc')->nullable();
            $table->text('qualification_doc')->nullable();
            $table->text('pay_slip')->nullable();
            $table->text('employer_letter')->nullable();
            $table->text('marriage_certificate')->nullable();
            $table->text('birth_certificate')->nullable();
            $table->text('officer_note')->nullable();
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
        Schema::dropIfExists('dependant');
    }
}
