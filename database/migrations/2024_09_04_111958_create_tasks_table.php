<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->text('description')->nullable();
            $table->bigInteger('priority_id')->nullable();
            $table->bigInteger('type_id')->nullable();
            $table->bigInteger('status_id')->nullable();
            $table->date('due_date')->nullable();
            $table->date('remind_date')->nullable();
            $table->time('due_time')->nullable();
            $table->text('media')->nullable();
            $table->bigInteger('assing_to')->nullable();
            $table->timestamps();
            $table->date('deleted_at')->nullable();
            $table->bigInteger('created_by')->nullable();
            $table->bigInteger('updated_by')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tasks');
    }
}
