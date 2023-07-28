<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exchange extends Model
{
    use HasFactory;
    protected $fillable = [
        'sendCountry_id',
        'sendCountryCurrancy',
        'receiveCountry_id',
        'receiveCountryCurrancy',
        'staticrate',
        'customrate',
        'factor',
        'finalrate',
        'flag'
    ];

    
}
