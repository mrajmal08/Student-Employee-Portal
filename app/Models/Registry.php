<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Registry extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = "registry";
    protected $guarded = [];

    public static function add($registry)
    {
        $case_registry = new Registry();
        $case_registry->student_id = $registry['student_id'] ?? null;
        $case_registry->case_id = $registry['case_id'] ?? null;
        $case_registry->student_status = $registry['student_status'] ?? null;
        $case_registry->break_in_study = $registry['break_in_study'] ?? null;
        $case_registry->break_return_date = $registry['break_return_date'] ?? null;
        $case_registry->break_sms_reporting = $registry['break_sms_reporting'] ?? null;
        $case_registry->break_sms_date = $registry['break_sms_date'] ?? null;

        $case_registry->student_withdrawn = $registry['student_withdrawn'] ?? null;
        $case_registry->withdraw_sms_reporting = $registry['withdraw_sms_reporting'] ?? null;
        $case_registry->withdraw_date = $registry['withdraw_date'] ?? null;

        $case_registry->attendance_monitoring_plan = json_encode($registry['attendance_monitoring_plan'] ?? null);
        $case_registry->fitness_to_study_plan = json_encode($registry['fitness_to_study_plan'] ?? null);
        $case_registry->pregnancy_evidence = json_encode($registry['pregnancy_evidence'] ?? null);
        $case_registry->disability = json_encode($registry['disability'] ?? null);
        $case_registry->risk_assessment = json_encode($registry['risk_assessment'] ?? null);
        $case_registry->withdraw_screenshot = json_encode($registry['withdraw_screenshot'] ?? null);

        $case_registry->transfer_of_course = json_encode($registry['transfer_of_course'] ?? []);
        $case_registry->sms_reporting_reasons = !empty($registry['sms_reporting_reasons']) ? json_encode($registry['sms_reporting_reasons']) : null;
        $case_registry->sms_reporting_attachments = !empty($registry['sms_reporting_attachments']) ? json_encode($registry['sms_reporting_attachments']) : null;

        $case_registry->personal_tutor = $registry['personal_tutor'] ?? null;
        $case_registry->notes = $registry['notes'] ?? null;
        $case_registry->course_submission_date = $registry['course_submission_date'] ?? null;
        $case_registry->resubmission_date = $registry['resubmission_date'] ?? null;
        $case_registry->chaser_date = $registry['chaser_date'] ?? null;
        $case_registry->new_visa_required = $registry['new_visa_required'] ?? null;

        $case_registry->eligible_for = $registry['eligible_for'] ?? null;
        $case_registry->date_of_award = $registry['date_of_award'] ?? null;
        $case_registry->sms_intake = $registry['sms_intake'] ?? null;
        $case_registry->sms_reporting = $registry['sms_reporting'] ?? null;
        $case_registry->student_notified = $registry['student_notified'] ?? null;

        $case_registry->created_by = Auth::user()->id;
        $case_registry->updated_by = Auth::user()->id;
        $case_registry->save();
        return $case_registry;
    }
}
