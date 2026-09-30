<?php

namespace App\Http\Controllers\V2\Others;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Additional\LoanOthers as Loan;
use App\Opts\Customer as Cus;

class Loans extends Controller
{
    /**
     * Loans constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function clients(Request $request)
    {
        $val = trim($request->search);
        //
        $cus = Cus::where('first_name', 'like', "%$val%")
            ->orWhere('last_name', 'like', "%$val%")
            ->orWhere('first_name_en', 'like', "%$val%")
            ->orWhere('last_name_en', 'like', "%$val%")
            ->orWhere('dob', 'like', "%$val%")
            ->orWhere('occupation', 'like', "%$val%")
            ->orWhere('phone', 'like', "%$val%")
            ->orWhere('phone2', 'like', "%$val%")
            ->orWhere('key_ref', 'like', "%$val%")
            ->orWhere('cus_key', 'like', "%$val%")
            ->orderBy('created_at', 'desc')->paginate(20);
        //
        return view("v2.others.loans.clients", ['cus' => $cus]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('v2.others.loans.index');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $loan = new Loan();
        $loan->created_at = now();
        
        return view('v2.others.loans.create', [ 'cus' => $loan ]);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function createByClient($id)
    {
        $cc = Cus::findOrFail($id);
        //
        $loan = new Loan();
        $loan->created_at = now();
        $loan->name = $cc->fullName();
        $loan->gender = $cc->gender ? 0 : 1;
        $loan->dob = $cc->dob;
        $loan->phone = \Hel::phoneDisplay($cc->phone)." , ". \Hel::phoneDisplay($cc->phone2);
        //
        return view('v2.others.loans.create', [ 'cus' => $loan ]);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $ln = Loan::findOrFail($id);
        return view('v2.others.loans.create', [ 'cus' => $ln ]);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        $ln = Loan::findOrFail($id);
        return view('v2.others.loans.show', [ 'cus' => $ln ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function save(Request $request)
    {
        $ln = Loan::findOrNew($request->key);
        //
        $request->validate([
            'name' => 'required|string|max:150',
            'gender' => 'required|numeric|min:0|max:1',
            'dob' => 'date|nullable',
            'phone' => 'string|max:255|nullable',
            'description' => 'nullable',
            'amount' => 'required|numeric|min:0',
            'payment_date' => "required|date|after:created_at"
        ]);
        //
        $ln->name = $request->name;
        $ln->gender = $request->gender;
        $ln->dob = $request->dob;
        $ln->phone = $request->phone;
        $ln->description = $request->description;
        $ln->amount = $request->amount;
        $ln->payment_date = $request->payment_date;
        $ln->created_at = $request->created_at;
        $ln->save();
        //
        return back()->with(['message' => "($ln->name), Save Completed."]);
    }

    /**
     * @return mixed
     */
    public function fetch()
    {
        $tlc = Loan::query()->orderBy('key', 'desc');
        return \DataTables::of($tlc)
            ->addIndexColumn()
            ->addColumn('action', function($row){
                if($row->status == 0)
                    return "<span style=\"font-size: 11px\" class=\"badge badge-danger text-bold\">មិនទាន់បង់</span>";
                else 
                    return "<span style=\"font-size: 11px\" class=\"badge badge-primary text-bold\">បានបង់ចប់</span>";    
            })
            ->editColumn('amount', function($row){
                return "<span style=\"font-size: 14px\">$</span> 
                        <span class=\"float-right text-bold\">". number_format($row->amount) ."</span>";
            })
            ->editColumn('gender', function($row){
                return $row->gender ? "F" : "M";
            })
            ->editColumn('dob', function($row){
                return \Carbon::parse($row->dob)->format('d-m-Y');
            })
            ->editColumn('payment_date', function($row){
                return \Carbon::parse($row->payment_date)->format('d-m-Y');
            })
            ->editColumn('created_at', function($row){
                return \Carbon::parse($row->created_at)->format('d-m-Y');
            })
            ->editColumn('key', function($row){
                $route = route('v2.others.loan.show', $row->key);
                $val = str_pad($row->key, 5, "0", STR_PAD_LEFT);

                if($row->status == 0 && Carbon::now()->gte($row->payment_date)){
                    $status = "<span class=\"badge badge-danger float-right mt-1\"><i class=\"fas fa-dollar-sign\"></i></span>";
                }else{
                    $status = "";
                }

                return "<a href=\"$route\" class=\"btn btn-success btn-xs text-bold\">
                        <i class=\"fas fa-key mr-1\"></i> $val
                    </a>" . $status;
            })
            ->filter(function ($query){
                if (request()->has('search'))
                    $query->where('key', 'like', "%" . trim(request('search')) . "%")
                        ->orWhere('name', 'like', "%" . trim(request('search')) . "%")
                        ->orWhere('dob', 'like', "%" . trim(request('search')) . "%")
                        ->orWhere('phone', 'like', "%" . trim(request('search')) . "%")
                        ->orWhere('description', 'like', "%" . trim(request('search')) . "%")
                        ->orWhere('payment_date', 'like', "%" . trim(request('search')) . "%")
                        ->orWhere('amount', 'like', "%" . trim(request('search')) . "%");
            })
            ->rawColumns([
                'action',
                'amount',
                'gender',
                'dob',
                'payment_date',
                'created_at',
                'key'
            ])->make(true);
    }
    //

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function paymentForm($id)
    {
        $cus = Loan::findOrFail($id);
        //
        $dd = Carbon::parse($cus->created_at)->diffInDays($cus->payment_date);
        $ddate = Carbon::parse($cus->payment_date)->addDays($dd)->format("Y-m-d");
        //
        $payment_amount = $cus->payments()->count() > 0 ? $cus->amount - $cus->payments()->sum('amount') : $cus->amount;
        //
        return view('v2.others.loans.payments', [
            'cus' => $cus,
            'new_payment_date' => $ddate,
            'payment_amount' => $payment_amount
        ]);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function payment(Request $request,$id)
    {
        $cus = Loan::findOrFail($id);
        //
        $request->validate([
            "payment_amount" => "required|numeric|min:0|max:$cus->amount",
            "new_payment_date" => "required|date|after:created_at",
            "paid_by" => "required|string|max:255"
        ]);
        //
        $ch_pay = $cus->payments()->count() > 0 ? $cus->payments()->sum('amount') : 0;
        if(($ch_pay + $request->payment_amount) == $cus->amount){
            $cus->status = 1;
        }else {
            $cus->payment_date = $request->new_payment_date;
        }
        $cus->save();

        $cus->payments()->create([
            'amount' => $request->payment_amount,
            'paid_by' => $request->paid_by
        ]);
        //
        return back();
    }
}
