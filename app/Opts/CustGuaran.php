<?php

namespace App\Opts;

use Illuminate\Database\Eloquent\Model;

use App\Params\MaritalStatus;
use App\Params\Identify;
use App\Local\Village;

class CustGuaran extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'cust_guarans';


    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'last_name_en',
        'first_name_en',
        'gender',
        'dob',
        'it',
        'it_no',
        'it_date',
        'occupation',
        'phone',
        'phone2',
        'occ_address',
        'group',
        'home',
        'meta_tag',
        'village'
    ];

    public function getIdentify()
    {
        return $this->belongsTo(Identify::class, 'it', 'id');
    }

    // public function getStatus()
    // {
    //     return $this->belongsTo(MaritalStatus::class, 'status', 'id');
    // }

    public function getVillage()
    {
        return $this->belongsTo(Village::class, 'village', 'vill_id');
    }    

    public function fullName()
    {
        return $this->last_name . ' ' . $this->first_name;
    }

    public function fullNameEn()
    {
        return $this->last_name_en . " " . $this->first_name_en;
    }

    public function Sex()
    {
        return $this->gender ? "ប្រុស" : "ស្រី";
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
}
