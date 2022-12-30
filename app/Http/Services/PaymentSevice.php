<?php

namespace App\Http\Services;

use App\Models\Payment;
use Carbon\Carbon;
use App\Models\InterestRate;
use App\Enums\PaymentStatusEnum;
use App\Enums\InterestEnum;
use App\Models\Calendar;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;

class PaymentSevice {

    // for dialy loan
    public function updateInterestRate($type, $rate, $commissionRate = 0){
        $interest = InterestRate::where('code', $type)->first();
        $interest->rate = $rate;
        $interest->commission_rate = $commissionRate?$commissionRate:0;
        $interest->save();
    }

    public function removePayments($laonId){
        Payment::where('loan_id', $laonId)->delete();
    }

    public function createPayment_($term, $loan)
    {
        $fixedAmount = ($loan->principal_amount / $term);
        $interest = InterestRate::find($loan->interest_rate_id);
        $pendingAmount = $loan->principal_amount;
        $paymentDate = Carbon::createFromFormat('d/m/Y', $loan->registration_date)->format('Y-m-d');

        // commision amount is fixed for all transaction
        $commisonAmount = ($loan->principal_amount * ($interest->commission_rate / 100));
        $startPaymentDate = $loan->registration_date;

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
                    }
                    elseif (Carbon::parse($date)->format('Y-m-d') < Carbon::parse($date)->addDays($interest->interval)->format('Y-m-26')) {
                        $calculateDate = Carbon::parse($date)->addDays($interest->interval)->format('Y-m-26');
                    }
                    if($i == 1){
                        echo '<br/> calculateDate Error || '.$i .' '.$calculateDate;
                    }else{
                        echo '<br/> calculateDate || '.$i .' '.$calculateDate;
                    }

                }else{
                    $calculateDate = Carbon::parse(Carbon::createFromFormat('d/m/Y', $startPaymentDate)->format('Y-m-d'))->addDays($interest->interval);
                }
                $paymentDate = $this->getValidDate($calculateDate, $interest->interval);
                $interval = $this->countDay($startPaymentDate, $paymentDate);
                $commisonAmount = ($loan->principal_amount * ($interest->commission_rate / 100));
            }
            echo '<br/> paymentDate || '.$i.' '.$paymentDate;
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
            if ($loan->interest->code == InterestEnum::HALF_MONTHLY) {
                if($calculateDate){
                    $startPaymentDate = Carbon::parse($calculateDate)->format('d/m/Y');
                }else{
                    $startPaymentDate = $payment->payment_date;
                }
            }

        }
        exit;
        return $payment;
    }

    public function createPayment($term, $loan)
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

    public function createPaymentDailyLoan($term, $loan)
    {
        $fixedAmount = roundCurrency(ceil($loan->principal_amount / $term));
        $interest = InterestRate::find($loan->interest_rate_id);
        $pendingAmount = $loan->principal_amount;
        $paymentDate = Carbon::createFromFormat('d/m/Y', $loan->registration_date)->format('Y-m-d');
        // commision amount is fixed for all transaction
        $commisonAmount = ($loan->principal_amount * ($interest->commission_rate / 100));
        $startPaymentDate = $loan->registration_date; //  28/12/2022

        for ($i = 0; $i < $term; $i++) {
            $calculateDate = null;

            if($i == 0){
                $paymentDate = Carbon::parse(Carbon::createFromFormat('d/m/Y', $loan->started_payment_date)->format('Y-m-d'));
                $interval = $this->countDay($startPaymentDate, $paymentDate);
                $commisonAmount =  ($loan->principal_amount * ($interest->commission_rate / 100 / $interest->interval));
            }else{

                $calculateDate = Carbon::parse(Carbon::createFromFormat('d/m/Y', $startPaymentDate)->format('Y-m-d'))->addDays($interest->interval);

                $paymentDate = $this->getValidDate($calculateDate, $interest->interval);
                $paymentDate = Carbon::parse(Carbon::createFromFormat('d/m/Y', $paymentDate)->format('Y-m-d'));
                $interval = $this->countDay($startPaymentDate, $paymentDate);

                $commisonAmount = ($loan->principal_amount * ($interest->commission_rate / 100));
            }

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

            $payment->interest_amount = $loan->principal_amount * ($loan->rate / 100 / $interest->interval);
            $payment->commission_amount = $commisonAmount;
            $payment->total_amount = ($payment->deduct_amount + $payment->interest_amount + $payment->commission_amount);
            $payment->save();

            $pendingAmount = $payment->pending_amount - $payment->deduct_amount;
            $startPaymentDate = $payment->payment_date;
        }

        return $payment;
    }

    public function updatePenaltyAmount ($payments, $countPayment){
        if($payments){
            foreach ($payments as $payment){
                $penaltyAmount = $payment->penaltyAmount($payment->sort, $countPayment);
                $update = Payment::where('id', $payment->id)->first();
                $update->penalty_amount = $penaltyAmount;
                $update->save();
             }
        }
    }

    public function updatePaymentDate($id, $paymentDate){

        $payment = Payment::find($id);
        $payment->payment_date = $paymentDate;
        $payment->interval = $this->countDay($payment->start_payment_date, $paymentDate);
        $payment->interest_amount = $payment->interval * $payment->cross_amount * (($payment->loan->rate / 100) / $payment->loan->interest->interval);
        $payment->total_amount = ($payment->deduct_amount + $payment->interest_amount + $payment->commission_amount);
        $payment->save();

        $payments = Payment::where('loan_id', $payment->loan_id)
            ->where('payment_date','>=', $paymentDate)
            ->orderBy('payment_date', 'asc')
            ->get();
        // update payment amount next day
        for ($i = 0; $i < count($payments); $i++) {
            if (isset($payments[$i + 1])) {
                $_payment = Payment::find($payments[$i + 1]['id']);
                $_payment->start_payment_date = $payments[$i]['payment_date'];
                $_payment->interval = $this->countDay($payments[$i]['payment_date'], $_payment->getRawOriginal('payment_date'));
                $_payment->interest_amount = $_payment->interval * $_payment->cross_amount * (($payment->loan->rate / 100) / $payment->loan->interest->interval);
                $_payment->total_amount = ($_payment->deduct_amount + $_payment->interest_amount + $_payment->commission_amount);
                $_payment->save();
            }
        }

        return $payment;
    }

    private function countDay($startPaymentDate, $paymentDate)
    {

        $paymentDate = Carbon::parse(Carbon::parse($paymentDate)->format('Y-m-d'));

        $now = Carbon::parse(Carbon::createFromFormat('d/m/Y', $startPaymentDate)->format('Y-m-d')) ;

        return $now->diff($paymentDate)->days;
    }

    // move to next or previous date if on weekend
    private function getValidDate($date, $interval){
        // $loans = Payment::where('loan_id', '5ac39ce0-ce2c-4703-9dad-8cc321de6e2f')->get();

        $dateOfWeek = Carbon::parse($date)->dayOfWeek;
        // 0 Sunday 1 Mony = 1, 6 Saturday
        if ($dateOfWeek == '6') {

            if($interval == 1){
                // Monday for dialy loan
                $date = Carbon::parse($date)->addDay(2);
            }else{
                // Friday
                $date = Carbon::parse($date)->subDay(1);
            }
        }

        else if ($dateOfWeek == '0') {
            // Monday
            $date = Carbon::parse($date)->addDay(1);
        }

        $query = Calendar::where('date', '>=', $date);
        $query->where([
            ['is_weekend', 0],
            ['is_holiday', 0]
        ]);
        $query->orderBy('date', 'asc');
        $calendar = $query->first();
        if($calendar){
            return $calendar->date;
        }
        return $date;
    }

    public function getInterestPayments($request, $paymeneDate, $paginate = true, $print = false)
    {
        $query = Payment::query();
        $query->whereHas('loan');

        if($print){
            $query->select([
                'loan_id',
                // 'status',
                DB::raw('min(payment_date) as payment_date'),
                DB::raw('min(last_payment_paid_date) as last_payment_paid_date'),
                DB::raw('max(sort) as sort'),
                DB::raw('sum(deduct_amount) as deduct_amount'),
                DB::raw('sum(deduct_paid_amount) as deduct_paid_amount'),
                DB::raw('sum(interest_amount) as interest_amount'),
                DB::raw('sum(commission_amount) as commission_amount'),
                DB::raw('sum(total_amount) as total_amount'),
                DB::raw('sum(total_paid_amount) as total_paid_amount'),
                DB::raw('sum(pending_amount) as pending_amount'),
                DB::raw('sum(cross_amount) as cross_amount')]
            );
        }

        $query->when($request->branch_id && ($request->branch_id <> 'all'), function ($q) use ($request) {
            $q->whereHas('loan', function ($q) use ($request) {
                $q->where('branch_id', $request->branch_id);
            });
        });

        $query->where('status','<>', PaymentStatusEnum::FINISH);
        $query->when($paymeneDate, function ($q) use ($paymeneDate) {
            $paymeneDate = Carbon::parse(Carbon::createFromFormat('d/m/Y', $paymeneDate)->format('Y-m-d'));
            $q->where('payment_date', '<=',$paymeneDate);
        });

        $query->when($request->name, function ($q) use ($request) {
            $name = mb_strtoupper(trim($request->name));
            $q->whereHas('loan.client', function ($q) use ($name) {
                $q->where('name_kh', 'like', '%' . $name . '%');
                $q->orwhere('name_en', 'like', '%' . $name . '%');
            });
        });

        $query->when($request->interest_rate_id && strtolower($request->interest_rate_id) != 'all', function ($q) use ($request) {
            $q->whereHas('loan', function ($q) use ($request) {
                $q->where('interest_rate_id', $request->interest_rate_id);
            });
        });

        $query->when($request->staff_id && strtolower($request->staff_id) != 'all', function ($q) use ($request) {
            $q->whereHas('loan', function ($q) use ($request) {
                $q->where('staff_id', $request->staff_id);
            });
        });

        if($request->status){
            $query->when($request->status && strtolower($request->status) != 'all', function ($q) use ($request) {
                $q->where('status', $request->status);
            });
        }else{
            $query->where('status', '<>', PaymentStatusEnum::PAID);
        }

        $query->when($request->​client_code, function ($q) use ($request) {
            $q->whereHas('loan.client', function ($q) use ($request) {
                $q->where('code', $request->​client_code);
            });
        });

        if($print){
            $query->groupBy(
                'loan_id',
                // 'status'
            );
        }

        $query->orderBy('payment_date', 'asc');
        if ($paginate) {
            return $query->paginate(env('PAGINATION'));
        }
        $records = $query->get();
        // dd($records->toArray());
        return $records;
    }
}
