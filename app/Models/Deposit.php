<?php

namespace App\Models;

class Deposit extends BaseModel
{
   
    protected $fillable = [
        'deposit_datetime',
        'deposit_amount',
        'shareholder_id',        
        'branch_id',
    ];
    
    public function shareholder(){
        return $this->belongsTo(Shareholder::class, 'shareholder_id');
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class,'branch_id');
    }
}