<?php

namespace App\Models;

use Carbon\Carbon;
use App\Enums\InterestEnum;
use Illuminate\Database\Eloquent\Builder;
use SethaThay\NumberToKhmerWords\NumberToKhmerWords;

class Loan extends BaseModel
{
    protected $table = 'loans';

    protected $fillable = [
        'id',
        'code',
        'principal_amount',
        'term',
        'pending_amount',
        'last_pending_amount',
        'rate',
        'commission_rate',
        'registration_date',
        'started_payment_date',
        'last_payment_date',
        'finish_payment_date',
        'finish_discount',
        'finish_discount_amount',
        'admin_rate',
        'admin_amount',
        'purpose',
        'status',
        'client_id',
        'staff_id',
        'interest_rate_id',
        'branch_id'
    ];

    public static function boot()
    {
        parent::boot();

        if(env('APP_ENV') <> 'local'){
            if(auth()->user()->branch_id){
                static::addGlobalScope('branch_id', function (Builder $builder) {
                    $builder->where('loans.branch_id', auth()->user()->branch_id);
                });
            }
        }
    }

    public function setRegistrationDateAttribute($value)
    {
        $this->attributes['registration_date'] = $value ? Carbon::createFromFormat('d/m/Y', $value)->format('Y-m-d') : null;
    }

    public function setStartedPaymentDateAttribute($value)
    {
        $this->attributes['started_payment_date'] = $value ? Carbon::createFromFormat('d/m/Y', $value)->format('Y-m-d') : null;
    }

    // public function setFinishPaymentDateAttribute($value)
    // {
    //     $this->attributes['finish_payment_date'] = $value ? Carbon::createFromFormat('d/m/Y', $value)->format('Y-m-d') : null;
    // }

    public function getRegistrationDateAttribute($value)
    {
        return Carbon::parse($value)->format('d/m/Y');
    }

    public function getLastPaymentDateAttribute($value)
    {
        $payment = Payment::where('loan_id', $this->id)
        ->orderBy('payment_date', 'desc')->first(['payment_date']);
        if($payment){
            return $payment->payment_date;
        }
        return Carbon::parse($value)->format('d/m/Y');
    }

    public function getStartedPaymentDateAttribute($value)
    {
        return Carbon::parse($value)->format('d/m/Y');
    }

    public function client(){
        return $this->belongsTo(Client::class, 'client_id');
    }

    public function staff()
    {
        return $this->belongsTo(Staff::class, 'staff_id');
    }

    public function interest()
    {
        return $this->belongsTo(InterestRate::class,'interest_rate_id');
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class,'branch_id');
    }

    public function _status()
    {
        return $this->belongsTo(LoanStatus::class, 'status');
    }

    public function payments()
    {
        return $this->hasMany(Payment::class)->orderBy('sort');
    }

    public function has_paid_payments(){
        return $this->hasMany(Payment::class)->whereNotNull('last_payment_paid_date')->orderBy('sort');
    }

    public function getPendingAmountAttribute($value)
    {
        return $value < 0 ? 0 : $value;
    }

    public function editUrl(){

        if($this->interest->code == InterestEnum::DAILY){
            return route('loan.daily.edit', ['id' => $this->id]);
        }
        elseif($this->interest->code == InterestEnum::WEEKLY){
            return route('loan.weekly.edit', ['id' => $this->id]);
        }
        elseif ($this->interest->code == InterestEnum::TWICE_WEEKLY) {
            return route('loan.twice-weekly.edit', ['id' => $this->id]);

        }
        return route('loan.half-monthly.edit', ['id' => $this->id]);
    }

    public function principal_amount_as_word(){
        $word = new NumberToKhmerWords();
        return $word->show($this->principal_amount);
    }
    public function guarantors(){
        return $this->belongsToMany(Guarantor::class, 'loan_guarantor','loan_id','guarantor_id');
    }

    public function members(){
        return $this -> belongsToMany(Member::class,'loan_members','loan_id','member_id');
    }

    public function validMembers(){
        return $this -> members()->whereNotNull('name_kh')->get();
    }

    public function totalMembers(){
        return count( $this -> validMembers()) + 1; // plus មេក្រុម
    }
    public function firstGuarantor(){
        return $this->belongsToMany(Guarantor::class, 'loan_guarantor','loan_id','guarantor_id')->where('remark','=','first_guarantor');
    }

    public function secondGuarantor(){
        return $this->belongsToMany(Guarantor::class, 'loan_guarantor','loan_id','guarantor_id')->where('remark','=','second_guarantor');
    }

    public function type(){
        return $this -> belongsTo(LoanType::class,'loan_type_id','id');
    }
}
