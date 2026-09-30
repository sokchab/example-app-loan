<?php

namespace App\Trans\Cols;

use App\Raturnable\Payments;
use Illuminate\Database\Eloquent\Model;
use App\Trans\Loan;

class CollectionSheet extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'collection_sheets';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'date_pay',
        'amount',
        'print_due',
        'inter_due',
        'balance',
        'fee',
        'late',
        'loan',
        'print_due_return',
        'inter_due_return',
        'fee_return',
        'state',
        'is_active',
        'prefix',
        'by_paid',
        'by_id',
        'same_value',
        'pay_col_id',
        'kok',
        'is_finish'
    ];

    public function amountToPay()
    {
        return $this->print_due_return + $this->inter_due_return + $this->fee;
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function getLoan()
    {
        return $this->belongsTo(Loan::class, 'loan', 'id');
    }

    /**
     * Scope a query to only include.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeHasCollection($query){
        return $query->where('date_pay', '<=', now());
                //->where('date_pay', '>', \Carbon\Carbon::now()->subMonths(1));
    }

    /**
     * Scope a query to only include overdue
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeHasOverdue($query)
    {
        return $query->where('date_pay', '<=', \Carbon\Carbon::now()->subMonths(1));
    }

    /**
     * @param $query
     * @return mixed
     */
    public function scopeNotReturn($query){
        return $query->where('state', 0);
    }

    /**
     * @param $query
     * @return mixed
     */
    public function scopeIsReturn($query){
        return $query->where('state', 1);
    }

    /**
     * Scope a query to only include active
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeIsActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * @param $query
     * @return mixed
     */
    public function scopeIsReLoans($query){
        $max = $query->max('fee_return');
        return $query->where('fee_return', $max)
            ->where('state', 1);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function getPayments(){
        // return $this->hasOne(Payments::class,'LoanCollection', 'id');
        return $this->hasOne(Payments::class, 'LoanCollection', 'id');
    }

    /**
     * @param $query
     * @param $id
     * @return mixed
     */
    public function scopeByLoan($query, $id){
        return $query->where('loan', $id);
    }


    /**
     * Scope a query to only include overdue
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeIsOverdue($query)
    {
        return $query->where('state', 0)
                    ->whereDate('date_pay', '<=', \Carbon\Carbon::now()->subMonths(1));
    }

    public function isOnOverDue()
    {
        return self::where('state', 0)
                ->where('date_pay', '<=', \Carbon\Carbon::now()->subMonths(1))
                ->first();
    }

    
    public function OnOverdueState()
    {
        return $this->date_pay <= \Carbon\Carbon::now()
              &&  $this->state == 0;
    }


    public function PayCols()
    {
        return $this->belongsTo('App\PayCol', 'pay_col_id', 'id');
    }


    public function late_loan_histories()
    {
        return $this->hasMany('App\LateLoanHistory', 'sheet', 'id');
    }

    public function finish_loan_histories()
    {
        return $this->hasMany('App\FinishLoanHistory', 'sheet', 'id');
    }
}
