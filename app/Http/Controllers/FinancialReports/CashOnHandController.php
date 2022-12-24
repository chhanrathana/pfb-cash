<?php

namespace App\Http\Controllers\FinancialReports;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Branch;

class CashOnHandController extends Controller
{
    
    public function index(Request $request)
    {        
        return view('report-financials.cash-on-hands.index',[
            // 'fromDate' => $fromDate->format('d/m/Y'),
            // 'toDate' => $toDate->format('d/m/Y'),
            // 'payments' => $payments,
            'branchId' => auth()->user()->branch_id??$request->branch_id,
            'branches' => Branch::all(),
        ]);
    }

    
}