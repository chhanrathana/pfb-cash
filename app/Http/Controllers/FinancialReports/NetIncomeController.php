<?php

namespace App\Http\Controllers\FinancialReports;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;


class NetIncomeController extends Controller
{
    
    public function index(Request $request)
    {        
        $fromDate = $request->from_date ? Carbon::createFromFormat('d/m/Y', $request->from_date):Carbon::now()->firstOfMonth();        
        $toDate = $request->to_date ? Carbon::createFromFormat('d/m/Y', $request->to_date): Carbon::now()->endOfMonth();
        $branchId = $request->branch_id;

       $revenues =  $this->calculateRevenues($branchId, $fromDate, $toDate);

        return view('report-financials.net-incomes.index',[
            'fromDate' => $fromDate->format('d/m/Y'),
            'toDate' => $toDate->format('d/m/Y'),
            'revenues' => $revenues
        ]);
    }
    
}