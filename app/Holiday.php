<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Holiday extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'holidays';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'holiday',
        'year',
        'dsc',
        'extra'
    ];

    /**
     * Scope a query to only include isHoliday
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeIsHoliday($query, $day)
    {
        return $query->whereDate('holiday', $day);
    }


}
