<?php

namespace App\Opts;

use Illuminate\Database\Eloquent\Model;
use App\Client as GuaJoin;
use App\Opts\CustJoin as Joi;
use App\Opts\CustGuaran as Gua;
use App\Opts\Customer as Cus;

class CusTmp extends Model
{
    //

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'cus_tmps';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;


    protected $fillable =[
        // 'first_name',
        // 'last_name',
        // 'name_en',
        // 'gender',
        // 'dob',
        // 'identify_type',
        // 'identify_no',
        // 'identify_register',
        // 'occupation',
        // 'phone',
        // 'occupation_address',
        // 'group',
        // 'home',
        // // 'street',
        // 'village',
        // 'is_active',
        // 'meta_field',
        // 'created_by',
        // 'key_ref',
        // 'cus_key',
        'numbers',
        'client',
        'join',
        'guarantee',
        'guarantee_join',
        'extra'
    ];

    public function getGuarantee()
    {
        return $this->belongsTo(Gua::class, 'guarantee', 'id');
    }

    public function getGuaranteeJoin()
    {
        return $this->belongsTo(GuaJoin::class, 'guarantee_join', 'id');
    }

    public function getJoin()
    {
        return $this->belongsTo(Joi::class, 'join', 'id');
    }    

    public function getClient()
    {
        return $this->belongsTo(Cus::class, 'client', 'id');
    }
}
