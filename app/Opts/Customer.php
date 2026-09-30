<?php

namespace App\Opts;

use Illuminate\Database\Eloquent\Model;
use App\Params\MaritalStatus;
use App\Params\Identify;
use App\Local\Village;
use App\User;
use App\Trans\Loan;

class Customer extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = "tbl_customer";


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable =[
        'first_name',
        'last_name',
        'first_name_en',
        'last_name_en',
        'gender',
        'dob',
        'identify_type',
        'identify_no',
        'identify_register',
        'occupation',
        'add_occupation',
        'phone',
        'phone2',
        'group',
        'home',
        // 'street',
        'village',
        'is_active',
        'meta_field',
        'created_by',
        'key_ref',
        'cus_key'
    ];

    public function fullName()
    {
        return $this->last_name . ' ' . $this->first_name;
    }

    public function Sex()
    {
        return $this->gender ? "ប្រុស" : "ស្រី";
    }

    public function fullNameEn()
    {
        return $this->last_name_en . " " . $this->first_name_en;
    }

    public function fullAddress()
    {
        return "
          ផ្ទះលេខ ". $this->home .",  
          ក្រុម/ផ្លូវលេខ ". $this->group .",  
          ភូមិ ". $this->getVillage->village_namekh .",  
          ឃុំ/សង្កាត់ ". $this->getVillage->commune->commune_namekh .", 
          ស្រុក/ខណ្ឌ/ក្រុង ". $this->getVillage->commune->district->district_namekh .", 
          ខេត្ត/រាជធានី ". $this->getVillage->commune->district->province->province_kh_name;
    }

    public function address()
    {
        return "
          ផ្ទះលេខ ". $this->home .",  
          ក្រុម/ផ្លូវលេខ ". $this->group .",  
           ". $this->getVillage->village_namekh .",  
           ". $this->getVillage->commune->commune_namekh .", 
           ". $this->getVillage->commune->district->district_namekh .", 
           ". $this->getVillage->commune->district->province->province_kh_name;
    }
    /**
     * Scope a query to only include Active
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeIsActive($query)
    {
        return $query->where('is_active', true);
    }

    public function getIdentify()
    {
        return $this->belongsTo(Identify::class, 'identify_type', 'id');
    }

    // public function getStatus()
    // {
    //     return $this->belongsTo(MaritalStatus::class, 'status', 'id');
    // }

    public function getVillage()
    {
        return $this->belongsTo(Village::class, 'village', 'vill_id');
    }    

    public function getCreatedBy()
    {
        return $this->belongsTo(App\User::class, 'created_by', 'id');
    }

    /**
     * Scope a query to only include byId
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeGetById($query, $id)
    {
        return $query->where('id', $id);
    }

    public function loans()
    {
        return $this->hasMany(Loan::class, 'client', 'id');
    }


    public function late_loan_histories()
    {
        return $this->hasMany('App\LateLoanHistory', 'client', 'id');
    }

    public function finish_loan_histories()
    {
        return $this->hasMany('App\FinishLoanHistory', 'client', 'id');
    }
}
