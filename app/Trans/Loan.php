<?php

namespace App\Trans;

use Illuminate\Database\Eloquent\Model;

use App\Client as GuaJoin;
use App\Opts\Customer;
use App\Trans\LoanCollateral;
use App\Opts\CustJoin;
use App\Opts\CustGuaran;

class Loan extends Model
{
    //

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'btl_loans';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'booking',
        'amount_price',
        'balance',
        'date_disburst',
        'loan_purple',
        'purple_dsc',
        'interest_rate',
        'rate_per',
        'term',
        'amount_pay',
        'pay_day',
        'pay_place',
        'acc_number',
        'status',
        'client',
        'join_with',
        'guaranteed',
        'guaranteed_join',
        'penalty',
        'jx_type',
        'gx_type',
        'gxj_type'
    ];

    public function getStatus($class=null)
    {
        if($this->status==1){
            return "<span class=\"badge bg-gradient-primary $class\">Active</span>";
        }else if($this->status==2){
            return "<span class=\"badge bg-gradient-navy $class\">Reject</span>";
        }else{
            return "<span class=\"badge bg-gradient-olive $class\">Finish</span>";
        }
    }

    public function getSchedules()
    {
        return $this->hasMany('App\Trans\Cols\Schedule', 'loan_id', 'id');
    }

    public function getPerOfFinish()
    {
        return number_format(100 - ($this->getCollection->sum('print_due_return')/$this->balance)*100);
    }

    public function getGuaranteedJoin()
    {
        return $this->belongsTo(GuaJoin::class, 'guaranteed_join', 'id');
    }

    public function getClient()
    {
        return $this->belongsTo(Customer::class, 'client');
    }

    
    public function getJoin()
    {
        return $this->belongsTo(CustJoin::class, 'join_with');
    }

    
    public function getGuaranteed()
    {
        return $this->belongsTo(CustGuaran::class, 'guaranteed');
    }

    public function getCollaterals()
    {
        return $this->hasMany(LoanCollateral::class, 'loan', 'id');
    }

    public function getCollection()
    {
        return $this->hasMany('App\Trans\Cols\CollectionSheet', 'loan', 'id');
    }

    public function scopeIsActive($query){
        return $query->where('status',"=", 1);
    }

    public function scopeIsFinish($query)
    {
        return $query->where('status', 3);
    }

    public function getNest()
    {
        return $this->hasOne('App\Nests', 'loan_id', 'id');
    }
}
