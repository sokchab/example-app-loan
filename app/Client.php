<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Params\Identify;
use App\Local\Village;

class Client extends Model
{
    protected $table = 'thi_clients';
    protected $primaryKey = 'id';
    //public $timestamps = false;
    // SELECT `id`, `full_name`, `khmer_name`, `gender`, `date_of_birth`, `id_type`, `id_number`, 
    // `occupation`, `group`, `home`, `street`, `phone`, `province`, `district`, `commune`, 
    // `village`, `join_loan`, `corporate_loan`, `created_at`, `updated_at` FROM `thi_clients` WHERE 1
    protected $fillable =[
        'first_name',
        'last_name',
        'gender',
        'dob',
        'first_name_en',
        'last_name_en',
        'it',
        'it_number',
        'it_date',
        'occupation',
        'group',
        'home',
        'company_name',
        'phone',
        'extra',
        'phone2',
        // 'commune',
        'village',
        // 'join_loan',
        // 'corporate_loan'
    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    // public function addresses()
    // {
    //     return $this->belongsTo(Params\Addresses::class, 'address', 'id');
    // }

    // public function occupations()
    // {
    //     return $this->belongsTo(Params\Occupation::class, 'occupation', 'id');
    // }


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
        return $this->last_name_en . ' ' . $this->first_name_en;
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

    public function Sex()
    {
        return $this->gender ? "ប្រុស" : "ស្រី";
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
