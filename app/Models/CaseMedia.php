<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class CaseMedia extends Model
{
    use HasFactory;

    protected $table = 'case_media';

    public static function search($case_id = null, $category = null, $pagination = null, $per_page = null)
    {
        $query = DB::table('case_media')
            ->leftJoin('users as UBIC', 'UBIC.id', '=', 'case_media.created_by')
            ->leftJoin('users as UBIU', 'UBIU.id', '=', 'case_media.updated_by')
            ->select(
                'case_media.id AS case_media_id',
                'case_media.case_id',
                'case_media.media_category_id',
                'case_media.file_path',
                'case_media.created_at',
                'case_media.updated_at',
                'case_media.created_by',
                'case_media.updated_by',
                DB::raw("CONCAT(UBIC.name) as created_by"),
                DB::raw("CONCAT(UBIU.name) as updated_by")
            )
            ->whereNull('case_media.deleted_at');

        if (!is_null($case_id)) {
            $query->where('case_media.case_id', $case_id);
        }

        if (!is_null($category)) {
            if (is_array($category)) {
                $query->whereIn('case_media.media_category_id', $category);
            } else {
                $query->where('case_media.media_category_id', $category);
            }
        }

        $query->orderBy('case_media.id', 'desc');

        if (!is_null($pagination) && $pagination == 1) {
            return $query->paginate($per_page ?? 20);
        }

        return $query->get();
    }

}
