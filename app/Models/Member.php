<?php

namespace App\Models;


class Member extends BaseModel
{
    protected $table = "members";
    public $timestamps = false;

    protected $fillable = [
        'id',
        'name_kh',
        'name_en',
        'phone_number',
        'sex_id',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function loans(){
        return $this -> belongsToMany(Loan::class,'loan_members','member_id','loan_id');
    }
}
