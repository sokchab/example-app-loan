<?php

namespace App\Trans\Bases;

use App\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class BankCashSheet extends Model
{
    protected $table = 'cash__bank_sheets';

    protected $fillable = [
        'in_flow',
        'out_flow',
        'balance',
        'status',
        'dsc',
        'bank_id',
        'user_id',
        'filter',
        'loan'
    ];


//    protected $dates = ['created_at', 'updated_at'];

    public function getBank(){
        return $this->belongsTo(Bank::class, 'bank_id', 'bank_id');
    }

    public function getUser(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /*
     * whereDate
    public function scopeLastMonth($query, $type)
    {
        return $query->where('type', $type);
    }
    */

    public function scopeLast7days($query){
        return $query->where('created_at', '>=', Carbon::today()->subDays(7));
    }

    public function scopeLast28days($query){
        return $query->where('created_at', '>=', Carbon::today()->subDays(28));
    }

    public function scopeLastYear($query){
        return $query->whereBetween('created_at', [
            Carbon::now()->startOfYear(),
            Carbon::now()->endOfYear()
        ]);
    }

    public function scopeToday($query)
    {
        return $query->where('created_at', '<', Carbon::tomorrow())
                     ->where('created_at', '>=', Carbon::today());
    }

    public function scopeYesterday($query)
    {
        return $query->where('created_at', '<', Carbon::today())
                     ->where('created_at', '>=', Carbon::yesterday());
    }

    public function scopeWeeklyCashValue($query){
        return $query->whereBetween('created_at',
            [
                Carbon::now()->startOfWeek(),
                Carbon::now()->endOfWeek()
            ]);
    }

    public function scopeLastWeeklyCashValue($query){
        return $query->whereBetween('created_at',
            [   Carbon::now()->startOfWeek()->subWeek(),
                Carbon::now()->endOfWeek()->subWeek()
            ]);
    }

    public function scopeBetweenCreatedAt($query, $start, $end){
        return $query->whereBetween('created_at',[ $start, $end ]);
    }

    public function scopeBetweenFilter($query, $start, $end){
        return $query->where('filter', '>=', $start)->where('filter', '<=', $end);
    }
}
