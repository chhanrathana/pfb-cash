<?php

namespace App\Http\Controllers\FinancialReports;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\Deposit;
use Carbon\Carbon;


class DividendRevenueController extends Controller
{
    
    public function index(Request $request)
    {                        

        $fromDate = $request->from_date ? Carbon::createFromFormat('d/m/Y', $request->from_date):Carbon::now()->firstOfMonth();        
        $toDate = $request->to_date ? Carbon::createFromFormat('d/m/Y', $request->to_date): Carbon::now()->endOfMonth();
        $branchId = $request->branch_id??Branch::first(['id'])->id;
        $branch = Branch::find($branchId);

        
        $revenues =  $this->calculateRevenues($branchId, $fromDate, $toDate);
       
        $deposits = Deposit::where('branch_id', $branchId)->orderBy('deposit_amount', 'desc')->get();       
        $sumDeposit = Deposit::where('branch_id', $branchId)->sum('deposit_amount');

        $income = $this->getNetIncome($branchId, $fromDate, $toDate);
              
        return view('report-financials.revenue-dividends.index',[
            'fromDate' => $fromDate->format('d/m/Y'),
            'toDate' => $toDate->format('d/m/Y'),
            'revenues' => $revenues,
            'income' => $income,
            'deposits' => $deposits,
            'branches' => Branch::all(),
            'branch' => $branch,
            'rate' => $sumDeposit > 0? ($income->net_income/$sumDeposit) * 100:0
        ]);
    }    
}