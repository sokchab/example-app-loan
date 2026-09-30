<?php

namespace App\Additional;

use Illuminate\Database\Eloquent\Model;

class TmpLoanClient extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'additional_tmp_loan_clients';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'acc_no',
        'cus_name',
        'cus_phone',
        'pay_day',
        'amount_pay',
        'c_mfi',
        'others',
        'ln_term',
        'ln_rate',
        'first_pay_date',
        'end_pay_date',
        'status'
    ];

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id';
}

// Schema::create('additional_tmp_loan_clients', function (Blueprint $table) {
//     $table->id();
//     $table->string('acc_no', 190);
//     $table->string('cus_name', 255);
//     $table->string('cus_phone', 200);
//     $table->integer('pay_day');
//     $table->float('amount_pay',50,5)->default(0.00);
//     $table->string('c_mfi', 255);
//     $table->string('others')->nullable();
//     $table->integer('ln_term')->default(0)->nullable();
//     $table->float('ln_rate', 50, 5)->default(0)->nullable();
//     $table->date('first_pay_date')->nullable();
//     $table->date('end_pay_date')->nullable();
//     $table->timestamps();
// });
