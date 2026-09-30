<?php

namespace App\Local;

use Illuminate\Database\Eloquent\Model;

class Commune extends Model
{
    protected $table = 'ln_commune';
    protected $primaryKey = 'com_id';
    public $timestamps = false;

    protected $fillable = [
        'district_id',
        'code',
        'commune_name',
        'commune_namekh',
        'modify_date',
        'status',
        'user_id',
        'displayby',
        'branch_id'
    ];

    public function scopeByDistrict($query, $type)
    {
        return $query->where('district_id', $type);
    }

    public function district()
    {
        return $this->belongsTo(District::class, 'district_id', 'dis_id');
    }

    public function village()
    {
        return $this->hasMany(Village::class, 'commune_id', 'com_id');
    }
}
