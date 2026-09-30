<?php

namespace App\Params;

use Illuminate\Database\Eloquent\Model;

class Addresses extends Model
{
    protected $table = 'params_addresses';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable =[
        'home',
        'street',
        'phone',
        'province',
        'district',
        'commune',
        'village'
    ];

    public function client()
    {
        return $this->hasMany(App\Client::class, 'address', 'id');
    }
}

// $table->string('home', 100)->nullable();
// $table->string('street', 150)->nullable();
// $table->string('phone', 100)->nullable();
// $table->integer('province')->unsigned();
// $table->bigInteger('district')->unsigned();
// $table->bigInteger('commune')->unsigned();
// $table->bigInteger('village')->unsigned();
// $table->foreign('province')->references('province_id')->on('ln_province');
// $table->foreign('district')->references('dis_id')->on('ln_district');
// $table->foreign('commune')->references('com_id')->on('ln_commune');
// $table->foreign('village')->references('vill_id')->on('ln_village');