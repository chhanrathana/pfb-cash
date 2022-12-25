<?php

namespace App\Models;

class LoanMember extends BaseModel
{
    protected $table = 'loan_members'; 

    public function loan() {
        return $this->belongsTo(Loan::class);
    }
}
