<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Plans extends Model
{
    protected $table = "plans_to_do_list";

    protected $primaryKey = "plans_id";

    protected $fillable = [
        'dsc',
        'status'
    ];


    public function scopeFinish($query){
        return $query->where('status', true);
    }
}
