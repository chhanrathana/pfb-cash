<?php

namespace App\Http\Controllers\Payments;


use Illuminate\Http\Request;
use App\Models\Payment;
use App\Enums\LoanStatusEnum;
use App\Http\Controllers\Controller;
use App\Models\InterestRate;
use App\Models\PaymentStatus;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\PaymentExport;
use App\Enums\PaymentStatusEnum;
use App\Models\Staff;
use App\Enums\StatusEnum;
use App\Http\Services\PDFService;
use App\Models\Branch;

class PaymentController extends Controller
{
    public function index(Request $request)
    {
        $paymeneDate = $request->payment_date?? Carbon::now()->format('d/m/Y');
        
        $results = $this->paymentSevice->getInterestPayments($request, $paymeneDate, false, $print = true);

        $late = [];
        $early = [];

        foreach ( $results  as $result){

            if ($result->getRawOriginal('payment_date') < Carbon::parse(Carbon::createFromFormat('d/m/Y', $paymeneDate))->format('Y-m-d')){
                $late [] = $result;                   
            }
            else{
                $early [] = $result;
            }                    
        }
        $status = PaymentStatus::where('id', '<>', PaymentStatusEnum::FINISH)->get();
        if (!$request->staff_id) {
            $defaultStaff = Staff::where('status', StatusEnum::ACTIVE)->first();
            $request->staff_id = $defaultStaff->id;
        }else{
            $defaultStaff = Staff::where('id', $request->staff_id)->first();
        }

        return view('payments.index', [
            'late'  => $late,
            'early' => $early,
            'status' => $status,
            'interests' => InterestRate::all(),
            'branches' => Branch::all(),
            'paymeneDate' => $paymeneDate,
            'staffs' => $this->staffService->getActiveStaffs(),
            'defaultStaff' => $defaultStaff ?? null,
        ]);
    }

    public function updateStatus(Request $request, $id)
    {
        $payment = Payment::find($id);

        if($payment->loan->status == 'pending') {
            $payment->loan->status = LoanStatusEnum::PROGRESS;
        }

        $payment->status = $request->status;
        $payment->save();

        $pendingAmount = $payment->loan->payments->where('status', 'success')->pluck('deduct_amount')->sum();
        $payment->loan->pending_amount = $payment->loan->principal_amount - $pendingAmount;
        $payment->loan->save();

        if($request->url){
            return redirect($request->url);
        }

        return redirect()->route('loan.show', ['loan' => $payment->loan_id]);
    }

    public function download(Request $request)
    {
        $paymeneDate = $request->payment_date?? Carbon::now()->format('d/m/Y');
        $results = $this->paymentSevice->getInterestPayments($request, $paymeneDate, false, $print = true);

        $late = [];
        $early = [];

        foreach ( $results  as $result){
            if ($result->getRawOriginal('payment_date') < Carbon::parse(Carbon::createFromFormat('d/m/Y', $paymeneDate))->format('Y-m-d')){
                $late [] = $result;                   
            }
            else{
                $early [] = $result;
            }        
        }
        // $status = PaymentStatus::where('id', '<>', PaymentStatusEnum::FINISH)->get();
        if (!$request->staff_id) {
            $defaultStaff = Staff::where('status', StatusEnum::ACTIVE)->first();
            $request->staff_id = $defaultStaff->id;
        }else{
            $defaultStaff = Staff::where('id', $request->staff_id)->first();
        }

        $html = view('payments.print-payment', [
            'late'  => $late,
            'early' => $early,
            'defaultStaff' => $defaultStaff]);
        return PDFService::reportPDF($html, $title = 'តារាងប្រាក់កម្ចី', $orientation = 'P', $font = 12, $printCard = false, $mt = 10, $ml = 5, $mr = 5);
    }

    public function export(Request $request)
    {
        $paymeneDate = $request->payment_date ?? Carbon::now()->format('d/m/Y');
        $data = $this->paymentSevice->getInterestPayments($request, $paymeneDate, $paginate = false, $print = true);
        return Excel::download(new PaymentExport($data), 'loan_payment.xlsx');
    }
  
}
