<?php

namespace App\Local;

use Illuminate\Database\Eloquent\Model;

class Village extends Model
{
    protected $table = 'ln_village';
    protected $primaryKey = 'vill_id';
    public $timestamps = false;

    protected $fillable = [
        'commune_id',
        'code',
        'village_name',
        'village_namekh',
        'displayby',
        'modify_date',
        'status',
        'user_id'
    ];

    public function scopeByCommune($query, $type)
    {
        return $query->where('commune_id', $type);
    }

    public function commune()
    {
        return $this->belongsTo(Commune::class, 'commune_id', 'com_id');
    }
}
