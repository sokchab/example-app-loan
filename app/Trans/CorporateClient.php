<?php

namespace App\Trans;

use Illuminate\Database\Eloquent\Model;

class CorporateClient extends Model
{
    protected $table = 'corporate_clients';
    protected $primaryKey = 'id';

    protected $fillable =[
        'full_name',
        'khmer_name',
        'gender',
        'date_of_birth',
        'marital_status',
        'id_type',
        'id_number',
        'id_date',
        'occupation',
        'join_type',
        'group',
        'home',
        'street',
        'phone',
        'province',
        'district',
        'commune',
        'village'
    ];
}
