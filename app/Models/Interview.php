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
        $new_interview->case_id = $interview['case_id'];
        $new_interview->status_id = 1;
        $new_interview->created_by = Auth::user()->id;
        $new_interview->updated_by = Auth::user()->id;
        $new_interview->save();
        return $new_interview;
    }

    public static function edit($interview, $requestData)
    {
        $updatedData = [];
        $case_status_id = $interview->case_status_id ?? 1;
        $interviewId = $interview->id;


        $caseId = $requestData['case_id'] ?? $interview->case_id;

        if (isset($requestData['is_scheduled']) && $requestData['is_scheduled'] !== $interview->is_scheduled) {
            $updatedData['is_scheduled'] = $requestData['is_scheduled'];
            $updatedData['status_id'] = 2;
            $case_status_id = 2;
        }

        if (isset($requestData['interviewer_name']) && $requestData['interviewer_name'] !== $interview->interviewer_name) {
            $updatedData['interviewer_name'] = $requestData['interviewer_name'];
            $updatedData['status_id'] = 2;
            $case_status_id = 2;

        }

        if (isset($requestData['interview_date']) && $requestData['interview_date'] !== $interview->interview_date) {
            $updatedData['interview_date'] = $requestData['interview_date'];
            $updatedData['status_id'] = 2;
            $case_status_id = 2;
        }
        if (isset($requestData['start_time']) && $requestData['start_time'] !== $interview->start_time) {
            $updatedData['start_time'] = $requestData['start_time'];
            $updatedData['status_id'] = 2;
            $case_status_id = 2;
        }
        if (isset($requestData['end_time']) && $requestData['end_time'] !== $interview->end_time) {
            $updatedData['end_time'] = $requestData['end_time'];
            $updatedData['status_id'] = 2;
            $case_status_id = 2;
        }

        if (isset($requestData['sample_questions']) && $requestData['sample_questions'] !== $interview->sample_questions) {
            $updatedData['sample_questions'] = $requestData['sample_questions'];
            $updatedData['status_id'] = 3;
            $case_status_id = 3;
        }

        if (isset($requestData['compliance_referral_date']) && $requestData['compliance_referral_date'] !== $interview->compliance_referral_date) {
            $updatedData['compliance_referral_date'] = $requestData['compliance_referral_date'];
            $updatedData['status_id'] = 4;
            $case_status_id = 4;
        }

        if (isset($requestData['compliance_student_notified']) && $requestData['compliance_student_notified'] !== $interview->compliance_student_notified) {
            $updatedData['compliance_student_notified'] = $requestData['compliance_student_notified'];
            $updatedData['status_id'] = 4;
            $case_status_id = 4;
        }

        if (isset($requestData['compliance_interviewer_name']) && $requestData['compliance_interviewer_name'] !== $interview->compliance_interviewer_name) {
            $updatedData['compliance_interviewer_name'] = $requestData['compliance_interviewer_name'];
            $updatedData['status_id'] = 5;
            $case_status_id = 4;
        }

        if (isset($requestData['compliance_interview_date']) && $requestData['compliance_interview_date'] !== $interview->compliance_interview_date) {
            $updatedData['compliance_interview_date'] = $requestData['compliance_interview_date'];
            $updatedData['status_id'] = 5;
            $case_status_id = 4;
        }
        if (isset($requestData['compliance_start_time']) && $requestData['compliance_start_time'] !== $interview->compliance_start_time) {
            $updatedData['compliance_start_time'] = $requestData['compliance_start_time'];
            $updatedData['status_id'] = 5;
            $case_status_id = 4;
        }
        if (isset($requestData['compliance_end_time']) && $requestData['compliance_end_time'] !== $interview->compliance_end_time) {
            $updatedData['compliance_end_time'] = $requestData['compliance_end_time'];
            $updatedData['status_id'] = 5;
            $case_status_id = 4;
        }

        if (isset($requestData['compliance_sample_questions']) && $requestData['compliance_sample_questions'] !== $interview->compliance_sample_questions) {
            $updatedData['compliance_sample_questions'] = $requestData['compliance_sample_questions'];
            $updatedData['status_id'] = 6;
            $case_status_id = 5;
        }

        if (isset($requestData['case_id']) && $requestData['case_id'] !== $interview->case_id) {
            $updatedData['case_id'] = $requestData['case_id'];
            $caseId = $requestData['case_id'];
        }

        $updatedData['updated_by'] = Auth::id();

        if (!empty($updatedData)) {
            $updated = DB::table('interviews')->where('id', $interviewId)->update($updatedData);

            if ($updated) {
                StudentCase::where('id', $caseId)->update([
                    'case_status_id' => $case_status_id
                ]);
            }
        }

        return Interview::find($interviewId);
    }

}
