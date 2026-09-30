<?php

namespace App\Trans;

use Illuminate\Database\Eloquent\Model;
use App\Trans\Loan;

class LoanCollateral extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'loan__collaterals';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'model', 
        'color', 
        'body', 
        'marchine', 
        'year', 
        'iden', 
        'extra',
        'loan',
        'type'
    ];


    public function getLoan()
    {
        return $this->belongsTo(Loan::class, 'loan', 'id');
    }

}
