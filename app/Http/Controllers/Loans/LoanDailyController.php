<?php

namespace App\Http\Controllers\Loans;

use App\Models\LoanType;
use Illuminate\Http\Request;
use App\Enums\InterestEnum;
use App\Http\Requests\DailyLoanRequest;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\District;
use App\Models\Village;
use App\Models\Commune;
use App\Models\Loan;
use App\Models\Client;

class LoanDailyController extends Controller
{

    public function create(Request $reqeust)
    {
        // default
        $districts = null;
        $communes = null;
        $villages = null;
        $loan = null;
        $client = $this->clientService->getClientById($reqeust->selected);
        if ($client) {
            $districts = District::where('province_id', $client->village->commune->district->province->id)->get();
            $communes = Commune::where('district_id', $client->village->commune->district->id)->get();
            $villages = Village::where('commune_id', $client->village->commune->id)->get();
            $loan = Loan::where('client_id', $client->id)
            ->whereHas('interest', function($query){
                $query->where('code', InterestEnum::DAILY);
            })
            ->orderBy('created_at', 'desc')->first();
        }
        $loanTypes = LoanType::all();
        return view('loans.daily.create', [
            'interest' => $this->getInterestType(InterestEnum::DAILY),
            'staffs' => $this->staffService->getActiveStaffs(),
            'clients' => $this->clientService->getClients($reqeust),
            'client' => $client,
            'loan' => $loan,
            'loanTypes' => $loanTypes,
            'first_guarantor' => null,
            'second_guarantor' => null,
            'districts' => $districts,
            'communes' => $communes,
            'villages' => $villages,
            'branches' => Branch::all(),
        ]);

    }


    public function store(DailyLoanRequest $request)
    {
        if ($request->loan_type == "group"){
            $request -> validate([
               'member_name_kh' => 'required|array',
               'member_name_en' => 'required|array'
            ]);
        }
        DB::beginTransaction();
        try {
            $exist = $this->clientService->checkExistClient($request);
            if($exist){
                return redirect()->back()->with('error', 'អតិថិជនធ្លាប់មានម្តងរួចហើយដែលមានលេខកូដ ' . $exist->code);
            }

            $client = $this->clientService->createClient($request);

            // update rate for payment
            $this->paymentSevice->updateInterestRate(InterestEnum::DAILY, $request->rate, $request->commission_rate);

            $loan = $this->loanService->createLoan($request, $client, InterestEnum::DAILY);
            $this->paymentSevice->createPaymentDailyLoan($request->term, $loan);
            $this->paymentSevice->updatePenaltyAmount($loan->payments, $loan->payments->count());
            DB::commit();
            return redirect()->back()->with('success', 'បញ្ចូលកម្ចីប្រចាំថ្ងៃជោគជ័យ! លេខកូដអតិថិជន៖'." $client->code");
        } catch (Exception $ex) {
            DB::rollback();
            dd($ex ->  getMessage());
            return redirect()->back()->with('error', 'មិនអាចបញ្ចូលកម្ចីប្រចាំថ្ងៃ' . $ex->getMessage());
        }
    }

    public function edit($id)
    {
        $loan = Loan::find($id);
        $client = Client::find($loan->client_id);

        $districts = District::where('province_id', $client->village->commune->district->province->id)->get();
        $communes = Commune::where('district_id', $client->village->commune->district->id)->get();
        $villages = Village::where('commune_id', $client->village->commune->id)->get();
        $loanTypes = LoanType::all();
        return view('loans.daily.edit', [
            'interest' => $this->getInterestType(InterestEnum::DAILY),
            'staffs' => $this->staffService->getActiveStaffs(),
            'loan' => $loan,
            'loanTypes' => $loanTypes,
            'first_guarantor' => $loan->firstGuarantor->first(),
            'second_guarantor' => $loan->secondGuarantor->first(),
            'client' => $client,
            'districts' => $districts,
            'communes' => $communes,
            'villages' => $villages,
            'branches' => Branch::all(),
        ]);
    }


    public function update(DailyLoanRequest $request, $id)
    {
        DB::beginTransaction();
        try {

            $client = $this->clientService->createClient($request);
            // update rate for payment
            $this->paymentSevice->updateInterestRate(InterestEnum::DAILY, $request->rate, $request->commission_rate);

            $this->paymentSevice->removePayments($id);
            $loan = $this->loanService->createLoan($request, $client, InterestEnum::DAILY);
            $this->paymentSevice->createPaymentDailyLoan($request->term, $loan);
            $this->paymentSevice->updatePenaltyAmount($loan->payments, $loan->payments->count());
            DB::commit();
            return redirect()->back()->with('success', 'កែប្រែកម្ចីប្រចាំថ្ងៃជោគជ័យ!');
        } catch (\Exception $ex) {
            DB::rollback();
            return redirect()->back()->with('error', 'មិនអាចកែប្រែកម្ចីប្រចាំថ្ងៃ' . $ex->getMessage());
        }
    }
}
