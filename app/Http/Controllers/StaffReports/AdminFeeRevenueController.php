<?php

namespace App\Http\Controllers\StaffReports;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Branch;
use Illuminate\Support\Facades\DB;
use App\Models\Staff;
use Carbon\Carbon;


class AdminFeeRevenueController extends Controller
{       
   
    public function index(Request $request)
    {
        $fromDate = $request->from_date ? Carbon::createFromFormat('d/m/Y', $request->from_date):Carbon::now()->firstOfMonth();
        $toDate = $request->to_date ? Carbon::createFromFormat('d/m/Y', $request->to_date): Carbon::now()->endOfMonth();
        
        $query = Staff::query();
        $query->select(    
            'staffs.id',
            'staffs.name_kh',
            'staffs.branch_id',    
            DB::raw('count(loans.id) as transaction'),
            DB::raw('sum(principal_amount) as total_principal_amount'),
            DB::raw('sum(admin_amount) as total_admin_amount'),
        );

        $query->join('loans','staffs.id','loans.staff_id');
        
        $query->when($request->branch_id && ($request->branch_id <> 'all'), function ($q) use ($request) {
            $q->where('staffs.branch_id', $request->branch_id);            
        });
        $query->whereNull('loans.deleted_at'); 

        
        if($fromDate < '2022-01-01'){
            $fromDate = '2022-01-01';
            $fromDate = Carbon::parse($fromDate);
        }
        
        $query->whereDate('loans.registration_date', '>=', Carbon::parse($fromDate)->format('Y-m-d'));
        $query->whereDate('loans.registration_date', '<=', Carbon::parse($toDate)->format('Y-m-d'));        

        $query->groupBy('staffs.id','staffs.name_kh','staffs.branch_id');
        $query->orderBy('staffs.branch_id','asc');
        $staffs = $query->get();

        return view('report-staffs.revenue-admin-fees.index', [  
            'staffs'     => $staffs,    
            'fromDate' => $fromDate->format('d/m/Y'),
            'toDate' => $toDate->format('d/m/Y'),
            'branches' => Branch::all(),        
        ]);
    }
}