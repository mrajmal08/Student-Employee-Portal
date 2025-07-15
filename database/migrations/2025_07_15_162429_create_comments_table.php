<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
			$table->text('message')->nullable();

			//Foreign Key Columns
			$table->bigInteger('case_id')->unsigned()->nullable();
			$table->bigInteger('comment_category_id')->unsigned()->nullable();

			//Always Required Columns
			$table->bigInteger('created_by')->unsigned()->nullable();
			$table->bigInteger('updated_by')->unsigned()->nullable();
            $table->softDeletes();
            $table->timestamps();
		});

		Schema::table('comments', function(Blueprint $table)
		{
			$table->foreign('case_id')->references('id')->on('student_cases')->onUpdate('RESTRICT')->onDelete('CASCADE');
			$table->foreign('comment_category_id')->references('id')->on('comment_categories')->onUpdate('RESTRICT')->onDelete('CASCADE');
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
        Schema::dropIfExists('comments');
    }
}
