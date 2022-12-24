<?php

namespace App\Http\Controllers\FinancialReports;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Branch;

class AdminFeeRevenueController extends Controller
{
    
       
    public function index(Request $request)
    {        
        $fromDate = $request->from_date ? Carbon::createFromFormat('d/m/Y', $request->from_date):Carbon::now()->firstOfMonth();        
        $toDate = $request->to_date ? Carbon::createFromFormat('d/m/Y', $request->to_date): Carbon::now()->endOfMonth();
        $brandId = $request->branch_id;
            
        if($fromDate < '2022-01-01'){
            $fromDate = '2022-01-01';
            $fromDate = Carbon::parse($fromDate);
        }
        
        $loans = $this->getAdminFeeRevenues($brandId, $fromDate, $toDate);
        
        return view('report-financials.revenue-admin-fees.index',[
            'fromDate' => $fromDate->format('d/m/Y'),
            'toDate' => $toDate->format('d/m/Y'),
            'loans' => $loans,
            'branchId' => auth()->user()->branch_id??$request->branch_id,
            'branches' => Branch::all(),
        ]);
    }
}