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
            $table->string('name')->nullable();
            $table->string('directors')->nullable();
            $table->string('company_register_number')->nullable();
            $table->string('date_of_registration')->nullable();
            $table->string('payment_method')->nullable();
            $table->string('account_name')->nullable();
            $table->string('account_number')->nullable();
            $table->string('institutions')->nullable();
            $table->text('career_history')->nullable();
            $table->string('address_uk')->nullable();
            $table->text('address')->nullable();
            $table->string('compliance_check')->nullable();
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
