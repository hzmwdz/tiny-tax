<?php

namespace Hzmwdz\TinyTax\Models;

use Illuminate\Database\Eloquent\Model;

class Tax extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
        'rate',
    ];
}
