<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Interview extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = "interviews";
    protected $guarded = [];

    public function status()
    {
        return $this->belongsTo(InterviewStatus::class, 'status_id');
    }

    public static function add($interview)
    {
        $new_interview = new Interview();
        $new_interview->referral_date = $interview['referral_date'];
        $new_interview->student_notified = $interview['student_notified'];
        $new_interview->status_id = 1;
        $new_interview->created_by = Auth::user()->id;
        $new_interview->updated_by = Auth::user()->id;
        $new_interview->save();
        return $new_interview;
    }

}
