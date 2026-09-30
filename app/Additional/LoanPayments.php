<?php

namespace App\Additional;

use Illuminate\Database\Eloquent\Model;

class LoanPayments extends Model
{
    protected $table = "v2_loan_payments";
    protected $primaryKey = "id";
    protected $fillable = [
        "amount",
        "v2_addi_loan_others",
        "paid_by"
    ];

    public function loan(){
        return $this->belongsTo(LoanOthers::class, "v2_addi_loan_others");
    }
}
