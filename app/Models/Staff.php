<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;

class Staff extends BaseModel
{

    protected $table = 'staffs';

    public static function boot()
    {
        parent::boot();

        if(env('APP_ENV') <> 'local'){
            if(auth()->user()->branch_id){
                static::addGlobalScope('branch_id', function (Builder $builder) {
                    $builder->where('staffs.branch_id', auth()->user()->branch_id);
                });
            }
        }
    }

    protected $fillable = [
        'id',
        'name_en',
        'name_kh',
        'date_of_birth',
        'phone_number',
        'start_work_date',
        'born_place',
        'document_type',
        'document_number',
        'emergency_number',
        'current_place',
        'created_at',
        'updated_at',
        'deleted_at',
        'status',
        'sex',
        'branch_id',
    ];

    public function setDateOfBirthAttribute($value){
        $this->attributes['date_of_birth'] =  Carbon::createFromFormat('d/m/Y', $value)->format('Y-m-d');
    }

    public function setStartWorkDateAttribute($value)
    {
        $this->attributes['start_work_date'] = Carbon::createFromFormat('d/m/Y', $value)->format('Y-m-d');
    }

    public function getDateOfBirthAttribute($value)
    {
        return Carbon::parse($value)->format('d/m/Y');
    }

    public function getStartWorkDateAttribute($value)
    {
        return Carbon::parse($value)->format('d/m/Y');
    }

    public function _sex()
    {
        return $this->belongsTo(Sex::class, 'sex', 'id');
    }

    public function _status()
    {
        return $this->belongsTo(StaffStatus::class, 'status', 'id');
    }

    public function _loans($fromDate, $toDate ){
        return $this->hasMany(Loan::class,'staff_id','id')
            ->where('registration_date','>=' , $fromDate)
            ->where('registration_date','<=', $toDate);
    }

    public function loans()
    {
        return $this->hasMany(Loan::class)->with('client','payments');
    }

    public function payments()
    {
        return $this->hasManyThrough(Payment::class, Loan::class);
    }

    public function countPaymentLate()
    {
        return $this->hasManyThrough(Payment::class, Loan::class)->where('payments.status', 'late')->distinct('loan_id')->count('loan_id');
    }

    public function sumPaymentLate()
    {
        $total =  $this->hasManyThrough(Payment::class, Loan::class)->where('payments.status', 'late')->sum('total_amount');
        $paid =  $this->hasManyThrough(Payment::class, Loan::class)->where('payments.status', 'late')->sum('total_paid_amount');
        return $total - $paid;
    }

    public function sumPendingAmount()
    {
        return $this->hasManyThrough(Payment::class, Loan::class)
        ->where('payments.status','<>', 'paid')
        ->where('payments.status','<>' ,'finish')
        ->sum('deduct_amount');
    }

    public function coutNewClient()
    {
        return $this->hasMany(Loan::class)->with('client','payments');
    }

    public function branch(){
        return $this->belongsTo(Branch::class);
    }

    public function documentTypeName(){
        return $this -> belongsTo(DocumentType::class,'document_type','id');
    }
}
