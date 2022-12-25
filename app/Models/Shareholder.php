<?php

namespace App\Models;

use Carbon\Carbon;

class Shareholder extends BaseModel
{

    protected $fillable = [
        'name_kh',
        'name_en',
        'earn_rate',  
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
        'sex',      
    ];

    public function deposit(){
        return $this->hasOne(Deposit::class, 'shareholder_id');
    }
    
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
}