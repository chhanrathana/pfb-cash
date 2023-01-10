<?php

namespace App\Http\Controllers\Loans;


use App\Http\Traits\Weeklyloan;
use Carbon\Carbon;
use Carbon\Exceptions\InvalidFormatException;
use Illuminate\Http\Request;
use App\Enums\InterestEnum;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\LoanRequest;
use App\Models\Branch;
use App\Models\District;
use App\Models\Village;
use App\Models\Commune;
use App\Models\Loan;
use App\Models\Client;
use App\Models\LoanType;

class LoanWeeklyController extends Controller
{
    use Weeklyloan;
    public function create(Request $reqeust)
    {
        // default
        $districts = null;
        $communes = null;
        $villages = null;
        $loan = null;

        $client = $this->clientService->getClientById($reqeust->selected);

        if($client){
            $districts = District::where('province_id', $client->village->commune->district->province->id)->get();
            $communes = Commune::where('district_id', $client->village->commune->district->id)->get();
            $villages = Village::where('commune_id', $client->village->commune->id)->get();
            $loan = Loan::where('client_id', $client->id)
            ->whereHas('interest', function($query){
                $query->where('code', InterestEnum::WEEKLY);
            })
            ->orderBy('created_at', 'desc')->first();
        }
        $loanTypes = LoanType::all();
        return view('loans.weekly.create', [
            'interest' => $this->getInterestType(InterestEnum::WEEKLY),
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

    public function store(LoanRequest $request)
    {

        DB::beginTransaction();
        try {

            $exist = $this->clientService->checkExistClient($request);
            if($exist){
                return redirect()->back()->with('error', 'អតិថិជនធ្លាប់មានម្តងរួចហើយដែលមានលេខកូដ ' . $exist->code);
            }

            $client = $this->clientService->createClient($request);
            // update rate for payment
            $this->paymentSevice->updateInterestRate(InterestEnum::WEEKLY, $request->rate, $request->commission_rate);
            $loan = $this->loanService->createLoan($request, $client, InterestEnum::WEEKLY);
            $this->paymentSevice->createPayment($request->term, $loan);
            $this->paymentSevice->updatePenaltyAmount($loan->payments, $loan->payments->count());
            DB::commit();
            return redirect()->back()->with('success', 'បញ្ចូលកម្ចីសប្តាហ៍ជោគជ័យ! លេខកូដអតិថិជន៖'." $client->code");
        } catch (\Exception $ex) {
            DB::rollback();
            dd($ex -> getTrace());
            return redirect()->back()->with('error', 'មិនអាចបញ្ចូលកម្ចីសប្តាហ៍' . $ex->getMessage());
        }
    }

    public function edit($id)
    {
        $loan = Loan::find($id);
        $client = Client::find($loan->client_id);

        $districts = District::where('province_id', $client->village->commune->district->province->id)->get();
        $communes = Commune::where('district_id', $client->village->commune->district->id)->get();
        $villages = Village::where('commune_id', $client->village->commune->id)->get();

        return view('loans.weekly.edit', [
            'interest' => $this->getInterestType(InterestEnum::WEEKLY),
            'staffs' => $this->staffService->getActiveStaffs(),
            'loan' => $loan,
            'client' => $client,
            'districts' => $districts,
            'communes' => $communes,
            'villages' => $villages,
            'branches' => Branch::all(),
        ]);
    }

    public function update(LoanRequest $request, $id)
    {
        DB::beginTransaction();
        try {

            $client = $this->clientService->createClient($request);
            // update rate for payment
            $this->paymentSevice->updateInterestRate(InterestEnum::WEEKLY, $request->rate, $request->commission_rate);
            $loan = $this->loanService->createLoan($request, $client, InterestEnum::WEEKLY);

            $this->paymentSevice->removePayments($id);
            $this->paymentSevice->createPayment($request->term, $loan);
            $this->paymentSevice->updatePenaltyAmount($loan->payments, $loan->payments->count());

            DB::commit();
            return redirect()->back()->with('success', 'កែប្រែកម្ចីសប្តាហ៍ជោគជ័យ!');
        } catch (\Exception $ex) {
            DB::rollback();
            return redirect()->back()->with('error', 'មិនអាចកែប្រែកម្ចីសប្តាហ៍' . $ex->getMessage());
        }
    }
}
