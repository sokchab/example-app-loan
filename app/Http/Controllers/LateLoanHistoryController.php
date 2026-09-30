<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\LateLoanHistory as M;

class LateLoanHistoryController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth");
    }

    public function index()
    {
        $m = M::whereHas("getClient", function($rq){
            $rq->where('cus_key', 'like', "%" .request('_search'). "%")

                ->orWhere('first_name', 'like', "%" .request('_search'). "%")
                ->orWhere('last_name', 'like', "%" .request('_search'). "%")

                ->orWhere('last_name_en', 'like', "%" .request('_search'). "%")
                ->orWhere('first_name_en', 'like', "%" .request('_search'). "%")

                ->orWhere('phone2', 'like', "%" .request('_search'). "%")
                ->orWhere('phone', 'like', "%" .request('_search'). "%");
                
        })->orderBy('sheet')->paginate(100);
        //
        //
        return view("history.late", compact("m"));
    }
}
