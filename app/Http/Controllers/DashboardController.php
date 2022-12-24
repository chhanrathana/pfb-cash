<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use Illuminate\Http\Request;
use App\Models\InterestRate;
use App\Models\Loan;
use App\Models\Payment;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $this->updateLateTransaction();
        
        $brandId = $request->branch_id??auth()->user()->branch_id;    
        $queryLoan = Loan::query();
        $queryLoan->when($brandId && ($brandId <> 'all'), function ($q) use ($brandId) {
            $q->where('branch_id', $brandId);            
        });   

        $queryInterest = InterestRate::query();
        $queryInterest->leftjoin('loans', 'interest_rates.id', '=', 'loans.interest_rate_id');
        $queryInterest->select('interest_rates.name', 'interest_rates.css','interest_rates.sort', DB::raw('count(loans.id) as count, sum(loans.principal_amount) as principal_amount'));
        $queryInterest->groupBy('interest_rates.name', 'interest_rates.css','interest_rates.sort');        
        $queryInterest->whereNull('loans.deleted_at');

        $queryInterest->when($brandId && ($brandId <> 'all'), function ($q) use ($brandId) {
            $q->where('loans.branch_id', $brandId);
        });
        $interests = $queryInterest->get();

        return view('dashboards.index',[
            'branches' => Branch::all(),
            'interests' => $interests,
        ]);
    }


    private function recoverseErrorData(){
        $loans = Loan::where('status', 'finish')
        ->where('finish_discount','>', 0)
        ->get();
        // dd($loans->toArray());
        foreach($loans as $loan){
            $interest = Payment::where('loan_id', $loan->id)
            ->where('status', 'finish')        
            ->sum('interest_amount');                                

            $updateLoan = Loan::find($loan->id);
            $discount = $interest * ((100 - $loan->finish_discount )/100);                        
            $updateLoan->finish_discount_amount = $discount;
            $updateLoan->save();

            echo "<br/> ".$updateLoan->id ." | ".number_format($interest).' | '.number_format($updateLoan->finish_discount_amount);
        }
        exit;
        // dd($loans->toArray());
    }
}
