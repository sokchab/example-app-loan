<?php

namespace App\Trans\Bases;

use Illuminate\Database\Eloquent\Model;
use App\Trans\Bases\BankCashSheet;

class Bank extends Model
{
    protected $table = 'cash__banks';

    protected $primaryKey = 'bank_id';

    protected $fillable = ['bank_principle', 'bank_interest', 'bank_expenses'];


    public function getTransactions()
    {
        return $this->hasMany(BankCashSheet::class, 'bank_id', 'bank_id');
    }
}
