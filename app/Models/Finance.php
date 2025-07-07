<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Finance extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = "finance";
    protected $guarded = [];

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
}
