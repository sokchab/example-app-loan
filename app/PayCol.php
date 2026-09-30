<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PayCol extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'pay_cols';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['base', 'second', 'tmp'];

    public function Collections()
    {
        return $this->hasMany('App\Trans\Cols\CollectionSheet', 'pay_col_id', 'id');
    }

}
