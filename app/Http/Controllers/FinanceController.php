<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;
use App\Models\Finance;
use Carbon\Carbon;

class FinanceController extends Controller
{
    use ApiResponseTrait;

    public function insert(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'case_id' => 'required|exists:student_cases,id',
            'course_id' => 'required|exists:courses,id',
        ]);

        if ($validator->fails()) {
            return $this->errorResponse('Validation failed', $validator->errors(), 422);
        }

        try {
            $finance = Finance::add($request->all());
            if ($finance) {
                $timestamp = Carbon::now()->timestamp;
                $documents = ['loan_doc', 'deposit_doc', 'another_deposit_doc', 'another_loan_doc'];

                foreach ($documents as $doc) {
                    if ($request->hasFile($doc)) {
                        $file = $request->file($doc);
                        $extension = $file->getClientOriginalExtension();
                        $filename = $doc . '_' . rand(2367, 9999) . '_' . $timestamp . '.' . $extension;

                        $file->move(public_path('assets/financeFiles'), $filename);

                        // Insert into case_media table
                        DB::table('case_media')->insert([
                            'case_id' => $request->case_id,
                            'media_category_id' => 12,
                            'file_path' => 'assets/financeFiles/' . $filename,
                            'created_at' => now(),
                            'updated_at' => now(),
                            'created_by' => Auth::user()->id,
                            'updated_by' => Auth::user()->id,
                        ]);
                    }
                }
            }
            return $this->successResponse('Finance details added successfully', $finance, 201);
        } catch (\Exception $e) {
            return $this->errorResponse('Failed to add finance details', $e->getMessage());
        }
    }

    public function single(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'case_id' => 'required|integer|exists:finance,case_id',
        ]);

        if ($validator->fails()) {
            return $this->errorResponse('Validation failed', $validator->errors(), 422);
        }

        $finance = Finance::with('course')->where('case_id', $request->case_id)->first();

        if (!$finance) {
            return $this->errorResponse('Finance record not found', null, 404);
        }

        return $this->successResponse('Finance details retrieved successfully', $finance);
    }

    public function update(Request $request)
    {

        $finance = Finance::findOrFail($request->id);

        try {
            $updatedUser = Finance::edit($finance, $request->all());

            if ($updatedUser) {
                $documents = ['loan_doc', 'deposit_doc', 'another_deposit_doc', 'another_loan_doc'];
                $timestamp = Carbon::now()->timestamp;

                foreach ($documents as $doc) {
                    if ($request->hasFile($doc)) {
                        $file = $request->file($doc);
                        $extension = $file->getClientOriginalExtension();
                        $filename = $doc . '_' . rand(2367, 9999) . '_' . $timestamp . '.' . $extension;

                        $file->move(public_path('assets/financeFiles'), $filename);

                        // Insert into case_media table
                        DB::table('case_media')->insert([
                            'case_id' => $request->case_id,
                            'media_category_id' => 12,
                            'file_path' => 'assets/financeFiles/' . $filename,
                            'created_at' => now(),
                            'updated_at' => now(),
                            'created_by' => Auth::user()->id,
                            'updated_by' => Auth::user()->id,
                        ]);
                    }
                }
            }
            return $this->successResponse('Finance data updated successfully', $updatedUser, 200);
        } catch (\Exception $e) {
            return $this->errorResponse('Failed to update Finance Data', $e->getMessage(), 500);
        }
    }
}
