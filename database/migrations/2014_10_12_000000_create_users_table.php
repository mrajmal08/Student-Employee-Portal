<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone_no')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->bigInteger('role_id')->unsigned()->nullable();
            $table->bigInteger('department_id')->unsigned()->nullable();
            $table->bigInteger('designation_id')->unsigned()->nullable();
            $table->bigInteger('session_id')->unsigned()->nullable();
            $table->bigInteger('status')->nullable();
            $table->string('agency_name')->nullable();
            $table->timestamp('institute_time')->nullable();
            $table->string('agent_market_value')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->string('nationality')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->date('deleted_at')->nullable();

            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();

            $table->foreign('role_id')->references('id')->on('roles')->onUpdate('RESTRICT')->onDelete('CASCADE');
            $table->foreign('department_id')->references('id')->on('departments')->onUpdate('RESTRICT')->onDelete('CASCADE');
            $table->foreign('designation_id')->references('id')->on('designations')->onUpdate('RESTRICT')->onDelete('CASCADE');
            $table->foreign('session_id')->references('id')->on('sessions')->onUpdate('RESTRICT')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
