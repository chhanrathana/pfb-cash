<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Guarantor extends Model
{
    protected $table = "guarantor";
    protected $fillable = [
        'id',
        'full_name',
        'sex',
        'date_of_birth',
        'document_type',
        'document_number',
        'phone_number',
        'province_id',
        'district_id',
        'commune_id',
        'village_id',
        'full_address_input',
        'created_at',
        'updated_at',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->id = Str::uuid();
        });
    }

    public function loans(){
        return $this -> belongsToMany(Loan::class,'loan_guarantor','guarantor_id','loan_id');
    }
}
