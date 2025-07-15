<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateViewGeneralComment extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("
        CREATE OR REPLACE VIEW view_general_comment AS
        SELECT
        comments.id AS id,
        comments.message AS message,
        comments.case_id AS case_id,
        comments.comment_category_id AS comment_category_id,
        comments.created_by AS created_by,
        comments.updated_by AS updated_by,
        comments.created_at AS created_at,
        student_cases.id AS case_no,
        comment_categories.name AS category_name,
        created_by_user.id AS created_by_user_id,
        created_by_user.name AS created_by_user_name,
        roles.name AS role_name
        FROM comments
        INNER JOIN student_cases ON student_cases.id = comments.case_id
        INNER JOIN comment_categories ON comment_categories.id = comments.comment_category_id
        INNER JOIN users AS created_by_user ON created_by_user.id = comments.created_by
        INNER JOIN roles ON roles.id = created_by_user.role_id
        WHERE
        comments.deleted_at IS NULL
        AND student_cases.deleted_at IS NULL
        AND comment_categories.deleted_at IS NULL
        AND created_by_user.deleted_at IS NULL
        AND roles.deleted_at IS NULL;
    ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('view_general_comment');
    }
}
