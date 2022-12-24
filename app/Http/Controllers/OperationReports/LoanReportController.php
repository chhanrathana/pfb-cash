<?php

namespace App\Http\Controllers\OperationReports;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\LoanStatus;
use App\Models\InterestRate;
use App\Exports\MonthlyReportExport;
use App\Models\Branch;
use App\Models\Staff;
use Maatwebsite\Excel\Facades\Excel;

class LoanReportController extends Controller
{
   
    public function index(Request $request)
    {
        return view('report-operations.loans.index',[
            'loans' => $this->loanService->getLoans($request),
            'interests' => InterestRate::all(),
            'status' => LoanStatus::all(),
            'branches' => Branch::all(),
            'staffs' => Staff::all(),
        ]);
    }

    public function export(Request $request)
    {
        $data = $this->loanService->getLoans($request, $paginate = false);
        return Excel::download(new MonthlyReportExport($data), 'loan_report.xlsx');
    }

}
