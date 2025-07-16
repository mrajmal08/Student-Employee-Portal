<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Comment extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = "comments";
    protected $guarded = [];

    public static function add($comment)
    {
        $new_comment = new Comment();
        $new_comment->case_id = $comment['case_id'];
        $new_comment->comment_category_id = $comment['comment_category_id'];
        $new_comment->message = $comment['message'] ?? null;
        $new_comment->created_by = Auth::user()->id;
        $new_comment->updated_by = Auth::user()->id;
        $new_comment->save();
        return $new_comment;
    }
}
