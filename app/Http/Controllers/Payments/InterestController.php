<?php

namespace App\Http\Controllers\Payments;

use Illuminate\Http\Request;
use App\Models\InterestRate;
use App\Http\Requests\StoreInterestPaymentRequest;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\Models\PaymentStatus;
use App\Models\Payment;
use App\Enums\PaymentStatusEnum;
use Illuminate\Support\Facades\DB;
use App\Models\Client;
use App\Models\Loan;
use App\Enums\LoanStatusEnum;
use App\Models\Branch;
use App\Models\PaymentTransaction;

class InterestController extends Controller
{
    
    public function index(Request $request)
    {
        $paymeneDate = $request->payment_date ?? Carbon::now()->format('d/m/Y');
        
        return view('payments.interest.index', [
            'payments' => $this->paymentSevice->getInterestPayments($request, $paymeneDate),
            'status' => PaymentStatus::where('visible', true)->get(),
            'interests' => InterestRate::all(),
            'paymeneDate' => $paymeneDate,
            'staffs' => $this->staffService->getActiveStaffs(),
            'branches' => Branch::all(),
        ]);
    }

    public function edit($id)
    {
        $payment = Payment::find($id);
        $client = Client::find($payment->loan->client_id);
        return view('payments.interest.edit', [
            'payment' => $payment,
            'client' => $client,
            'staffs' => $this->staffService->getActiveStaffs(),
            'status' => PaymentStatus::where('visible', true)->get(),
            'color_class' => ['bg bg-warning','bg bg-success','bg bg-danger','bg bg-default']
        ]);
    }

    public function update(StoreInterestPaymentRequest $request, $id)
    {
        
        DB::beginTransaction();
        try {
            
            
            $payment = Payment::where('id', $id)->first();
            if(!$payment){
                return redirect()->back()->with('error', 'ប្រតិបត្តិការបានបង់ប្រាក់រួចរាល់ហើយ');
            }

            if ($request->total_paid_amount > $payment->total_amount) {
                return redirect()->back()->with('error', 'ចំនួនទឹកប្រាក់លើសចំនួនប្រាក់ត្រូវបង់');
            }

            if ($payment->status == PaymentStatusEnum::PAID) {
                return redirect()->back()->with('error', 'បានបង់ប្រាក់រួចហើយ');
            }

            // define varialable            
            $transactionAmount = $request->transaction_amount;


            if ($transactionAmount > $payment->total_amount) {
                return redirect()->back()->with('error', 'ប្រាក់បានបង់ មិនអាចធំជាងប្រាក់ត្រូវបង់');
            }

            // previous paid amount + current paid amount 
            $toalPaidAmount = $payment->total_paid_amount + $transactionAmount;

            $today = Carbon::now()->format('Y-m-d');
            $payment->last_payment_paid_date = $today;
            
            $payment->total_paid_amount =  $toalPaidAmount;            
            if($toalPaidAmount == $payment->total_amount){
                $payment->status = PaymentStatusEnum::PAID;                
            }
            elseif($today < $payment->getRawOriginal('payment_date')) {
                $payment->status = PaymentStatusEnum::Lack;                            
            }
            elseif($today > $payment->getRawOriginal('payment_date')) {
                $payment->status = PaymentStatusEnum::LATE;
            }
                        
            $payment->save();

            // payment transaction
            $this->paymentTransaction($payment, $transactionAmount);
            
            $sumLastTrxDeductAmount = PaymentTransaction::join('payments', 'payment_transactions.payment_id', 'payments.id')
            ->join('loans', 'payments.loan_id', 'loans.id')
            ->where('loans.id', $payment->loan->id)
            ->whereNull('loans.deleted_at')
            ->whereNull('payments.deleted_at')
            ->whereNull('payment_transactions.deleted_at')
            ->sum('payment_transactions.deduct_amount');

            $loan = Loan::find($payment->loan->id);
            $loan->status = LoanStatusEnum::PROGRESS;
            $loan->last_pending_amount = $loan->pending_amount;            
            $loan->pending_amount = ($loan->principal_amount  - $sumLastTrxDeductAmount);            

            // update trnsaction to finsih after paid all interest            
            $countPaidStatus = Payment::where([
                ['status', PaymentStatusEnum::PAID],
                ['loan_id', $payment->loan->id]
            ])->count();
            if($countPaidStatus == $loan->term){
                $loan->status = LoanStatusEnum::FINISH;
                $loan->finish_payment_date = Carbon::createFromFormat('d/m/Y', $payment->payment_date)->format('Y-m-d');
            }
            $loan->save();                                
            DB::commit();
            return redirect()->back()->with('success', 'បង់ប្រាក់បានជោគជ័យ !');
        } catch (\Exception $ex) {
            DB::rollback();
            return redirect()->back()->with('error', 'មិនជោគជ័យ ' . $ex->getMessage());
        }
    }    
}
