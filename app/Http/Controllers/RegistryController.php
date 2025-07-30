<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;
use App\Models\Registry;
use Carbon\Carbon;

class RegistryController extends Controller
{
    use ApiResponseTrait;

    public function insert(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'student_id' => 'exists:student_cases,id,deleted_at,NULL',
        ]);

        if ($validator->fails()) {
            return $this->errorResponse('Validation failed', $validator->errors(), 422);
        }

        try {

            $registry = Registry::add($request->all());

            if ($request) {
                $timestamp = Carbon::now()->timestamp;

                $documents = [
                    'withdraw_screenshot',
                    'attendance_monitoring_plan',
                    'fitness_to_study_plan',
                    'pregnancy_evidence',
                    'disability',
                    'risk_assessment',
                    'transfer_of_course',
                    'sms_reporting_attachments'
                ];

                foreach ($documents as $doc) {
                    if ($request->hasFile($doc)) {
                        foreach ($request->file($doc) as $file) {
                            $extension = $file->getClientOriginalExtension();
                            $filename = $doc . '_' . rand(2367, 9999) . '_' . $timestamp . '.' . $extension;

                            $file->move(public_path('assets/registryFiles'), $filename);

                            // Insert into case_media table
                            DB::table('case_media')->insert([
                                'case_id' => $request->case_id,
                                'media_category_id' => 24,
                                'file_path' => 'assets/registryFiles/' . $filename,
                                'created_at' => now(),
                                'updated_at' => now(),
                                'created_by' => Auth::id(),
                                'updated_by' => Auth::id(),
                            ]);
                        }
                    }
                }
            }


            return $this->successResponse('Registry added successfully', $registry, 201);
        } catch (\Exception $e) {
            return $this->errorResponse('Failed to add Registry', $e->getMessage());
        }
    }
}
