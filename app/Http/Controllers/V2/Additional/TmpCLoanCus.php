<?php

namespace App\Http\Controllers\V2\Additional;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Additional\TmpLoanClient as TLC;
use App\Http\Requests\TmpLoanCus;

class TmpCLoanCus extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view("v2.additional.tcc.index");
    }

    public function fetch()
    {
        $tlc = TLC::query()->orderBy('id', 'desc');
        return \DataTables::of($tlc)
            ->addIndexColumn()
            ->addColumn('action', function($row){
                if($row->status == 0)
                    //return request('__by');
                    return "<span style=\"font-size: 11px\" class=\"badge badge-danger text-bold\">មិនទាន់បង់</span>";
                else 
                    return "<span style=\"font-size: 11px\" class=\"badge badge-primary text-bold\">បានបង់ចប់</span>";    
            })
            ->editColumn('acc_no', function($row){
                $route = route('v2.another.editForm', $row->id);
                //
                if($row->status == 0)
                    $status = "<span class=\"text-danger\">$row->acc_no</span>";
                else 
                    $status = $row->acc_no;    
                //
                return  "<a href=\"$route\" class=\"text-bold\">
                            $status
                        </a>";
            })
            ->editColumn('ln_term', function($row){
                return "<span style=\"font-size: 13px\">ខែ</span> <span class=\"float-right\">$row->ln_term</span>";
            })
            ->editColumn('amount_pay', function($row){
                return "<span style=\"font-size: 14px\">$</span> 
                        <span class=\"float-right\">$row->amount_pay</span>";
            })
            ->editColumn('ln_rate', function($row){
                return "<span style=\"font-size: 14px\">%</span> 
                        <span class=\"float-right\">$row->ln_rate</span>";
            })
            ->editColumn('pay_day', function($row){
                if(\Carbon::now()->format('d') == $row->pay_day && $row->status == 0)
                    return "<span class=\"badge bg-gradient-danger text-sm pt-2px\">$row->pay_day</span>";
                else 
                    return $row->pay_day;
            })
            ->filter(function ($query){
                if (request()->has('search'))
                    
                    if(request('__by') == 'true')
                        $query->where('acc_no', 'like', "%" . request('search') . "%");
                    else 
                        $query->where('id', 'like', "%" . request('search') . "%")
                            ->orWhere('acc_no', 'like', "%" . request('search') . "%")
                            ->orWhere('cus_name', 'like', "%" . request('search') . "%")
                            ->orWhere('cus_phone', 'like', "%" . request('search') . "%")
                            ->orWhere('pay_day', 'like', "%" . request('search') . "%")
                            ->orWhere('amount_pay', 'like', "%" . request('search') . "%")
                            ->orWhere('c_mfi', 'like', "%" . request('search') . "%")
                            ->orWhere('others', 'like', "%" . request('search') . "%")
                            ->orWhere('first_pay_date', 'like', "%" . request('search') . "%")
                            ->orWhere('end_pay_date', 'like', "%" . request('search') . "%");
            })
            ->rawColumns([
                'action',
                'acc_no',
                'ln_term',
                'amount_pay',
                'pay_day',
                'ln_rate'
            ])->make(true);
    }

    public function createForm()
    {
        $cus = new TLC();
        return view('v2.additional.tcc.create', [ 'cus' => $cus ]);
    }

    public function editForm($id)
    {
        $cus = TLC::findOrFail($id);
        return view('v2.additional.tcc.create', [ 'cus' => $cus ]);
    }

    public function create(Request $re)
    {

        $re->validate([
            'accNo' => 'required|string|max:190',
            'cusName' => 'required|string|max:255',
            'cusPhone' => 'required|string|max:200',
            'monthlyPayment' => 'required|numeric|min:0',
            'cMFI' => 'required|string|max:255',
            'others' => 'max:255',
            'loanTerm' => 'min:0',
            'interestRate' => 'min:0',
            'firsPaymentDate' => 'required|date',
            'endPaymentDate' => 'date'
        ]);

        $cus = TLC::findOrNew($re->id);
        $cus->acc_no = $re->accNo;
        $cus->cus_name = $re->cusName;
        $cus->cus_phone = $re->cusPhone;
        // $cus->pay_day = $re->paymentDay;
        $cus->amount_pay = $re->monthlyPayment;
        $cus->c_mfi = $re->cMFI;
        $cus->others = $re->others;
        $cus->ln_term = $re->loanTerm;
        $cus->ln_rate = $re->interestRate;
        $cus->first_pay_date = $re->firsPaymentDate;
        $cus->end_pay_date = $re->endPaymentDate;
        $cus->status = $re->status;

        $pDay = \Carbon::parse($cus->first_pay_date)->format('d');

        $cus->pay_day = $pDay;

        $cus->save();

        return back()->with(['message' => "($cus->cus_name), Save Completed."]);
    }
}
