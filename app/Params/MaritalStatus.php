<?php

namespace App\Params;

use Illuminate\Database\Eloquent\Model;

class MaritalStatus extends Model
{
    protected $table = 'params_marital_statuses';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable =[
        'name',
        'name_kh',
    ];
}
