<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\FinishLoanHistory as M;

class FinishLoanHistoryController extends Controller
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
                
        })
        ->orWhereHas("getSheet", function($query){
            $query->whereHas("getLoan", function($query){
               $query->where('acc_number', 'like', '%' . request("_search") . '%' )
                    ->orWhereHas("getJoin", function($query){
                        $query->where('first_name', 'like', "%" .request('_search'). "%")
                        ->orWhere('last_name', 'like', "%" .request('_search'). "%")

                        ->orWhere('last_name_en', 'like', "%" .request('_search'). "%")
                        ->orWhere('first_name_en', 'like', "%" .request('_search'). "%")

                        ->orWhere('phone2', 'like', "%" .request('_search'). "%")
                        ->orWhere('phone', 'like', "%" .request('_search'). "%");
                    })
                    ->orWhereHas("getGuaranteed", function($query){
                        $query->where('first_name', 'like', "%" .request('_search'). "%")
                        ->orWhere('last_name', 'like', "%" .request('_search'). "%")

                        ->orWhere('last_name_en', 'like', "%" .request('_search'). "%")
                        ->orWhere('first_name_en', 'like', "%" .request('_search'). "%")

                        ->orWhere('phone2', 'like', "%" .request('_search'). "%")
                        ->orWhere('phone', 'like', "%" .request('_search'). "%");
                    })
                    ->orWhereHas("getGuaranteedJoin", function($query){
                        $query->where('first_name', 'like', "%" .request('_search'). "%")
                        ->orWhere('last_name', 'like', "%" .request('_search'). "%")

                        ->orWhere('last_name_en', 'like', "%" .request('_search'). "%")
                        ->orWhere('first_name_en', 'like', "%" .request('_search'). "%")

                        ->orWhere('phone2', 'like', "%" .request('_search'). "%")
                        ->orWhere('phone', 'like', "%" .request('_search'). "%");
                    }); 
            });
        })
        ->orderBy('created_at', 'desc')->paginate(100);
        //
        //
        return view("history.finish", compact("m"));
    }
    
}
