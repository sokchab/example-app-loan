<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LateLoanHistory extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'late_loan_histories';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['client', 'sheet', 'loan'];

    public function getClient()
    {
        return $this->belongsTo('App\Opts\Customer', 'client', 'id');
    }

    public function getSheet()
    {
        return $this->belongsTo('App\Trans\Cols\CollectionSheet', 'sheet', 'id');
    }

    
}
