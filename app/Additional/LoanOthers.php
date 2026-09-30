<?php

namespace App\Additional;

use Illuminate\Database\Eloquent\Model;

class LoanOthers extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'v2_addi_loan_others';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'key';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'gender',
        'dob',
        'phone',
        'description',
        'amount',
        'payment_date',
        'status'
    ];

    public function payments(){
        return $this->hasMany(LoanPayments::class, "v2_addi_loan_others");
    }
}
