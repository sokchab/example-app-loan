<?php

namespace App\Http\Controllers\Bank;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Trans\Bases\Bank as Bn;
use App\Trans\Bases\BankCashSheet as Bcs;
use App\Trans\Cols\CollectionSheet;

class CashInBank extends Controller
{
    /**
     * CashInBank constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(){
        $data = Bn::all()->first();

        //Weekly
        $WeeklyInFlow = array();
        $WeeklyOutFlow = array();
        $WeekDay = array();
        $Dis = array();

        $days = Carbon::now()->startOfWeek();
        while ($days < Carbon::now()->endOfWeek()){
            $row = Bcs::select('in_flow','out_flow')
                ->where('filter',"=", $days->format('Y-m-d'));

            $WeekDay[] = $days->isoFormat("Do");
            $WeeklyInFlow[] = $row->sum('in_flow');
            $WeeklyOutFlow[] = $row->sum('out_flow');
            $Dis[] = $row->where('status', 3)->sum('out_flow');
            $days->addDays(1);
        }

        $dataWeek = [];
        for ($i = 1; $i <= Carbon::now()->endOfMonth()->weekOfMonth; $i++){
            $dataWeek[] = Carbon::create(date('Y'),date('m'),$i)->isoFormat('Do');
        }

        //Monthly
        $mIn = array();
        $mOut = array();
        $mDis = array();
        foreach (Helper::getDaysOfWeekFromMonth() as $d){
            $row = Bcs::betweenCreatedAt(Carbon::parse($d["start"]), Carbon::parse($d["end"]));
            $mIn[] = $row->sum('in_flow');
            $mOut[] = $row->sum('out_flow');
            $mDis[] = $row->where('status', 3)->sum('out_flow');
        }

        return view("banks.CashSheet", [
            'data' => $data,
            'sub' => $data->getTransactions()->orderBy('created_at', 'desc')->paginate(30),
            'WeeklyCashFlow' => [
                'Day' => $WeekDay,
                'In' => $WeeklyInFlow,
                'InSum' => Bcs::select('in_flow')->weeklyCashValue()->sum('in_flow'),
                'Out' => $WeeklyOutFlow,
                'OutSum' => Bcs::select('out_flow')->weeklyCashValue()->sum('out_flow'),
                'OutSumDes' => Bcs::select('out_flow')->weeklyCashValue()->where('status', 3)->sum('out_flow'),
                'LastSumDes' => Bcs::select('out_flow')->lastWeeklyCashValue()->where('status', 3)->sum('out_flow'),
                'Dis' => $Dis,
            ],
            'Monthly' => [
                'weeksDate' => $dataWeek,
                'In' => $mIn,
                'Out' => $mOut,
                'Dis' => $mDis,
                'ValThis' => Bcs::betweenCreatedAt(Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth())->where('status', 3)->sum('out_flow'),
                'ValLast' => Bcs::betweenCreatedAt(Carbon::now()->subMonth()->startOfMonth(), Carbon::now()->subMonth()->endOfMonth())->where('status', 3)->sum('out_flow')
            ]
        ]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function install(){
        $data = Bn::get();
        return view('banks.CashInitialize', compact('data'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function flows(){
        /**
        * $data = Bcs::today()->orderBy('created_at', 'desc')->get();
        * $Filter = 1;
        * $Disbursement = Bcs::today()->where('status', 3)->sum('out_flow');
        * $Deposit = Bcs::today()->where('status', 1)->sum('in_flow');
        * $Withdrawal = Bcs::today()->where('status', 2)->sum('out_flow');
        * $Collection = Bcs::today()->where('status', 4)->sum('in_flow');
        */

        $data = Bcs::today()->orderBy('created_at', 'desc')->paginate(30);
        $Filter = 1;
        $Disbursement = Bcs::today()->where('status', 3)->sum('out_flow');
        $Deposit = Bcs::today()->where('status', 1)->sum('in_flow');
        $Withdrawal = Bcs::today()->where('status', 2)->sum('out_flow');
        $Collection = Bcs::today()->where('status', 4)->sum('in_flow');
        $LoanReject = Bcs::today()->where('status', 5)->sum('in_flow');
        $EarningInterest = Bcs::today()->where('status', 6)->sum('in_flow');
        $EarningPenalty = Bcs::today()->where('status', 7)->sum('in_flow');

        // $Balance1 = Bn::all()->first()->bank_principle;
        // $Interest1 = Bn::all()->first()->bank_interest;

        $Balance1 = Bcs::where('status', 4)->sum('in_flow');
        $Interest1 = Bcs::where('status', 6)->sum('in_flow');
        $Penalty = Bcs::where('status', 7)->sum('in_flow');
        $DisbursementAll = Bcs::where('status', 3)->sum('out_flow');

        $Outstandings = CollectionSheet::sum("print_due_return");

        return view("banks.reports.Filter",
            compact([
                'data',
                'Filter',
                'Disbursement',
                'Deposit',
                'Withdrawal',
                'Collection',
                'LoanReject',
                'EarningInterest',
                'EarningPenalty',
                'Balance1',
                'Interest1',
                'Outstandings',
                'Penalty',
                'DisbursementAll',
            ])
        );
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function flows_by(Request $request){
        $ref = $request->filter;

        if($ref == 1) {
            $data = Bcs::today()->orderBy('created_at', 'desc')->paginate(30);
            $Filter = 1;
            $Disbursement = Bcs::today()->where('status', 3)->sum('out_flow');
            $Deposit = Bcs::today()->where('status', 1)->sum('in_flow');
            $Withdrawal = Bcs::today()->where('status', 2)->sum('out_flow');
            $Collection = Bcs::today()->where('status', 4)->sum('in_flow');
            $LoanReject = Bcs::today()->where('status', 5)->sum('in_flow');
            $EarningInterest = Bcs::today()->where('status', 6)->sum('in_flow');
            $EarningPenalty = Bcs::today()->where('status', 7)->sum('in_flow');

        }elseif ($ref == 2){
            $data = Bcs::last7days()->orderBy('created_at', 'desc')->paginate(30);
            $Filter = 2;
            $Disbursement = Bcs::last7days()->where('status', 3)->sum('out_flow');
            $Deposit = Bcs::last7days()->where('status', 1)->sum('in_flow');
            $Withdrawal = Bcs::last7days()->where('status', 2)->sum('out_flow');
            $Collection = Bcs::last7days()->where('status', 4)->sum('in_flow');
            $LoanReject = Bcs::last7days()->where('status', 5)->sum('in_flow');
            $EarningInterest = Bcs::last7days()->where('status', 6)->sum('in_flow');
            $EarningPenalty = Bcs::last7days()->where('status', 7)->sum('in_flow');

        } elseif ($ref == 3){
            $data = Bcs::last28days()->orderBy('created_at', 'desc')->paginate(30);
            $Filter = 3;
            $Disbursement = Bcs::last28days()->where('status', 3)->sum('out_flow');
            $Deposit = Bcs::last28days()->where('status', 1)->sum('in_flow');
            $Withdrawal = Bcs::last28days()->where('status', 2)->sum('out_flow');
            $Collection = Bcs::last28days()->where('status', 4)->sum('in_flow');
            $LoanReject = Bcs::last28days()->where('status', 5)->sum('in_flow');
            $EarningInterest = Bcs::last28days()->where('status', 6)->sum('in_flow');
            $EarningPenalty = Bcs::last28days()->where('status', 7)->sum('in_flow');

        }else {  //lastYear
            $data = Bcs::lastYear()->orderBy('created_at', 'desc')->paginate(30);
            $Filter = 4;
            $Disbursement = Bcs::lastYear()->where('status', 3)->sum('out_flow');
            $Deposit = Bcs::lastYear()->where('status', 1)->sum('in_flow');
            $Withdrawal = Bcs::lastYear()->where('status', 2)->sum('out_flow');
            $Collection = Bcs::lastYear()->where('status', 4)->sum('in_flow');
            $LoanReject = Bcs::lastYear()->where('status', 5)->sum('in_flow');
            $EarningInterest = Bcs::lastYear()->where('status', 6)->sum('in_flow');
            $EarningPenalty = Bcs::lastYear()->where('status', 7)->sum('in_flow');
        }

        // $Balance1 = Bn::all()->first()->bank_principle;
        // $Interest1 = Bn::all()->first()->bank_interest;
        $Balance1 = Bcs::where('status', 4)->sum('in_flow');
        $Interest1 = Bcs::where('status', 6)->sum('in_flow');
        $Penalty = Bcs::where('status', 7)->sum('in_flow');
        $DisbursementAll = Bcs::where('status', 3)->sum('out_flow');

        $Outstandings = CollectionSheet::sum("print_due_return");

        return view("banks.reports.Filter",
            compact([
                'data',
                'Filter',
                'Disbursement',
                'Deposit',
                'Withdrawal',
                'Collection',
                'LoanReject',
                'EarningInterest',
                'EarningPenalty',
                'Balance1',
                'Interest1',
                'Outstandings',
                'Penalty',
                'DisbursementAll'
            ])
        );
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function flows_by_day(Request $request){

        $data = Bcs::where('filter',  $request->filter)->orderBy('created_at', 'desc')->paginate(30);
        $Deposit = Bcs::where('filter',  $request->filter)->where('status', 1)->sum('in_flow');
        $Withdrawal = Bcs::where('filter',  $request->filter)->where('status', 2)->sum('out_flow');
        $Disbursement = Bcs::where('filter',  $request->filter)->where('status', 3)->sum('out_flow');
        $Collection = Bcs::where('filter',  $request->filter)->where('status', 4)->sum('in_flow');
        $LoanReject = Bcs::where('filter',  $request->filter)->where('status', 5)->sum('in_flow');
        $EarningInterest = Bcs::where('filter',  $request->filter)->where('status', 6)->sum('in_flow');
        $EarningPenalty = Bcs::where('filter',  $request->filter)->where('status', 7)->sum('in_flow');

        // $Balance = Bn::all()->first()->bank_principle;
        // $Interest = Bn::all()->first()->bank_interest;
        $Balance = Bcs::where('status', 4)->sum('in_flow');
        $Interest = Bcs::where('status', 6)->sum('in_flow');
        $Penalty = Bcs::where('status', 7)->sum('in_flow');
        $DisbursementAll = Bcs::where('status', 3)->sum('out_flow');

        $Outstandings = CollectionSheet::sum("print_due_return");

        return view("banks.reports.ByDay", [
            'filter' => $request->filter,
            'data' => $data,
            'deposit' => $Deposit,
            'withdrawal' => $Withdrawal,
            'disbursement' => $Disbursement,
            'collection' => $Collection,
            'loanReject' => $LoanReject,
            'earningInterest' => $EarningInterest,
            'earningPenalty' => $EarningPenalty,
            'balance' => $Balance,
            'interest' => $Interest,
            'Outstandings' => $Outstandings,
            'Penalty' => $Penalty,
            'DisbursementAll' => $DisbursementAll,
        ]);
    }


    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function flows_by_month(Request $request){

        $data = Bcs::betweenFilter($request->from, $request->to)->orderBy('created_at', 'desc')->paginate(30);
        $Deposit = Bcs::betweenFilter($request->from, $request->to)->where('status', 1)->sum('in_flow');
        $Withdrawal = Bcs::betweenFilter($request->from, $request->to)->where('status', 2)->sum('out_flow');
        $Disbursement = Bcs::betweenFilter($request->from, $request->to)->where('status', 3)->sum('out_flow');
        $Collection = Bcs::betweenFilter($request->from, $request->to)->where('status', 4)->sum('in_flow');
        $LoanReject = Bcs::betweenFilter($request->from, $request->to)->where('status', 5)->sum('in_flow');
        $EarningInterest = Bcs::betweenFilter($request->from, $request->to)->where('status', 6)->sum('in_flow');
        $EarningPenalty = Bcs::betweenFilter($request->from, $request->to)->where('status', 7)->sum('in_flow');

        // $Balance = Bn::all()->first()->bank_principle;
        // $Interest = Bn::all()->first()->bank_interest;

        $Balance = Bcs::where('status', 4)->sum('in_flow');
        $Interest = Bcs::where('status', 6)->sum('in_flow');
        $Penalty = Bcs::where('status', 7)->sum('in_flow');
        $DisbursementAll = Bcs::where('status', 3)->sum('out_flow');

        $Outstandings = CollectionSheet::sum("print_due_return");

        return view("banks.reports.ByMonth", [
            'from' => $request->from,
            'to' => $request->to,
            'data' => $data,
            'deposit' => $Deposit,
            'withdrawal' => $Withdrawal,
            'disbursement' => $Disbursement,
            'collection' => $Collection,
            'loanReject' => $LoanReject,
            'earningInterest' => $EarningInterest,
            'earningPenalty' => $EarningPenalty,
            'balance' => $Balance,
            'interest' => $Interest,

            "Outstandings" => $Outstandings,
            "Penalty" => $Penalty,
            "DisbursementAll" => $DisbursementAll
        ]);
    }


    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function submit(Request $request){
        $request->validate([
           'cash__status' => 'required',
           'cash__amount' => 'required|numeric:min:0'
        ]);

        $bs = Bn::all()->first();
        $balance = $bs->bank_principle;

        if($request->cash__status == 1){
            $balance = $balance + $request->cash__amount;
            Bcs::create([
                'in_flow' => $request->cash__amount,
                'out_flow' => 0,
                'balance' => $balance,
                'status' => 1,
                'dsc' => 'Deposit',
                'bank_id' => $bs->bank_id,
                'user_id' => auth()->user()->id,
                'filter' => now()
            ]);
        }else{
            $balance = $balance - $request->cash__amount;
            Bcs::create([
                'in_flow' => 0,
                'out_flow' => $request->cash__amount,
                'balance' => $balance,
                'status' => 2,
                'dsc' => 'Withdrawal',
                'bank_id' => $bs->bank_id,
                'user_id' => auth()->user()->id,
                'filter' => now()
            ]);
        }
        $bs->bank_principle = $balance;
        $bs->save();

        return back();
    }
}
