<?php

namespace App\Params;

use Illuminate\Database\Eloquent\Model;

class Identify extends Model
{
    protected $table = 'params_identifies';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable =[
        'name',
        'name_kh',
    ];
}
