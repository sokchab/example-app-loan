<?php

namespace App\Helpers;

use App\Helpers\Helper;

class Amortization 
{
    /**
     * The balance of loan request.
     *
     * @var float
     */
    private $amount;

    /**
     * The term of loan return.
     *
     * @var int
     */
    private $term;

    /**
     * The loan interest rate.
     *
     * @var float
     */
    private $rate;

    /**
     * The first schedule loan return.
     *
     * @var date
     */
    private $startDate;


    /**
     * The nthDay of rate processing loan schedule.
     *
     * @var int
     */
    private $ratePer = 1;


    /**
     * The create value of amount.
     *
     * @param float
     */
    public function Amount($amount)
    {
        $this->amount = $amount;
    }

    /**
     * The create value of rate.
     *
     * @param float
     */
    public function Rate($rate)
    {
        $this->rate = $rate;
    }

    /**
     * The create value of term.
     *
     * @param int
     */
    public function Term($term)
    {
        $this->term = $term;
    }

    /**
     * The create value of startDate.
     *
     * @param date
     */
    public function StartDate($startDate)
    {
        $this->startDate = $startDate;
    }

    /**
     * The create value of rateByDay.
     *
     * @param int
     */
    public function RateByDay($ratePer)
    {
        $this->ratePer = $ratePer;
    }

    //no amotize
    public function schedules_edit() : array
    {
        $schedule = array();
        $rate = Helper::rate($this->rate) * $this->ratePer;
        //
        $pay = ceil($this->amount/$this->term);
        $int = ceil($this->amount * $rate);
        //
        $wast = ($pay * $this->term) - $this->amount;
        //
        $balDue = $this->amount;
        //
        for($x = 0; $x < $this->term; $x++){
            $payDue = $pay;
            //
            if($wast > $x){
                $payDue -= 1;
            }
            //
            $balDue = $balDue - $payDue;
            //
            $schedule [] = [
                'date'          => $this->startDate,
                'total'         => $payDue + $int,
                'principal'     => $payDue,
                'interest'      => $int,
                'balance'       => $balDue,
                'wast'          => $wast
            ];

            $this->startDate = \Carbon\Carbon::parse($this->startDate)->addMonths(1);
        }

        return $schedule;
    }

    /**
     * The processing loan schedule.
     *
     * @return array
     */
    public function schedules() : array
    {
        $schedule = [];
        $rate = Helper::rate($this->rate) * $this->ratePer;

        if($rate > 0) {

            $calculate = ceil($this->amount/$this->term) + ceil($this->amount * $rate);
            $pmt = Helper::pmt($rate, $this->term, $this->amount);
            $subs = $calculate - $pmt;
            $interest = $this->amount * $rate;
            $principal = ceil($pmt - $interest); 
            //$wast = $principal - ($pmt - $interest);
            $total = $pmt + $subs;
            $interest = $total - $principal;
            $balance = $this->amount - $principal;
            $wast = $this->wast($this->amount, $this->term, $rate, $pmt, $calculate) - $this->amount;
            //sub data
            $prinDue = $principal;
            $interDue = 0;
            $balDue = $this->amount;
            //raw data
            for($x = 0; $x < $this->term; $x++){
                if($x < $wast){
                    $prinDue = $principal - 1;
                    $interDue = $interest + 1;
                    $balDue = $balDue - $prinDue;
                }else{
                    $prinDue = $principal;
                    $interDue = $interest;
                    $balDue = $balDue - $prinDue;
                }
                //nest
                $nest = [
                    'date'          => $this->startDate,
                    'total'         => $total,
                    'principal'     => $prinDue,
                    'interest'      => $interDue,
                    'balance'       => $balDue,
                    'wast'          => $wast
                ];
                $this->startDate = \Carbon\Carbon::parse($this->startDate)->addMonths(1);
                $interest = $balance * $rate;
                $principal = ceil($pmt - $interest);
                //$wast = $principal - ($pmt - $interest);
                $interest = $total - $principal;
                $balance = $balance - $principal;
                //rows data
                $schedule[] = $nest;
            }

        }else {
            $calculate = ceil($this->amount/$this->term); // + ceil($this->amount * $rate);
            $interest = 0; //$this->amount * $rate;
            $principal = $calculate; //ceil($pmt - $interest); 
            //
            $prinDue = $principal;
            $interDue = 0;
            $balDue = $this->amount;

            //drawing data
            for($x = 0; $x < $this->term; $x++){

                $balDue = $balDue - $prinDue;
                //nest
                $nest = [
                    'date'          => $this->startDate,
                    'total'         => $prinDue, // $total,
                    'principal'     => $prinDue,
                    'interest'      => $interDue,
                    'balance'       => $balDue,
                    'wast'          => 0
                ];
                $this->startDate = \Carbon\Carbon::parse($this->startDate)->addMonths(1);
                //$interest = 0; //$balance * $rate;
                //$principal = ceil($pmt - $interest);
                //$wast = $principal - ($pmt - $interest);
                //$interest = $total - $principal;
                //$balance = $balance - $principal;
                //rows data
                $schedule[] = $nest;
            }
        }
        return $schedule;
    }

    /**
     * The processing wast value.
     *
     * @return int
     */
    private function wast($amount, $term, $rate, $pmt, $calculate)
    {
        $result = 0;
        $subs = $calculate - $pmt;
        $interest = $amount * $rate;
        $principal = ceil($pmt - $interest); 
        $total = $pmt + $subs;
        $interest = $total - $principal;
        $balance = $amount - $principal;
        for($x = 0; $x < $term; $x++){
            $result += $principal;
            $interest = $balance * $rate;
            $principal = ceil($pmt - $interest);
            $interest = $total - $principal;
            $balance = $balance - $principal;
        }
        return $result;
    }
}