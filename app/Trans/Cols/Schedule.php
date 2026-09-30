<?php

namespace App\Trans\Cols;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'btl__schedules';


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
        'date_pay',
        'amount',
        'prin_due',
        'inter_due',
        'balance',
        'tag',
        'date_disburs',
        'loan_id'
    ];

    public function getLoan()
    {
        return $this->belongsTo('App\Trans\Loan', 'loan_id', 'id');
    }
}
