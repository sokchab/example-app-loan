<?php

namespace App\Http\Controllers\Bank;

use App\Exports\CashExportLastYear;
use App\Exports\CashExportLast28Days;
use App\Exports\CashExportLast7Days;
use App\Exports\CashExportToday;
use App\Exports\CashExportByDay;
use App\Http\Controllers\Controller;
use App\Trans\Bases\BankCashSheet as Bcs;
use Illuminate\Http\Request;

class Exports extends Controller
{
    /**
     * Exports constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }


    /**
     * @param Request $request
     * @return mixed
     */
    public function cashFlowToday(Request $request){
        if($request->export == 1)
            return \Excel::download(new CashExportToday(), 'cash-flow-today.xlsx');
        elseif ($request->export == 2)
            return \Excel::download(new CashExportLast7Days(), 'cash-flow-last-7-days.xlsx');
        elseif ($request->export == 3)
            return \Excel::download(new CashExportLast28Days(), 'cash-flow-last-28-days.xlsx');
        else 
            return \Excel::download(new CashExportLastYear(), 'cash-flow-last-year.xlsx');    
    }

    /**
     * @param $val
     * @return mixed
     */
    public function cashFlowByDay($val){
        $data = Bcs::select(
            'created_at as Date',
            'in_flow as InFlow',
            'out_flow as OutFlow',
            'dsc as Description',
            'balance as Balance'
        )->where('filter',  $val)->orderBy('created_at', 'desc')->get();
        return \Excel::download(new CashExportByDay($data), 'cash-flow-by-day.xlsx');
    }

    /**
     * @param $start
     * @param $end
     * @return mixed
     */
    public function cashFlowByMonth($start, $end){
        $data = Bcs::select(
            'created_at as Date',
            'in_flow as InFlow',
            'out_flow as OutFlow',
            'dsc as Description',
            'balance as Balance'
        )->betweenFilter($start, $end)->orderBy('created_at', 'desc')->get();
        return \Excel::download(new CashExportByDay($data), 'cash-flow-by-month.xlsx');
    }
}
