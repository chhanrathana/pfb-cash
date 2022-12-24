<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;

class ExpenseItem extends BaseModel
{
   
    protected $fillable = [
        'branch_id',
        'expense_type_id',
        'expense_amount',
        'description',
        'expense_datetime'
    ];      

    public static function boot()
    {
        parent::boot();
        
        if(env('APP_ENV') <> 'local'){
            if(auth()->user()->branch_id){
                static::addGlobalScope('branch_id', function (Builder $builder) {
                    $builder->where('branch_id', auth()->user()->branch_id);
                });
            }   
        }        
    }

    public function getExpenseDatetimeAttribute($value)
    {
        return Carbon::parse($value)->format('d/m/Y H:i:s');
    }

    public function getExpenseDateAttribute($value)
    {
        return Carbon::parse($value)->format('d/m/Y');
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class,'branch_id');
    }

    public function type()
    {
        return $this->belongsTo(ExpenseType::class,'expense_type_id');
    }

}