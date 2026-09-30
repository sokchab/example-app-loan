<?php

namespace App\Trans;

use Illuminate\Database\Eloquent\Model;

class ColTmp extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'col_tmps';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'model', 
        'color', 
        'body', 
        'marchine', 
        'year', 
        'iden', 
        'extra', 
        'type'
    ];
    
}


// $table->string('model');
// $table->string('color');
// $table->string('body');
// $table->string('marchine');
// $table->string('year');
// $table->string('iden');