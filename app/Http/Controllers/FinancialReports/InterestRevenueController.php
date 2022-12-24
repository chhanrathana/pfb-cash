<?php

namespace App\Http\Controllers\FinancialReports;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\CloseReportExport;
use App\Models\Branch;
use App\Models\PaymentTransaction;
use Illuminate\Support\Str;

class InterestRevenueController extends Controller
{
        
    public function index(Request $request)
    {        
        $fromDate = $request->from_date ? Carbon::createFromFormat('d/m/Y', $request->from_date):Carbon::now()->firstOfMonth();        
        $toDate = $request->to_date ? Carbon::createFromFormat('d/m/Y', $request->to_date): Carbon::now()->endOfMonth();
        $brandId = auth()->user()->branch_id??$request->branch_id;

        if($fromDate < '2022-01-01'){
            $fromDate = '2022-01-01';
            $fromDate = Carbon::parse($fromDate);
        }
        
        $payments = $this->getInterestRevenues($brandId, $fromDate, $toDate);

        return view('report-financials.revenue-interests.index',[
            'fromDate' => $fromDate->format('d/m/Y'),
            'toDate' => $toDate->format('d/m/Y'),
            'payments' => $payments,
            'branchId' => auth()->user()->branch_id??$request->branch_id,
            'branches' => Branch::all(),
        ]);
    }

    public function export(Request $request)
    {
        $brandId = $request->branch_id; 
        
        $transactionDate =  $request->transaction_date ?Carbon::createFromFormat('d/m/Y', $request->transaction_date):Carbon::now()->firstOfMonth();        

        $query = PaymentTransaction::query();
        $query->select('payment_transactions.*');
        $query->join('payments','payment_transactions.payment_id', 'payments.id');
        $query->join('loans','payments.loan_id', 'loans.id');
        $query->when($brandId, function ($query) use ($brandId) {                    
            $query->where('loans.branch_id',$brandId);            
        });

        $query->whereNull('loans.deleted_at'); 
        $query->whereNull('payments.deleted_at');
        $query->whereNull('payment_transactions.deleted_at');

        $query->whereDate('payment_transactions.transaction_datetime', Carbon::parse($transactionDate)->format('Y-m-d'));   
        $query->orderBy('payment_transactions.transaction_datetime','asc');
        $payments = $query->get();
        
        return Excel::download(new CloseReportExport($payments), 'loan_close_'.$transactionDate.Str::random() .'.xlsx');
    }         
}