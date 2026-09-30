<?php

namespace App\Trans;

use Illuminate\Database\Eloquent\Model;
use App\Opts\Customer;
use App\Trans\Loan;
use App\Opts\CustJoin;
use App\Opts\CustGuaran;

class LoanClients extends Model
{
    //

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'cus_loan';


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
    protected $fillable = ['client', 'loan', 'join_with', 'guaranteed'];


    public function getClient()
    {
        return $this->hasOne(Customer::class, 'client', 'id');
    }

    
    public function getLoan()
    {
        return $this->hasOne(Loan::class, 'loan', 'id');
    }

    
    public function getJoin()
    {
        return $this->hasOne(CustJoin::class, 'join_with', 'id');
    }

    
    public function getGuaranteed()
    {
        return $this->hasOne(CustGuaran::class, 'guaranteed', 'id');
    }
}
