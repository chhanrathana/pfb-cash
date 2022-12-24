<?php

namespace App\Http\Controllers\StaffReports;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Branch;
use App\Models\StaffStatus;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Loan;
use Illuminate\Support\Facades\DB;
use App\Exports\StaffClientExport;
use App\Models\Staff;

class StatisticController extends Controller
{
    
    public function index(Request $request)
    {
        $fromDate = $request->from_date ? Carbon::createFromFormat('d/m/Y', $request->from_date):null;
        $toDate = $request->to_date ? Carbon::createFromFormat('d/m/Y', $request->to_date):null;

        $loans = $this->getStaffLoanStatistic($request,  $fromDate, $toDate);
        $payments = $this->getStaffPaymentStatistic($request,  $fromDate, $toDate);

        $items = [];
        foreach($loans as $loan){
            foreach($payments as $payment){
                if($loan->id == $payment->id){
                    $items [] = [
                        'staff_id'  => $payment->id,
                        'staff_name' => $loan->name_kh,
                        'branch_name' => $loan->branch->name??'',
                        'new_loan' => $loan->count_new,
                        'old_loan' => $loan->count_old,
                        'total_loan' => $loan->count_loans,
                        'principal_amount' => $loan->total_principal_amount,
                        'loan_for_new_client' => $loan->sum_new,
                        'active_loan' => $loan->progressing,
                        'inactive_loan' => $loan->finish,
                        'sum_total_pending_deduction' => $payment->sum_total_pending_deduction,
                        'count_late' => $payment->count_late,
                        'sum_late_deduction' => $payment->sum_late_deduction,
                        'par' => $payment->sum_late_deduction <= 0? 'N/A' : sprintf("%.2f%%", ($payment->sum_late_deduction / $payment->sum_total_pending_deduction) * 100)
                    ];
                }                
            }
        }

        return view('report-staffs.statistics.index', [            
            // 'fromDate' => $fromDate->format('d/m/Y')??null,
            // 'toDate' => $toDate->format('d/m/Y')??null,
            'status' => StaffStatus::all(),
            'items' => $items,
            'branches' => Branch::all(),
        ]);
    }  


    public function export($id)
    {
        $staff = Staff::find($id);

        $query = Loan::query();
        $query->join('payments', 'loans.id', 'payments.loan_id');
        $query->select(
            'loans.id',
            'loans.client_id',
            'loans.status',
            'loans.interest_rate_id',
            'loans.registration_date',
            'loans.principal_amount',
            'loans.commission_rate',
            'loans.rate',
            'loans.last_payment_date',
            'loans.pending_amount',
            DB::raw('sum(payments.total_paid_amount ) as total_paid_amount'),
            DB::raw('sum(if(payments.`status` = \'late\' and payments.deduct_amount >= payments.total_paid_amount,payments.deduct_amount - payments.total_paid_amount,0 )) sum_late_deduction'),
        );        
        $query->where('loans.staff_id',$id);
        $query->whereNull('loans.deleted_at');
        $query->whereNull('payments.deleted_at');
        $query->groupBy(
            'loans.id',
            'loans.client_id',
            'loans.status',
            'loans.interest_rate_id',
            'loans.registration_date',
            'loans.principal_amount',
            'loans.commission_rate',
            'loans.rate',
            'loans.last_payment_date',
            'loans.pending_amount'
        );
        $query->orderBy('loans.status', 'asc');
        $loans = $query->get();
        

        return Excel::download(new StaffClientExport($loans), 'co_client_' . strtolower($staff->name_en) . '.xlsx');
    }  
}