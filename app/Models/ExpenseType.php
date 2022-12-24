<?php

namespace App\Models;

use Carbon\Carbon;

class ExpenseType extends BaseModel
{
   
    protected $fillable = [
        'name_kh',
    
    ];      

    public function getExpenseDatetimeAttribute($value)
    {
        return Carbon::parse($value)->format('d/m/Y H:i:s');
    }

    public function getExpenseDateAttribute($value)
    {
        return Carbon::parse($value)->format('d/m/Y');
    }
}