<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;

class Branch extends BaseModel
{
   
    protected $fillable = [
        'code',
        'name',
        'description',        
    ];    

    public static function boot()
    {
        parent::boot();
       
        if(env('APP_ENV') <> 'local'){
            if(auth()->user()->branch_id){
                static::addGlobalScope('id', function (Builder $builder) {
                    $builder->where('id', auth()->user()->branch_id);
                });
            }
        }        
    }  
}