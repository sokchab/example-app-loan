<?php

namespace App\Local;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    protected $table = 'ln_district';
    protected $primaryKey = 'dis_id';
    public $timestamps = false;

    protected $fillable = [
        'pro_id',
        'code',
        'district_name',
        'district_namekh',
        'modify_date',
        'status',
        'user_id',
        'displayby',
        'branch_id'
    ];

    //return App\Local\District::byProvince(2)->get();
    public function scopeByProvince($query, $type)
    {
        return $query->where('pro_id', $type);
    }

    public function province()
    {
        return $this->belongsTo(Province::class, 'pro_id', 'province_id');
    }

    public function commune()
    {
        return $this->hasMany(Commune::class, 'district_id', 'dis_id');
    }
}
