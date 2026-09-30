<?php

namespace App\Raturnable;

use App\Trans\Cols\CollectionSheet;
use Illuminate\Database\Eloquent\Model;
use App\User;

class Payments extends Model
{
    protected $table = "return__payments";

    protected $fillable = [
        'Principal',
        'Interest',
        'Penalty',
        'LoanCollection',
        'user_id',
        'paid_date',
        'paid_by',
        'other'
    ];

    public function getCollection(){
        return $this->belongsTo(CollectionSheet::class, 'LoanCollection', 'id');
    }

    public function getUser()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function hasPaid()
    {
        return $this->Principal + $this->Interest + $this->Penalty;
    }

    public function withDate()
    {
        $d = \Carbon\Carbon::parse($this->paid_date);
        return $d->format('d'). $d->format('m'). $d->format('y');
    }

    public function getNest()
    {
        return $this->hasOne('App\Nests', 'payment_id', 'id');
    }
}
