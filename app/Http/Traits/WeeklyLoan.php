<?php

namespace App\Http\Traits;

use App\Enums\ClientStatusEnum;
use App\Enums\InterestEnum;
use App\Enums\LoanStatusEnum;
use App\Enums\PaymentStatusEnum;
use App\Models\Client;
use App\Models\Guarantor;
use App\Models\InterestRate;
use App\Models\Loan;
use App\Models\Member;
use App\Models\Payment;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

trait WeeklyLoan
{

    protected function checkClient($req)
    {
        $client = Client::where(DB::raw('trim(lower(name_en))'), '=', Str::lower(trim($req->loaner_name_en)))
            ->where('village_id', $req->loaner_village_id)
            ->first();
        if ($client && ($req->client_id == $client->id)) {
            return false;
        }
        return $client;
    }

    protected function createClient($req){
        $client = Client::find($req->client_id);
        if(!$client){
            $client = new Client();
            $client->code = $this->getLatestCode('clients');
            // new client is client do new loan first time
            $client->is_new = 1;
        }else{
            $client->is_new = 0;
        }
        $client -> name_en = $req->loaner_name_en;
        $client -> name_kh = $req->loaner_name_kh;
        $client -> date_of_birth = $req->loaner_date_of_birth;
        $client -> phone_number = $req -> loaner_phone_number;
        $client -> document_type_id = $req -> loaner_document_type;
        $client -> document_number = $req -> loaner_document_number;
        $client -> sex = $req -> loaner_sex;
        $client -> province_id = $req -> loaner_province_id;
        $client -> district_id = $req -> loaner_district_id;
        $client -> commune_id = $req -> loaner_commune_id;
        $client -> village_id = $req -> loaner_village_id;
        $client->user_id = auth()->user()->id??null;
        $client->branch_id = $req->branch_id;
        $client->status = ClientStatusEnum::ACTIVE;
        $client->save();
        return $client;
    }

    protected function updateInterestRate($type, $rate, $commissionRate = 0){
        $interest = InterestRate::where('code', $type)->first();
        $interest->rate = $rate;
        $interest->commission_rate = $commissionRate?:0;
        $interest->save();
    }

    protected function createLoan($req, $clientId, $type)
    {
        $interest = InterestRate::where('code', $type )->first();

        $loan = Loan::find($req->loan_id);
        $registrationDate = Carbon::createFromFormat('d/m/Y', $req->registration_date)->format('Y-m-d');
        if (!$loan) {
            $loan = new Loan();
            $loan->code = $this->getLatestCode('loans');
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
        $loan->client_id = $clientId;
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

    protected function createPayment($term, $loan)
    {
        $fixedAmount = ($loan->principal_amount / $term);
        $interest = InterestRate::find($loan->interest_rate_id);
        $pendingAmount = $loan->principal_amount;
        $paymentDate = Carbon::createFromFormat('d/m/Y', $loan->registration_date)->format('Y-m-d');
        $startedPaymentDate = Carbon::createFromFormat('d/m/Y', $loan->started_payment_date)->format('Y-m-d');
        $defaultDayOfWeek = Carbon::parse($startedPaymentDate)->dayOfWeek;

        // echo $day = Carbon::parse($startedPaymentDate)->format('D');

        // echo $startedPaymentDate.' '. $defaultDayOfWeek;exit;
        // commision amount is fixed for all transaction
        $commisonAmount = ($loan->principal_amount * ($interest->commission_rate / 100));
        $startPaymentDate = $loan->registration_date;
        $date = null;
        $diff = null;
        for ($i = 0; $i < $term; $i++) {
            $calculateDate = null;

            if($i == 0){
                $paymentDate = Carbon::parse(Carbon::createFromFormat('d/m/Y', $loan->started_payment_date)->format('Y-m-d'));
                $interval = $this->countDay($startPaymentDate, $paymentDate);
                $commisonAmount = $interval * ($loan->principal_amount * ($interest->commission_rate / 100 / $interest->interval));
            }else{
                if ($loan->interest->code == InterestEnum::HALF_MONTHLY) {
                    $date = Carbon::parse(Carbon::createFromFormat('d/m/Y', $startPaymentDate)->format('Y-m-d'));
                    if(Carbon::parse($date)->format('Y-m-d') < Carbon::parse($date)->addDays($interest->interval)->format('Y-m-11')){
                        $calculateDate = Carbon::parse($date)->addDays($interest->interval)->format('Y-m-11');
                        $date_ = Carbon::parse($date);
                        $calculateDate_ = Carbon::parse($calculateDate);
                        $diff = $date_->diffInDays($calculateDate_);
                        // hadle on 11 is starturedy
                        if($diff <= 1){
                            $calculateDate = Carbon::parse($date)->addDays($interest->interval)->format('Y-m-26');
                        }

                    }
                    elseif (Carbon::parse($date)->format('Y-m-d') < Carbon::parse($date)->addDays($interest->interval)->format('Y-m-26')) {
                        $calculateDate = Carbon::parse($date)->addDays($interest->interval)->format('Y-m-26');
                    }
                }else{
                    $calculateDate = Carbon::parse(Carbon::createFromFormat('d/m/Y', $startPaymentDate)->format('Y-m-d'))->addDays($interest->interval);
                }
                $paymentDate = $this->getValidDate($calculateDate, $interest->interval);
                $interval = $this->countDay($startPaymentDate, $paymentDate);
                $commisonAmount = ($loan->principal_amount * ($interest->commission_rate / 100));


            }
            // echo '<br/>$paymentDate || '.$i.' >> calculateDate '.$calculateDate.' >> paymentDate '.$paymentDate.' >> date '.$date.' $diff '.$diff;
            $payment = new Payment();
            $payment->status = PaymentStatusEnum::PENDING;
            $payment->loan_id = $loan->id;
            $payment->start_payment_date = $startPaymentDate;
            $payment->payment_date = $paymentDate;
            $payment->sort = ($i + 1);
            $payment->deduct_amount = $fixedAmount;
            $payment->pending_amount = $pendingAmount;
            $payment->cross_amount = $pendingAmount;
            $payment->interval = $interval;

            if ($loan->interest->code == InterestEnum::DAILY) {
                $payment->interest_amount = $payment->interval * $loan->principal_amount * ($loan->rate / 100 / $interest->interval);
            } else {
                $payment->interest_amount = $payment->interval * $payment->pending_amount * ($loan->rate / 100 / $interest->interval);
            }

            $payment->commission_amount = $commisonAmount;
            $payment->total_amount = ($payment->deduct_amount + $payment->interest_amount + $payment->commission_amount);
            $payment->save();

            $pendingAmount = $payment->pending_amount - $payment->deduct_amount;
            $startPaymentDate = $payment->payment_date;

            // adjust day of week to defualt day after change from holidy
            if($i > 0){
                $startPaymentDateAdjust = Carbon::createFromFormat('d/m/Y', $startPaymentDate);
                $startedPaymentDayWeek = Carbon::parse($startPaymentDateAdjust)->dayOfWeek;
                if($defaultDayOfWeek > $startedPaymentDayWeek){
                    $startPaymentDate = Carbon::parse($startPaymentDateAdjust)->addDays($defaultDayOfWeek - $startedPaymentDayWeek)->format('d/m/Y');
                }elseif($defaultDayOfWeek < $startedPaymentDayWeek){
                    $startPaymentDate = Carbon::parse($startPaymentDateAdjust)->subDays($startedPaymentDayWeek - $defaultDayOfWeek)->format('d/m/Y');
                }
            }

            if ($loan->interest->code == InterestEnum::HALF_MONTHLY) {
                if($calculateDate){
                    $startPaymentDate = Carbon::parse($calculateDate)->format('d/m/Y');
                }else{
                    $startPaymentDate = $payment->payment_date;
                }
            }
        }

        return $payment;
    }

    private function getLatestCode($table,$column="code"){
        $count= DB::table($table)->max($column);
        $code = $count +1;
        return str_pad($code, 5, '0', STR_PAD_LEFT);
    }
}
