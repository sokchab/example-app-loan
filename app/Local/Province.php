<?php

namespace App\Local;

use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    protected $table = 'ln_province';
    protected $primaryKey = 'province_id';
    public $timestamps = false;

    protected $fillable = [
        'code',
        'province_en_name',
        'province_kh_name',
        'modify_date',
        'status',
        'user_id',
        'displayby',
        'branch_id'
    ];

    public function district()
    {
        return $this->hasMany(District::class, 'pro_id', 'province_id');
    }
}
