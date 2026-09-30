<?php

namespace App\Trans;

use App\Trans\Bases\Bank as Bn;
use App\Trans\Bases\BankCashSheet as Bns;
use Illuminate\Database\Eloquent\Model;

class WithClient extends Model
{
    protected $table = 'with_clients';
    protected $primaryKey = 'id';

    protected $fillable =[
        'full_name',
        'khmer_name',
        'gender',
        'date_of_birth',
        'marital_status',
        'id_type',
        'id_number',
        'id_date',
        'occupation',
        'join_type',
        'group',
        'home',
        'street',
        'phone',
        'province',
        'district',
        'commune',
        'village'
    ];


    public static function PMC($rate,$nper,$pv,$fv=0,$type=0){
        return -(-$fv - $pv * pow(1 + $rate, $nper)) /
            (1 + $rate * $type) /
            ((pow(1 + $rate, $nper) - 1) / $rate);
    }

    public static function bankInFlow($val,$status,$dsc, $loan =null){
        $bs = Bn::all()->first();
        $balance = $bs->bank_principle;
        $balance = $balance + $val;
        Bns::create([
            'in_flow' => $val,
            'out_flow' => 0,
            'balance' => $balance,
            'status' => $status,
            'dsc' => $dsc,
            'bank_id' => $bs->bank_id,
            'user_id' => auth()->user()->id,
            'filter'  => now(),
            'loan' => $loan
        ]);
        $bs->bank_principle = $balance;
        $bs->save();
    }

    public static function bankOutFlow($val,$status,$dsc, $loan =null){
        $bs = Bn::all()->first();
        $balance = $bs->bank_principle;
        $balance = $balance - $val;
        Bns::create([
            'in_flow' => 0,
            'out_flow' => $val,
            'balance' => $balance,
            'status' => $status,
            'dsc' => $dsc,
            'bank_id' => $bs->bank_id,
            'user_id' => auth()->user()->id,
            'filter'  => now(),
            'loan' => $loan,
        ]);
        $bs->bank_principle = $balance;
        $bs->save();
    }

    // public static function deleteBankOutFlow($val, $id){
    //     $bs = Bn::all()->first();
    //     $balance = $bs->bank_principle;
    //     $balance = $balance + $val;
    //     Bns::where('', $id)->delete();
    //     $bs->bank_principle = $balance;
    //     $bs->save();
    // }

    public static function bankInterest($val, $loan = null){
        $bs = Bn::all()->first();
        $bs->bank_interest = $bs->bank_interest + $val;
        $bs->bank_principle = $bs->bank_principle + $val;
        $bs->save();

        Bns::create([
            'in_flow' => $val,
            'out_flow' => 0,
            'status' => 6,
            'balance' => $bs->bank_interest,
            'dsc' => 'Retained Earning from Interest',
            'bank_id' => $bs->bank_id,
            'user_id' => auth()->user()->id,
            'filter'  => now(),
            'loan' => $loan,
        ]);
    }
}
