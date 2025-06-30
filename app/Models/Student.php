<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Student extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = "students";
    protected $guarded = [];
    public $timestamps = true;

    public function courses()
    {
        return $this->belongsToMany(Course::class, 'student_courses', 'student_id', 'course_id');
    }

    public function dependants()
    {
        return $this->belongsToMany(Dependant::class, 'student_dependants', 'student_id', 'dependant_id');
    }

    public function media()
    {
        return $this->hasMany(StudentMedia::class, 'student_id', 'id');
    }

    protected static function booted()
    {
        static::created(function ($student) {
            $student->student_id = 'MMC' . str_pad($student->id, 2, '0', STR_PAD_LEFT);
            $student->save();
        });
    }

    public static function add($student)
    {

        $new_student = new Student();
        $new_student->name = $student['name'];
        $new_student->surname = $student['surname'];
        $new_student->email = $student['email'];
        $new_student->nationality = $student['nationality'];
        $new_student->place_of_birth = $student['place_of_birth'];
        $new_student->phone_no = $student['phone_no'];
        $new_student->date_of_birth = $student['date_of_birth'];
        $new_student->gender = $student['gender'];
        $new_student->passport_start_date = $student['passport_start_date'];
        $new_student->passport_expiry_date = $student['passport_expiry_date'];
        $new_student->passport_status = $student['passport_status'];
        $new_student->created_by = Auth::user()->id;
        $new_student->updated_by = Auth::user()->id;
        $new_student->save();
        return $new_student;
    }

    public static function edit($student, $requestData)
    {
        $updatedData = [];

        if (isset($requestData['name']) && $requestData['name'] !== $student->name) {
            $updatedData['name'] = $requestData['name'];
        }

        if (isset($requestData['surname']) && $requestData['surname'] !== $student->surname) {
            $updatedData['surname'] = $requestData['surname'];
        }

        if (isset($requestData['email']) && $requestData['email'] !== $student->email) {
            $emailExists = DB::table('students')
                ->where('email', $requestData['email'])
                ->where('id', '!=', $student->id)
                ->exists();

            if ($emailExists) {
                throw new \Exception("The email {$requestData['email']} is already taken.");
            }

            $updatedData['email'] = $requestData['email'];
        }

        if (isset($requestData['nationality']) && $requestData['nationality'] !== $student->nationality) {
            $updatedData['nationality'] = $requestData['nationality'];
        }

        if (isset($requestData['phone_no']) && $requestData['phone_no'] !== $student->phone_no) {
            $updatedData['phone_no'] = $requestData['phone_no'];
        }
        if (isset($requestData['date_of_birth']) && $requestData['date_of_birth'] !== $student->date_of_birth) {
            $updatedData['date_of_birth'] = $requestData['date_of_birth'];
        }

        if (isset($requestData['gender']) && $requestData['gender'] !== $student->gender) {
            $updatedData['gender'] = $requestData['gender'];
        }

        if (isset($requestData['place_of_birth']) && $requestData['place_of_birth'] !== $student->place_of_birth) {
            $updatedData['place_of_birth'] = $requestData['place_of_birth'];
        }

        if (isset($requestData['passport_start_date']) && $requestData['passport_start_date'] !== $student->passport_start_date) {
            $updatedData['passport_start_date'] = $requestData['passport_start_date'];
        }
        if (isset($requestData['passport_expiry_date']) && $requestData['passport_expiry_date'] !== $student->passport_expiry_date) {
            $updatedData['passport_expiry_date'] = $requestData['passport_expiry_date'];
        }

        if (isset($requestData['passport_status']) && $requestData['passport_status'] !== $student->passport_status) {
            $updatedData['passport_status'] = $requestData['passport_status'];
        }
        if (isset($requestData['english_test']) && $requestData['english_test'] !== $student->english_test) {
            $updatedData['english_test'] = $requestData['english_test'];
        }
        if (isset($requestData['english_test_reason']) && $requestData['english_test_reason'] !== $student->english_test_reason) {
            $updatedData['english_test_reason'] = $requestData['english_test_reason'];
        }
        if (isset($requestData['last_course']) && $requestData['last_course'] !== $student->last_course) {
            $updatedData['last_course'] = $requestData['last_course'];
        }
        if (isset($requestData['last_course_completion_year']) && $requestData['last_course_completion_year'] !== $student->last_course_completion_year) {
            $updatedData['last_course_completion_year'] = $requestData['last_course_completion_year'];
        }
        if (isset($requestData['dependant']) && $requestData['dependant'] !== $student->dependant) {
            $updatedData['dependant'] = $requestData['dependant'];
        }
        if (isset($requestData['dependant_no']) && $requestData['dependant_no'] !== $student->dependant_no) {
            $updatedData['dependant_no'] = $requestData['dependant_no'];
        }
        if (isset($requestData['dependant_financial_info']) && $requestData['dependant_financial_info'] !== $student->dependant_financial_info) {
            $updatedData['dependant_financial_info'] = $requestData['dependant_financial_info'];
        }
        if (isset($requestData['flag_for_compliance']) && $requestData['flag_for_compliance'] !== $student->flag_for_compliance) {
            $updatedData['flag_for_compliance'] = $requestData['flag_for_compliance'];
        }
        if (isset($requestData['travel_outside']) && $requestData['travel_outside'] !== $student->travel_outside) {
            $updatedData['travel_outside'] = $requestData['travel_outside'];
        }
        if (isset($requestData['travel_outside_no']) && $requestData['travel_outside_no'] !== $student->travel_outside_no) {
            $updatedData['travel_outside_no'] = $requestData['travel_outside_no'];
        }
        if (isset($requestData['travel_uk']) && $requestData['travel_uk'] !== $student->travel_uk) {
            $updatedData['travel_uk'] = $requestData['travel_uk'];
        }
        if (isset($requestData['travel_uk_no']) && $requestData['travel_uk_no'] !== $student->travel_uk_no) {
            $updatedData['travel_uk_no'] = $requestData['travel_uk_no'];
        }
        if (isset($requestData['previous_study_uk']) && $requestData['previous_study_uk'] !== $student->previous_study_uk) {
            $updatedData['previous_study_uk'] = $requestData['previous_study_uk'];
        }
        if (isset($requestData['receive_student_visa']) && $requestData['receive_student_visa'] !== $student->receive_student_visa) {
            $updatedData['receive_student_visa'] = $requestData['receive_student_visa'];
        }
        if (isset($requestData['refusal_from_uk']) && $requestData['refusal_from_uk'] !== $student->refusal_from_uk) {
            $updatedData['refusal_from_uk'] = $requestData['refusal_from_uk'];
        }
        if (isset($requestData['course_level_in_uk']) && $requestData['course_level_in_uk'] !== $student->course_level_in_uk) {
            $updatedData['course_level_in_uk'] = $requestData['course_level_in_uk'];
        }
        if (isset($requestData['refusal_from_uk']) && $requestData['refusal_from_uk'] !== $student->refusal_from_uk) {
            $updatedData['refusal_from_uk'] = $requestData['refusal_from_uk'];
        }
        $updatedData['updated_by'] = Auth::user()->id;

        if (!empty($updatedData)) {
            $studentId = $student->id;
            DB::table('students')->where('id', $studentId)->update($updatedData);
        }

        if (isset($requestData['case_id']) && $requestData['case_id'] !== null) {
            $student =  DB::table('student_cases')->where('id', $requestData['case_id'])->update([
                'student_id' => $studentId
            ]);

        }

        return Student::find($studentId);
    }
}
