<?php

namespace App\ViewDB;

use Illuminate\Database\Eloquent\Model;

class CustomerView extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = '__view_customer__';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        '__id__',
        '__name__',
        '__name_en__',
        '__gender__',
        '__dob__',
        '__key__',
        '__created__',
        '__updated__',
        '__active__',
    ];

    /**
     * Scope a query to only include Active
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive($query)
    {
        return $query->where('__active__', true);
    }
}
