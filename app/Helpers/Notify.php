<?php

namespace App\Helpers;
use App\Trans\Loan as Ln;
use Carbon\Carbon;

class Notify 
{
    /**
     * The collection of loan overdue.
     *
     * @var array
     */
    private static $data;
    
    /**
     * The overdue of loan late.
     *
     * @var array
     */
    private static $overdue;

    private static $navData;
    private static $navOver;

    public static function setData()
    {
        $tmp = Ln::where('status', 1)
            ->whereHas('getCollection', function($query){
                $query->where('date_pay', '<=', Carbon::now()->subDays(3)) // default 5
                    ->where('state', false);
            })
            ->orderBy('created_at', 'desc');

        self::$data = $tmp;   
        self::$navData = $tmp;
        // 
    }

    public static function getData(){
        if(self::$data == null) return new Ln();
        return self::$data;
    }

    public static function getOverDue(){
        if(self::$overdue == null) return new Ln();
        return self::$overdue;
    }

    public static function setOverDue(){

        $tmp  = Ln::where('status', 1)
            ->whereHas('getCollection', function($query){
                $query->where('date_pay', '<=', Carbon::now()->subMonths(1))
                    ->where('state', false);
            })
            ->orderBy('created_at', 'desc');

        self::$overdue = $tmp;
        self::$navOver = $tmp;
        //
    }

    public static function getNavData(){
        if(self::$navData == null) return new Ln();
        return self::$navData;
    }

    public static function getNavOver()
    {
        if(self::$navOver == null) return new Ln();
        return self::$navOver;
    }
}