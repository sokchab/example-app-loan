<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Trans\Loan;

class Nests extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'nests';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['votes', 'loan_id', 'payment_id'];

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'nest_id';


    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;


    public function getLoan()
    {
        return $this->belongsTo(Loan::class, 'loan_id', 'id');
    }

    public function getPayment()
    {
        return $this->belongsTo('App\Raturnable\Payments', 'payment_id', 'id');
    }
}
