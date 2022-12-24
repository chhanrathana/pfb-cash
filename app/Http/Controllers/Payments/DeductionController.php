<?php

namespace App\Http\Controllers\Payments;

use Illuminate\Http\Request;
use App\Models\InterestRate;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\Models\Payment;
use App\Enums\PaymentStatusEnum;
use Illuminate\Support\Facades\DB;
use App\Models\Loan;
use App\Models\Client;
use App\Enums\LoanStatusEnum;
use App\Http\Requests\StoreDeductionPaymentRequest;
use App\Models\Branch;
use App\Models\LoanStatus;

class DeductionController extends Controller
{

    public function index(Request $request)
    {
        $paymeneDate = $request->payment_date ?? Carbon::now()->format('d/m/Y');
        return view('payments.deduction.index', [
            'loans' => $this->loanService->getLoans($request, $paginate = true, $decution = true),
            'status' => LoanStatus::all(),
            'interests' => InterestRate::all(),
            'paymeneDate' => $paymeneDate,
            'staffs' => $this->staffService->getActiveStaffs(),
            'branches' => Branch::all(),
        ]);
    }

    public function edit($id)
    {
        $loan = Loan::where('id',$id)->first();
        $client = Client::find($loan->client_id);
        
        return view('payments.deduction.edit', [
            'loan' => $loan,
            'client' => $client,
            'staffs' => $this->staffService->getActiveStaffs(),
        ]);
    }
   
    public function update(StoreDeductionPaymentRequest $request, $id)
    {
        DB::beginTransaction();
        try {

            $loan = Loan::where('id', $id)
            // ->where('status',LoanStatusEnum::PROGRESS)
            ->first();
            if(!$loan){
                return redirect()->back()->with('error', 'ប្រតិបត្តិការមិនទាន់មានបានបង់ការប្រាក់');
            }

            if ($loan->status == LoanStatusEnum::FINISH) {
                return redirect()->back()->with('error', 'ប្រតិបត្តិកាបានបង់ផ្តាច់រួចហើយ');
            } 
            ;
            $loan->last_pending_amount = $loan->pending_amount;
            $loan->pending_amount = 0;
            $loan->status = LoanStatusEnum::FINISH;
            $loan->finish_discount = $request->finish_discount;
            $loan->finish_payment_date = Carbon::now()->format('Y-m-d');
            $interest = $loan->payments->where('status','<>','paid')->sum('interest_amount');        
            // $discount = $interest * ((100 - $loan->finish_discount )/100);                        
            // fixed bug on 16/10/2021
            $discount = $interest * (($loan->finish_discount )/100);
            $loan->finish_discount_amount = $discount;
            $loan->save();            

            $payments = Payment::where('loan_id', $id)
            ->where('status','<>', PaymentStatusEnum::PAID)
            ->get();
            if($payments){
                foreach($payments as $payment){

                    $updatePayment = Payment::where('id', $payment->id)->first();
                    $lastTimePaid = $updatePayment->total_paid_amount;
                    $updatePayment->status = PaymentStatusEnum::FINISH;
                    $updatePayment->last_payment_paid_date = Carbon::now()->format('Y-m-d');
                    $updatePayment->total_paid_amount = $updatePayment->total_amount;                    
                    $updatePayment->remark = 'discount '.$loan->finish_discount.' %';
                    $updatePayment->save();

                    // payment transactions
                    $this->paymentTransaction($updatePayment, ($updatePayment->total_paid_amount - $lastTimePaid), $type = 'deduction' , $loan->finish_discount);
                }
            }          

            DB::commit();
            return redirect()->back()->with('success', 'បង់ប្រាក់បានជោគជ័យ !');
        } catch (\Exception $ex) {
            DB::rollback();
            return redirect()->back()->with('error', 'មិនជោគជ័យ ' . $ex->getMessage());
        }
    }
}