<?php

namespace App\Http\Controllers\MasterData;

use App\Http\Controllers\Controller;
use App\Models\DocumentType;
use Illuminate\Http\Request;
use App\Models\Sex;
use App\Http\Requests\StoreStaffRequest;
use App\Models\Branch;
use Illuminate\Support\Facades\DB;
use App\Models\StaffStatus;
use App\Models\Staff;


class StaffController extends Controller
{

    public function index(Request $request)
    {
        return view('master-data.staffs.index', [
            'status' => StaffStatus::all(),
            'branches' => Branch::all(),
            'staffs' => $this->staffService->getStaffs($request)
        ]);
    }

    public function create()
    {
        return view('master-data.staffs.create', [
            'status'    => StaffStatus::all(),
            'branches'  => Branch::all(),
        ]);
    }

    public function store(StoreStaffRequest $request)
    {
        DB::beginTransaction();
        try {
            $this->staffService->createStaff($request);
            DB::commit();
            return redirect()->back()->with('success', 'បញ្ចូលភ្នាក់ងារថ្មីជោគជ័យ!');
        } catch (\Exception $ex) {
            DB::rollback();
            return redirect()->back()->with('error', 'មិនអាចបញ្ចូលភ្នាក់ងារថ្មីបាន' . $ex->getMessage());
        }
    }

    public function edit($id)
    {
        return view('master-data.staffs.edit', [
            'staff' => Staff::find($id),
            'sexes' => Sex::all(),
            'status' => StaffStatus::all(),
            'branches' => Branch::all(),
            'documents' => DocumentType::all()
        ]);
    }

    public function update(StoreStaffRequest $request, $id)
    {
        DB::beginTransaction();
        try {
            $this->staffService->updateStaff($request, $id);
            DB::commit();
            return redirect()->back()->with('success', 'កែប្រែព័ត៌មានភ្នាក់ងារជោគជ័យ!');
        } catch (\Exception $ex) {
            DB::rollback();
            return redirect()->back()->with('error', 'មិនអាចបញ្ចូលភ្នាក់ងារថ្មីបាន' . $ex->getMessage());
        }
    }

    public function destroy($id)
    {
        Staff::find($id)->delete();
        return redirect()->route('master-data.staff.index');
    }
}
