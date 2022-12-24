<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DocumentType extends Model
{
    protected $table = "document_type";
    protected $primaryKey = 'id';
    protected $keyType = "string";
    public $timestamps = false;
    protected $fillable = [
        'id',
        'name'
    ];
}
