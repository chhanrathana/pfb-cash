<?php

namespace App\Http\Controllers\Loans;

use Illuminate\Http\Request;

use App\Models\Province;
use Illuminate\Support\Facades\DB;
use App\Models\Client;
use Carbon\Carbon;
use App\Models\Loan;
use App\Models\InterestRate;
use App\Models\LoanStatus;
use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Enums\PaymentStatusEnum;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\LoanExport;
use App\Http\Services\PDFService;
use App\Models\Branch;
use App\Models\PaymentTransaction;

class LoanController extends Controller
{
    public function index(Request $request)
    {
        return view('loans.index',[
            'loans' => $this->loanService->getLoans($request),
            'status' => LoanStatus::all(),
            'interests' => InterestRate::all(),
            'staffs' => $this->staffService->getActiveStaffs(),
            'branches' => Branch::all(),
        ]);
    }

    public function show($id)
    {
        $loan = Loan::find($id);
        $client = Client::find($loan->client_id);
        $logs = PaymentTransaction::whereHas('payment.loan', function($q) use($id){
            $q->where('id', $id);
        })
        ->orderBy('transaction_datetime','asc')
        ->get();

        return view('loans.show',[
            'loan' => $loan,
            'client' => $client,
            'logs' => $logs
        ]);
    }

    public function edit($id)
    {
        $payment = Payment::find($id);
        $client = Client::find($payment->loan->client_id);
        return view('loans.edit', [
            'payment' => $payment,
            'client' => $client,
        ]);
    }

    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $paymentDate = Carbon::createFromFormat('d/m/Y', $request->payment_date)->format('Y-m-d');
            // handle invalid transaction
            $currentPayment = Payment::where('id', $id)
            ->where('status','<>', PaymentStatusEnum::PAID)
            ->first();
            if(!$currentPayment){
                return redirect()->back()->with('error', 'ប្រតិបត្តិការនេះមិនត្រឹមត្រូវឫបានបង់ប្រាក់រួចហើយ' );
            }

            // handle invalid date range
            $nextPayment = Payment::where('loan_id', $currentPayment->loan_id)
            ->where('sort', ($currentPayment->sort+1))
            ->first();
            // dd($nextPayment);
            if ($nextPayment) {
                if ($nextPayment->getRawOriginal('payment_date') <= $paymentDate) {
                    return redirect()->back()->with('error', 'ថ្ងៃបង់ប្រាក់ជាន់នឹងថ្ងៃបង់ប្រាក់បន្ទាប់');
                }
            }

            $this->paymentSevice->updatePaymentDate($id, $paymentDate);

            DB::commit();
            return redirect()->route('loan.list.show',['id' => $nextPayment->loan_id]);
        } catch (\Exception $ex) {
            DB::rollback();
            return redirect()->back()->with('error', 'មិនអាចកែប្រែថ្ងៃបង់ប្រាក់បាន ' . $ex->getMessage());
        }
    }

    public function destroy($id)
    {
        $loan = Loan::find($id);
        Payment::where('loan_id', $id)->delete();
        $loan->delete();


        return redirect()->back();
    }

    public function printLoan($id){
        $province = Province::first();
        $loan = Loan::find($id);

        return view('loans.print-loan',[
            'province' => $province,
            'loan' => $loan,
            'district' => $province->districts->find($loan->client->village->commune->district_id)
        ]);
    }

    public function download(Request $request){
        $html = view('loans.print-loan-group',['loan' => Loan::find($request->id)]);
        return PDFService::reportPDF($html, $title = 'របាការណ៍', $orientation = 'P', $font = 12, $printCard = false, $mt = 10, $ml = 10, $mr = 10);
    }

    public function export(Request $request)
    {
        $data = Loan::find($request->id);
        return Excel::download(new LoanExport($data), 'loan_payment.xlsx');
    }
}
