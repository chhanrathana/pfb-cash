<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;

class Client extends BaseModel
{
    protected $table = "clients";
    protected $fillable = [
        'id',
        'code',
        'name_en',
        'name_kh',
        'date_of_birth',
        'phone_number',
        'is_new',
        'document_type_id',
        'document_number',
        'created_at',
        'updated_at',
        'deleted_at',
        'sex',
        'status',
        'user_id',
        'province_id',
        'district_id',
        'commune_id',
        'village_id',
        'branch_id',
    ];

    public static function boot()
    {
        parent::boot();

        if(env('APP_ENV') <> 'local'){
            if(auth()->user()->branch_id){
                static::addGlobalScope('branch_id', function (Builder $builder) {
                    $builder->where('clients.branch_id', auth()->user()->branch_id);
                });
            }
        }
    }

    public function getDateOfBirthAttribute($value)
    {
        return Carbon::parse($value)->format('d/m/Y');
    }

    public function setDateOfBirthAttribute($value)
    {
        $this->attributes['date_of_birth'] = Carbon::createFromFormat('d/m/Y', $value)->format('Y-m-d');
    }
    public function _guarantor()
    {
        return $this->belongsTo(Guarantor::class, 'guarantor', 'name');
    }

    public function village() {
        return $this->belongsTo(Village::class);
    }

    public function loans(){
        return $this->hasMany(Loan::class);
    }

    public function newLoans(){
        return $this->hasMany(Loan::class)->where('client_id' ,'>', 1);
    }

    public function isHasActiveLoan(){
        return $this->loans()->where('status','!=','finish')->count();
    }

    public function getAddressAttribute()
    {
        $village = Village::where('id', $this->village_id)->first();
        if(!$village){
            return '';
        }
        return
            '' . $village->name_kh
            . ',' . $village->commune->name_kh;
    }

    public function _sex()
    {
        return $this->belongsTo(Sex::class, 'sex', 'id');
    }
}
