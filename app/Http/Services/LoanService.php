<?php

namespace App\Http\Services;


use App\Models\Guarantor;
use App\Models\Loan;
use App\Enums\LoanStatusEnum;
use App\Models\LoanMember;
use App\Models\Member;
use Carbon\Carbon;
use App\Models\InterestRate;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class LoanService
{

    private function generateLoanCode()
    {
        $count= DB::table('loans')->max('code');
        $code = (1 + $count);
        return str_pad($code, 5, '0', STR_PAD_LEFT);
    }

    public function removeLoan($id){
        Loan::where('id', $id)->where('status', LoanStatusEnum::PENDING)->delete();
    }

    public function createLoan($req, $client, $type)
    {
        $interest = InterestRate::where('code', $type)->first();

        $loan = Loan::find($req->loan_id);
        $registrationDate = Carbon::createFromFormat('d/m/Y', $req->registration_date)->format('Y-m-d');
        if (!$loan) {
            $loan = new Loan();
            $loan->code = $this->generateLoanCode();
        }
        $loan->principal_amount = $req -> principal_amount;
        $loan->term = $req -> term;
        $loan->registration_date = $req->registration_date;
        $loan->started_payment_date = $req -> started_payment_date;
        $loan->admin_rate = $req -> admin_rate;
        $loan->purpose = $req -> loan_purpose;

        $loan->interest_rate_id = $interest->id;
        $loan->rate = $interest->rate;
        $loan->commission_rate = $interest->commission_rate;
        $loan->admin_amount = $req->principal_amount * ($req->admin_rate /100);
        $loan->pending_amount = $req->principal_amount;
        $loan->last_payment_date = Carbon::parse($registrationDate)->addDays($interest->interval * $req->term);
        $loan->client_id = $client->id;
        $loan->status = LoanStatusEnum::PENDING;
        $loan->branch_id = $req->branch_id;
        $loan->staff_id = $req -> staff_id;
        $loan->loan_type_id = $req -> loan_type;
        $loan->save();
        //guarantor first
        if ($req -> first_guarantor_name){
            // delete first
            $loan -> firstGuarantor ? $loan -> firstGuarantor() -> detach() : null;
            $clientDOB = $req -> first_guarantor_date_of_birth? Carbon::createFromFormat('d/m/Y', $req->first_guarantor_date_of_birth)->format('Y-m-d') : null;
            $firstId = Str::uuid();
            Guarantor::insert([
               'id'  => $firstId,
                'full_name' => $req -> first_guarantor_name,
                'sex' => $req -> first_guarantor_sex,
                'date_of_birth' => $clientDOB,
                'document_type' => $req -> first_guarantor_document_type,
                'document_number' => $req -> first_guarantor_document_number,
                'phone_number' => $req -> first_guarantor_date_of_phone_number
            ]);
            DB::table('loan_guarantor')->insert([
                'loan_id' => $loan -> id,
                'guarantor_id' => $firstId,
                'remark' => 'first_guarantor'
            ]);
        }
        //guarantor second
        if ($req -> second_guarantor_name){
            // delete
            $loan -> secondGuarantor ? $loan -> secondGuarantor() -> detach() : null;
            $clientDOB = $req -> second_guarantor_date_of_birth? Carbon::createFromFormat('d/m/Y', $req->second_guarantor_date_of_birth)->format('Y-m-d') : null;
            $secondID = Str::uuid();
            Guarantor::insert([
                'id'  => $secondID,
                'full_name' => $req -> second_guarantor_name,
                'sex' => $req -> second_guarantor_sex,
                'date_of_birth' => $clientDOB,
                'document_type' => $req -> second_guarantor_document_type,
                'document_number' => $req -> second_guarantor_document_number,
                'phone_number' => $req -> second_guarantor_date_of_phone_number
            ]);

            DB::table('loan_guarantor')->insert([
                'loan_id'       => $loan -> id,
                'guarantor_id'  => $secondID,
                'remark'        => 'second_guarantor'
            ]);
        }
        // loan member
        if(($req -> loan_type == "group")){
            // create or update
            $loan -> members ? $loan -> members() -> detach() : null;
            foreach ($req -> member_name_kh as $key => $value){
                // save member
                //insert to loan_member
                $member = new Member();
                $member -> name_kh = $value;
                $member -> name_en =$req->member_name_en[$key];
                $member -> save();
                DB::table('loan_members')->insert([
                    'loan_id'       => $loan -> id,
                    'member_id'     => $member -> id
                ]);
            }
        }
        return $loan;
    }

    public function getLoans($request, $paginate = true, $decution = false, $history = false)
    {
        $query = Loan::query();

        // if($decution){
        //     $query->where('status', '<>',LoanStatusEnum::FINISH);
        // }

        $query->when($request->branch_id && ($request->branch_id <> 'all'), function ($q) use ($request) {
            $q->where('branch_id', $request->branch_id);
        });


        $query->when($request->staff_id , function($q , $staff){
            $q->where('staff_id','=',$staff);
        });

        $fromDate = $request->from_date ? Carbon::createFromFormat('d/m/Y', $request->from_date)->format('Y-m-d') : null;
        $toDate = $request->to_date ? Carbon::createFromFormat('d/m/Y', $request->to_date)->format('Y-m-d') : null;

        $query->when($fromDate, function ($q) use ($fromDate) {
            $q->where('registration_date', '>=', $fromDate);
        });

        $query->when($toDate, function ($q) use ($toDate) {
            $q->where('registration_date', '<=', $toDate);
        });

        $query->when($request->name, function ($q) use ($request) {
            $name = mb_strtoupper(trim($request->name));
            $q->whereHas('client', function ($q) use ($name) {
                $q->where('name_kh', 'like', '%' . $name . '%');
                $q->orwhere('name_en', 'like', '%' . $name . '%');
            });
        });

        $query->when($request->interest_rate_id && strtolower($request->interest_rate_id) != 'all', function ($q) use ($request) {
            $q->where('interest_rate_id', $request->interest_rate_id);
        });
        if ($history){
            $query->where('status','=','finish');
        }else{
            $query->when($request->status && strtolower($request->status) != 'all', function ($q) use ($request) {
                $q->where('status', $request->status);
            });
        }

        $query->when($request->client_code, function ($q) use ($request) {
            $q->whereHas('client', function ($q) use ($request) {
                $q->where('code', $request->client_code);
            });
        });

        // $query->orderByRaw("FIELD(status,'pending') desc");

        $query->orderBy('registration_date', 'desc');
        if ($paginate) {
            return $query->paginate(env('PAGINATION'));
        }
        return $query->get();
    }
}
