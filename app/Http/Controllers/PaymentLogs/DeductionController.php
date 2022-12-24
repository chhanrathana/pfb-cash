<?php

namespace App\Http\Controllers\PaymentLogs;

use App\Models\Loan;
use App\Models\LoanStatus;
use App\Models\PaymentTransaction;
use Illuminate\Http\Request;
use App\Models\Payment;
use App\Enums\LoanStatusEnum;
use App\Http\Controllers\Controller;
use App\Models\InterestRate;
use App\Models\PaymentStatus;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\PaymentExport;
use App\Enums\PaymentStatusEnum;
use App\Models\Staff;
use App\Enums\StatusEnum;
use App\Http\Services\PDFService;
use App\Models\Branch;

class DeductionController extends Controller
{    

    public function index(Request $request){
        $paymeneDate = $request->payment_date ?? Carbon::now()->format('d/m/Y');
        return view('payments.history.index', [
            'loans' => $this->loanService->getLoans($request, true, false,true),
            'status' => LoanStatus::all(),
            'interests' => InterestRate::all(),
            'paymeneDate' => $paymeneDate,
            'staffs' => $this->staffService->getActiveStaffs(),
            'branches' => Branch::all(),
        ]);
    }

    public function rollback(Request $req, $id){
        DB::beginTransaction();
        try {
            $loan = Loan::where('id', $id)
                ->first();
            if(!$loan){
                return redirect()->back()->with('error', 'ប្រតិបត្តិការមិនទាន់មានបានបង់ការប្រាក់');
            }
            $loan->pending_amount = $loan->last_pending_amount;
            $loan->status = LoanStatusEnum::PROGRESS;
            $loan->finish_discount = 0;
            $loan->finish_payment_date = null;
            $loan->finish_discount_amount = 0;
            $loan->save();

            $payments = Payment::where('loan_id', $id)
                ->where('status', PaymentStatusEnum::FINISH)
                ->get();

            if($payments){
                foreach($payments as $payment){
                    $updatePayment = Payment::where('id', $payment->id)
                    ->where('status', PaymentStatusEnum::FINISH)
                    ->first();
                    $updatePayment->status = PaymentStatusEnum::PENDING;
                    $updatePayment->last_payment_paid_date = null;
                    $updatePayment->total_paid_amount = 0;
                    $updatePayment->remark = 'reverse :: '.$updatePayment->remark;
                    $updatePayment->save();

                    $trx = new PaymentTransaction();
                    $trx->payment_id = $payment->id;
                    $trx->type = 'reverse';
                    $trx->transaction_datetime = Carbon::now();
                    $trx->transaction_amount = $payment->total_amount;
                    $trx->save();
                }
            }
            DB::commit();
            return redirect()->back()->with('success', 'ត្រឡប់ប្រតិបត្តិការបានជោគជ័យ !');
        } catch (\Exception $ex) {
            dd( $ex);
            DB::rollback();
            return redirect()->back()->with('error', 'មិនជោគជ័យ ' . $ex->getMessage());
        }
    }
}
