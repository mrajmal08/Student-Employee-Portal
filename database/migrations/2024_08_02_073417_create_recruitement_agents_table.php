<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecruitementAgentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recruitement_agents', function (Blueprint $table) {
            $table->id();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('email')->unique();
            $table->string('nationality')->unique();
			$table->string('phone_no')->nullable();
            $table->date('date_of_birth')->nullable();
			$table->tinyInteger('gender')->comment('1=male,2=female');
            $table->string('address')->nullable();
			$table->string('passport')->nullable();
			$table->text('work_experience')->nullable();
			$table->text('notes')->nullable();
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
        Schema::dropIfExists('recruitement_agents');
    }
}
