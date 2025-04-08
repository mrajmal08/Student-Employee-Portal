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

        $updatedData['updated_by'] = Auth::user()->id;

        if (!empty($updatedData)) {
            DB::table('students')->where('id', $student->id)->update($updatedData);
        }

        return Student::find($student->id);
    }
}
