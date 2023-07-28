<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nation extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'flag',
        'enable_send',
        'enable_receive',
        'flagpng',
        'officalname',
        'region',
         'subregion'
    ];
}
