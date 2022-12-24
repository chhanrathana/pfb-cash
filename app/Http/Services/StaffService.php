<?php

namespace App\Http\Services;

use Carbon\Carbon;
use App\Models\Staff;
use App\Enums\StatusEnum;

class StaffService
{

    public function createStaff($request){

        return Staff::create($request->validated());
    }

    public function updateStaff($request, $id)
    {
        return Staff::find($id)->update($request->validated());
    }

    public function getStaffs($request, $paginate = true)
    {
        $query = Staff::query();

        $query->when($request->branch_id && ($request->branch_id <> 'all'), function ($q) use ($request) {
            $q->where('branch_id', $request->branch_id);
        });


        $query->when($request->name_kh, function ($q) use ($request) {
            $nameKh = mb_strtoupper(trim($request->name_kh));
            $q->where('name_kh', 'like', '%' . $nameKh . '%');
        });

        $query->when($request->name_en, function ($q) use ($request) {
            $nameEn = mb_strtoupper(trim($request->name_en));
            $q->where('name_en', 'like', '%' . $nameEn . '%');
        });

        $query->when($request->status && strtolower($request->status) != 'all', function ($q) use ($request) {
            $q->where('status', $request->status);
        });
        $query->orderBy('created_at', 'desc');

        if ($paginate) {
            return $query->paginate(env('PAGINATION'));
        }
        return $query->get();
    }

    public function getActiveStaffs()
    {
        $query = Staff::query();
        $query->where('status', StatusEnum::ACTIVE);
        return $query->get();
    }
}
