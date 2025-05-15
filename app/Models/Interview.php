<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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

    public static function edit($interview, $requestData)
    {
        $updatedData = [];

        if (isset($requestData['interviewer_name']) && $requestData['interviewer_name'] !== $interview->interviewer_name) {
            $updatedData['interviewer_name'] = $requestData['interviewer_name'];
        }

        if (isset($requestData['interview_date']) && $requestData['interview_date'] !== $interview->interview_date) {
            $updatedData['interview_date'] = $requestData['interview_date'];
        }

        if (isset($requestData['case_id']) && $requestData['case_id'] !== $interview->case_id) {
            $updatedData['case_id'] = $requestData['case_id'];
        }

        $updatedData['status_id'] = 2;
        $updatedData['updated_by'] = Auth::user()->id;

        if (!empty($updatedData)) {
            $interviewId = $interview->id;
            DB::table('interviews')->where('id', $interviewId)->update($updatedData);
        }

        return Interview::find($interviewId);
    }

}
