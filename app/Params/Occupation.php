<?php

namespace App\Params;

use Illuminate\Database\Eloquent\Model;

class Occupation extends Model
{
    protected $table = 'params_occupations';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable =[
        'name',
        'name_kh'
    ];

    public function client()
    {
        return $this->hasMany(App\Client::class, 'occupation', 'id');
    }
}


// Schema::create('params_occupations', function (Blueprint $table) {
//     $table->tinyInteger('id')->increment();
//     $table->string('name', 100);
//     $table->string('name_kh', 150);
// });