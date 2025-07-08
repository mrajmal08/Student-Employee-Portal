<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Finance extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = "finance";
    protected $guarded = [];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public static function add($finance)
    {
        $new_finance = new Finance();
        $new_finance->case_id = $finance['case_id'];
        $new_finance->course_id = $finance['course_id'];
        $new_finance->course_fees = $finance['course_fees'];
        $new_finance->first_year_fees = $finance['first_year_fees'];
        $new_finance->living_cost_inside_london = $finance['living_cost_inside_london'];
        $new_finance->living_cost_outside_london = $finance['living_cost_outside_london'];
        $new_finance->total_fund = $finance['total_fund'];
        $new_finance->living_cost_plan = $finance['living_cost_plan'];
        $new_finance->other = $finance['other'];
        $new_finance->education_loan = $finance['education_loan'];
        $new_finance->fees_deposit = $finance['fees_deposit'];
        $new_finance->another_deposit = $finance['another_deposit'];
        $new_finance->funds_amount_paid = $finance['funds_amount_paid'];
        $new_finance->edu_loan_paid = $finance['edu_loan_paid'];
        $new_finance->fees_outstanding = $finance['fees_outstanding'];
        $new_finance->created_by = Auth::user()->id;
        $new_finance->updated_by = Auth::user()->id;
        $new_finance->save();
        return $new_finance;
    }

    public static function edit($finance, $requestData)
    {
        $updatedData = [];
        $financeId = $finance->id;


        if (isset($requestData['case_id']) && $requestData['case_id'] !== $finance->case_id) {
            $updatedData['case_id'] = $requestData['case_id'];
        }

        if (isset($requestData['course_id']) && $requestData['course_id'] !== $finance->course_id) {
            $updatedData['course_id'] = $requestData['course_id'];
        }

        if (isset($requestData['course_fees']) && $requestData['course_fees'] !== $finance->course_fees) {
            $updatedData['course_fees'] = $requestData['course_fees'];
        }
        if (isset($requestData['first_year_fees']) && $requestData['first_year_fees'] !== $finance->first_year_fees) {
            $updatedData['first_year_fees'] = $requestData['first_year_fees'];
        }

        if (isset($requestData['living_cost_inside_london']) && $requestData['living_cost_inside_london'] !== $finance->living_cost_inside_london) {
            $updatedData['living_cost_inside_london'] = $requestData['living_cost_inside_london'];
        }

        if (isset($requestData['living_cost_outside_london']) && $requestData['living_cost_outside_london'] !== $finance->living_cost_outside_london) {
            $updatedData['living_cost_outside_london'] = $requestData['living_cost_outside_london'];
        }

        if (isset($requestData['total_fund']) && $requestData['total_fund'] !== $finance->total_fund) {
            $updatedData['total_fund'] = $requestData['total_fund'];
        }

        if (isset($requestData['living_cost_plan']) && $requestData['living_cost_plan'] !== $finance->living_cost_plan) {
            $updatedData['living_cost_plan'] = $requestData['living_cost_plan'];
        }

        if (isset($requestData['other']) && $requestData['other'] !== $finance->other) {
            $updatedData['other'] = $requestData['other'];
        }
        if (isset($requestData['education_loan']) && $requestData['education_loan'] !== $finance->education_loan) {
            $updatedData['education_loan'] = $requestData['education_loan'];
        }
        if (isset($requestData['loan_doc']) && $requestData['loan_doc'] !== $finance->loan_doc) {
            $updatedData['loan_doc'] = $requestData['loan_doc'];
        }

        if (isset($requestData['fees_deposit']) && $requestData['fees_deposit'] !== $finance->fees_deposit) {
            $updatedData['fees_deposit'] = $requestData['fees_deposit'];
        }

        if (isset($requestData['another_deposit']) && $requestData['another_deposit'] !== $finance->another_deposit) {
            $updatedData['another_deposit'] = $requestData['another_deposit'];
        }
        if (isset($requestData['funds_amount_paid']) && $requestData['funds_amount_paid'] !== $finance->funds_amount_paid) {
            $updatedData['funds_amount_paid'] = $requestData['funds_amount_paid'];
        }
        if (isset($requestData['edu_loan_paid']) && $requestData['edu_loan_paid'] !== $finance->edu_loan_paid) {
            $updatedData['edu_loan_paid'] = $requestData['edu_loan_paid'];
        }

        if (isset($requestData['fees_outstanding']) && $requestData['fees_outstanding'] !== $finance->fees_outstanding) {
            $updatedData['fees_outstanding'] = $requestData['fees_outstanding'];
        }

        $updatedData['updated_by'] = Auth::id();

        if (!empty($updatedData)) {
            DB::table('finance')->where('id', $financeId)->update($updatedData);
        }

        return Finance::find($financeId);
    }
}
