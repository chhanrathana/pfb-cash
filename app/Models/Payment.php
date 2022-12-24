<?php

namespace App\Models;

use Carbon\Carbon;
use App\Enums\PaymentStatusEnum;
use Illuminate\Database\Eloquent\Builder;

class Payment extends BaseModel
{

    protected $table = 'payments';

    public static function boot()
    {
        parent::boot();

        if(env('APP_ENV') <> 'local'){
            if(auth()->user()->branch_id){
                static::addGlobalScope('branch_id', function (Builder $builder) {
                    $builder->whereHas('loan', function($query){
                        $query->where('loans.branch_id', auth()->user()->branch_id);
                    });
                });
            }   
        }
    }

    public function getPaymentDateAttribute($value)
    {
        return Carbon::parse($value)->format('d/m/Y');
    }

    public function getLastPaymentPaidDateAttribute($value)
    {
        return Carbon::parse($value)->format('d/m/Y');
    }

    
    public function getStartPaymentDateAttribute($value)
    {
        return Carbon::parse($value)->format('d/m/Y');
    }

    public function getPendingAmountAttribute($value) {
        return $value <0 ?0:$value;
    }

    public function _status()
    {
        return $this->belongsTo(PaymentStatus::class, 'status');
    }

    public function loan() {
        return $this->belongsTo(Loan::class);
    }

    public function setStartPaymentDateAttribute($value)
    {
        $this->attributes['start_payment_date'] = Carbon::createFromFormat('d/m/Y', $value)->format('Y-m-d');
    }

    public function setDeductAmountAttribute($value){
        $this->attributes['deduct_amount'] = round($value, -2);
        // round($value, -2);
    }

    public function setInterestAmountAttribute($value)
    {
        $this->attributes['interest_amount'] = round($value, -2);
    }

    public function setCommissionAmountAttribute($value)
    {
        $this->attributes['commission_amount'] = round($value, -2);
    }

    public function isOverDate(){
         if($this->getRawOriginal('payment_date') < Carbon::now() && $this->status != PaymentStatusEnum::PAID){
             return true;
         }
         return false;
    }

    public function countLateDay(){
        // if($this->status == PaymentStatusEnum::LATE || $this->status == PaymentStatusEnum::PENDING){
        //     $paymentDate = Carbon::parse($this->getRawOriginal('payment_date'));
        //     $now = Carbon::now();
        //     if($paymentDate < $now){
        //         return $now->diff($paymentDate)->days;
        //     }
        //     return 0;
        // }
        // return '-';
        $paymentDate = Carbon::parse($this->getRawOriginal('payment_date'));
        $now = Carbon::now();
        if($paymentDate < $now){
            return $now->diff($paymentDate)->days;
        }
        return 0;
    }

    public function penaltyAmount($sort, $count){
        if(($sort/$count)  <= 0.7){
            return $this->pending_amount * 0.2;
        }
        return 0;
    }

    public function getTotalUnPaidAmount(){
        return ($this->total_amount - $this->total_paid_amount);
    }
}