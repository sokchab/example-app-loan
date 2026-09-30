<?php

namespace App\Http\Controllers\Trans;

use App\Http\Controllers\Controller;
use App\Opts\CustGuaran;
use App\Opts\CustJoin;
use Illuminate\Http\Request;
use App\Trans\Loan;
use App\Trans\ColTmp;
use App\Trans\WithClient;
use App\Opts\CusTmp;
use App\Opts\Customer;
use App\Params\MaritalStatus as Ms;
use App\Params\Identify as Iden;
use App\Local\Province as Prov;
use App\Local\Village as Vill;
use App\Local\District as Dist;
use App\Local\Commune as Comm;
use DataTables;
use App\Trans\LoanCollateral;
use App\Trans\Cols\CollectionSheet;
use App\Helpers\Helper as He;
use App\Client as Gclient;
use App\Helpers\Amortization;
use App\Nests;
use App\Trans\Cols\Schedule;
use App\PayCol;
use App\Trans\Bases\BankCashSheet;
use App\Trans\Bases\Bank as Bn;


class __Loan__ extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('trans.loans.__init__');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $dis = Dist::byProvince(Prov::orderBy('branch_id')->first()->province_id)->get();
        $cols = ColTmp::all();

        $cusTmp = CusTmp::orderBy('numbers')->get();

        $data = [
            'province' => Prov::orderBy('branch_id')->get(),
            'district' => $dis,
            'ms' => Ms::all(),
            'ide' => Iden::all(),
            'cols' => $cols,
            'cusTmp' => $cusTmp
        ];

        return view('trans.loans.__create__', compact('data'));
    }

    private function __init__bank($val,$status,$dsc, $ln=null){
        WithClient::bankOutFlow($val,$status,$dsc, $ln);
    }

    /**
     * Store a newly created resource in storage.  Loan
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        $request->validate([
            'loan__investment' => 'required|numeric|min:0',
            'loan__price' => 'required|numeric|min:0',
            'loan__balance' => 'required|numeric|min:0',
            'loan__date_disburse' => 'required|date',
            'loan__purpose' => 'required',
            //'loan__purpose_description' => 'required|string|max:255',
            'loan__interest_rate' => 'required|numeric|min:0',
            'loan__interest_rate_per' => 'required',
            'loan__term' => 'required|numeric|min:1',
            // 'loan__amount_pay' => 'required|numeric|min:0',
            'loan__first_date_pay' => 'required|date',
            //'loan__pay_place loan__client loan__client_join loan__client_guarantee'
            'loan__client'  => 'required|exists:tbl_customer,id',
            //'loan__client_join'  => 'required|exists:cust_joins,id',
            //'loan__client_guarantee'  => 'required|exists:cust_guarans,id',
        ]);

        $loan = Loan::create([
            'booking' => $request->loan__investment,
            'amount_price' => $request->loan__price,
            'balance' => $request->loan__balance,
            'date_disburst' => $request->loan__date_disburse,
            'loan_purple' => $request->loan__purpose,
            'purple_dsc' => $request->loan__purpose_description,
            'interest_rate' => $request->loan__interest_rate,
            'rate_per' => $request->loan__interest_rate_per,
            'term' => $request->loan__term,
            'amount_pay' => He::paymentCalculator($request->loan__balance, $request->loan__term, $request->loan__interest_rate, $request->loan__interest_rate_per),
            'pay_day' => $request->loan__first_date_pay,
            'pay_place' => $request->loan__pay_place,
            'acc_number' => $this->getKey(),
            'status' => 1,
            'client' => $request->loan__client,
            'join_with' => $request->loan__client_join,
            'guaranteed' => $request->loan__client_guarantee,
            'guaranteed_join' => $request->loan__client_guarantee_join,
            'penalty' => $request->loan__penalty,
            'jx_type' => $request->jx_type,
            'gx_type' => $request->gx_type,
            'gxj_type' => $request->gxj_type,
        ]);


        // $nest = Nests::max('votes');
        // $loan->getNest()->create([
        //     'votes' => $nest + 1
        // ]);


        foreach (ColTmp::all() as $row){
            LoanCollateral::create([
                'model' => $row->model,
                'color' => $row->color,
                'body' => $row->body,
                'marchine' => $row->marchine,
                'year' => $row->year,
                'iden' => $row->iden,
                'extra' => $row->extra,
                'loan' => $loan->id,
                'type' => $row->type
            ]);
        }

        ColTmp::truncate();
        CusTmp::truncate();

        //CollectionSheet
        $val = new Amortization();
        $val->Amount($loan->balance);
        $val->StartDate($loan->pay_day);
        $val->Term($loan->term);
        $val->Rate($loan->interest_rate);
        foreach($val->schedules() as $d){
            $paycol = PayCol::create();
            CollectionSheet::create([
                'date_pay' => $d['date'],
                'amount'  => $d['total'],
                'print_due' => $d['principal'], 
                'inter_due' => $d['interest'],
                'balance' => $d['balance'], 
                'fee' => 0,
                'late' => 0, 
                'loan' => $loan->id,
                'print_due_return' => $d['principal'], 
                'inter_due_return' => $d['interest'], 
                'fee_return' => 0,
                'prefix' => $loan->date_disburst,
                'same_value' => $d['principal'],
                'pay_col_id' => $paycol->id,
            ]);

            Schedule::create([
                'date_pay' => $d['date'],
                'amount'  => $d['total'],
                'prin_due' => $d['principal'], 
                'inter_due' => $d['interest'],
                'balance' => $d['balance'], 
                'loan_id' => $loan->id,
                'date_disburs' => $loan->date_disburst,
                'tag' => 0
            ]);

        }

        $this->__init__bank($loan->balance, 3, 'Disbursement', $loan->id);

        return back()->with([
           'message' => "($loan->acc_number), Create Completed."
        ]);
    }

    private function getKey(){
        $data = Loan::latest()->value('id');
        $len = strlen($data) <= 5 ? 5 : strlen($data) + 1;
        return '9'. str_pad( $data + 48, $len, '0', STR_PAD_LEFT);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ln = Loan::findOrFail($id);
        return view("trans.loans.edits.index", ['lns' => $ln]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $ln = Loan::findOrFail($id);
        $vil = $ln->getClient->getVillage;
        return view('trans.loans.edits.forms.client',
            [
                'data' => $ln,
                'prov' => Prov::orderBy('branch_id')->get(),
                'dist' => Dist::byProvince($vil->commune->district->pro_id)->get(),
                'comm' => Comm::byDistrict($vil->commune->district_id)->get(),
                'vill' => Vill::byCommune($vil->commune_id)->get(),
                'iden' => Iden::all(),
                'msta' => Ms::all()
            ]);
    }

    public function editJoin($id){
        $ln = Loan::findOrFail($id);
        $vil = $ln->getJoin->getVillage;
        return view('trans.loans.edits.forms.join',
            [
                'data' => $ln,
                'prov' => Prov::orderBy('branch_id')->get(),
                'dist' => Dist::byProvince($vil->commune->district->pro_id)->get(),
                'comm' => Comm::byDistrict($vil->commune->district_id)->get(),
                'vill' => Vill::byCommune($vil->commune_id)->get(),
                'iden' => Iden::all(),
                'msta' => Ms::all()
            ]);
    }


    public function editCollat($id){
        $ln = LoanCollateral::findOrFail($id);
        return view('trans.loans.edits.forms.collater', [ 'data' => $ln ]);
    }

    public function updateCollateral(Request $request, $id){
        $request->validate([
           'col__model' => 'required|string|max:255',
           'col__color' => 'required|string|max:255',
           'col__body' => 'required|string|max:255',
           'col__machine' => 'required|string|max:255',
           'col__year' => 'required|string|max:255',
        //    'col__plate' => 'required|string|max:255',
           'col__extra' => 'required|string|max:255',
        ]);

        $d = LoanCollateral::findOrFail($id);

        $d->model = $request->col__model;
        $d->color = $request->col__color;
        $d->body = $request->col__body;
        $d->marchine = $request->col__machine;
        $d->year = $request->col__year;
        $d->iden = $request->col__plate;
        $d->extra = $request->col__extra;
        $d->type = $request->col__type;
        $d->save();

        return back()->with(['message' => "($d->model), Create Completed."]);
    }


    public function editGuaran($id){
        $ln = Loan::findOrFail($id);
        $vil = $ln->getGuaranteed->getVillage;
        return view('trans.loans.edits.forms.guaran',
            [
                'data' => $ln,
                'prov' => Prov::orderBy('branch_id')->get(),
                'dist' => Dist::byProvince($vil->commune->district->pro_id)->get(),
                'comm' => Comm::byDistrict($vil->commune->district_id)->get(),
                'vill' => Vill::byCommune($vil->commune_id)->get(),
                'iden' => Iden::all(),
                'msta' => Ms::all()
            ]);
    }

    public function editGuaranJoined($id){
        $ln = Loan::findOrFail($id);
        $vil = $ln->getGuaranteedJoin->getVillage;
        return view('trans.loans.edits.forms.gua_join',
            [
                'data' => $ln,
                'prov' => Prov::orderBy('branch_id')->get(),
                'dist' => Dist::byProvince($vil->commune->district->pro_id)->get(),
                'comm' => Comm::byDistrict($vil->commune->district_id)->get(),
                'vill' => Vill::byCommune($vil->commune_id)->get(),
                'iden' => Iden::all(),
                'msta' => Ms::all()
            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // dd($request);
        $request->validate([
            'loan__amount_price' => 'required|numeric|min:0',
            'loan__booking' => 'required|numeric|min:0',
            'loan__balance' => 'required|numeric|min:0',
            'loan__date_disburst' => 'required|date',
            'loan__purple' => 'required',
            'loan__pay_place' => 'required|string|max:255',
            'loan__interest_rate' => 'required|numeric|min:0',
            'loan__rate_per' => 'required',
            'loan__term' => 'required|numeric|min:1',
            'loan__pay_day' => 'required|date'
        ]);

        $ln = Loan::findOrFail($id);
        $old = $ln->status;


       $flag = $ln->getCollection->sum('print_due_return') < $ln->balance ? true: false;
         
        // dd($ln);

        if($flag){
            $ln->status = $request->loan__status;
            $ln->pay_place = $request->loan__pay_place;
            // បានកែសម្រាប់បង់រថយន្ត
            $ln->loan_purple = $request->loan__purple;
            $ln->save();

            // if($request->loan__status != $old)
            //     if($request->loan__status==1) {
            //         WithClient::bankOutFlow($ln->balance, 3, 'Re-Disbursement', $ln->id);
            //         //WithClient::bankInFlow(-$ln->balance,5,'Re-Reject');
            //     }
            //     else{
            //         //WithClient::bankInFlow($ln->balance,5,'Loan Reject');
            //         //WithClient::bankOutFlow(-$ln->balance, 3, 'Re-Disbursement');
            //         WithClient::bankOutFlow(-$ln->balance, 5, 'Loan Reject', $ln->id);
            //     }
        }else {    

            $bs = Bn::all()->first();
            $balance = $bs->bank_principle;
            $balance = $balance + $ln->balance;
            $bs->bank_principle = $balance;
            $bs->save();

            BankCashSheet::where('loan', $ln->id)->delete();
            CollectionSheet::where('loan', $ln->id)->delete();
            Schedule::where('loan_id', $ln->id)->delete();  

            $ln->booking = $request->loan__booking;
            $ln->amount_price = $request->loan__amount_price;
            $ln->balance = $request->loan__balance;
            $ln->date_disburst = $request->loan__date_disburst;
            $ln->loan_purple = $request->loan__purple;
            $ln->interest_rate = $request->loan__interest_rate;
            $ln->rate_per = $request->loan__rate_per;
            $ln->term = $request->loan__term;
            $ln->amount_pay = $request->loan__amount_pay;
            $ln->pay_day = $request->loan__pay_day;
            $ln->pay_place = $request->loan__pay_place;
            $ln->penalty = $request->loan__penalty;
            $ln->save();

                  
            //CollectionSheet
            $val = new Amortization();
            $val->Amount($ln->balance);
            $val->StartDate($ln->pay_day);
            $val->Term($ln->term);
            $val->Rate($ln->interest_rate);
            foreach($val->schedules() as $d){
                $paycol = PayCol::create();
                CollectionSheet::create([
                    'date_pay' => $d['date'],
                    'amount'  => $d['total'],
                    'print_due' => $d['principal'], 
                    'inter_due' => $d['interest'],
                    'balance' => $d['balance'], 
                    'fee' => 0,
                    'late' => 0, 
                    'loan' => $ln->id,
                    'print_due_return' => $d['principal'], 
                    'inter_due_return' => $d['interest'], 
                    'fee_return' => 0,
                    'prefix' => $ln->date_disburst,
                    'same_value' => $d['principal'],
                    'pay_col_id' => $paycol->id,
                ]);

                Schedule::create([
                    'date_pay' => $d['date'],
                    'amount'  => $d['total'],
                    'prin_due' => $d['principal'], 
                    'inter_due' => $d['interest'],
                    'balance' => $d['balance'], 
                    'loan_id' => $ln->id,
                    'date_disburs' => $ln->date_disburst,
                    'tag' => 0
                ]);

            }
            // WithClient::bankOutFlow(-$ln->balance, 5, 'Loan Modify');

            $this->__init__bank($ln->balance, 3, 'Disbursement Modify', $ln->id);

        }

        return back()->with(['message' => "($ln->acc_number), Create Completed."]);
    }

    public function updateClient(Request $request,$id){
        $request->validate([
            'cus__last_name' => 'required|string|max:160',
            'cus__first_name' => 'required|string|max:160',

            'cus__last_name_en' => 'required|string|max:100',
            'cus__first_name_en' => 'required|string|max:100',

            'cus__gender' => 'required',
            // 'cus__dob' => 'required',
            // 'cus__mstatus' => 'required|exists:params_marital_statuses,id',
            'cus__id_type' => 'required|exists:params_identifies,id',
            'cus__id_number' => 'required|string|max:100',
            // 'cus__id_register' => 'required',
            'cus__occupation' => 'required|string|max:160',

            'cus__phone' => 'required|string|max:100',

            'cus__group' => 'max:30',
            'cus__home' => 'max:30',
            // 'cus__street' => 'max:50',
            'cus__village' => 'required|exists:ln_village,vill_id',
        ]);

        $cus = Loan::findOrFail($id)->getClient;
        //dd($cus);
        $cus->last_name = $request->cus__last_name;
        $cus->first_name = $request->cus__first_name;

        $cus->last_name_en = $request->cus__last_name_en;
        $cus->first_name_en = $request->cus__first_name_en;

        $cus->gender = $request->cus__gender;
        $cus->dob = $request->cus__dob;
        // $cus->status = $request->cus__mstatus;
        $cus->identify_type = $request->cus__id_type;
        $cus->identify_no = $request->cus__id_number;
        $cus->identify_register = $request->cus__id_register;
        $cus->occupation = $request->cus__occupation;

        $cus->phone = \Hel::phoneVerify($request->cus__phone);
        $cus->phone2 = \Hel::phoneVerify($request->cus__phone2);

        $cus->group = $request->cus__group;
        $cus->home = $request->cus__home;
        $cus->add_occupation = $request->cus__occupation_add;
        $cus->village = $request->cus__village;
        $cus->save();

        return back()->with(['message' => "($cus->first_name_en), Create Completed."]);
    }

    public function updateJoin(Request $request,$id){
        $request->validate([
            'cus__last_name' => 'required|string|max:160',
            'cus__first_name' => 'required|string|max:160',

            'cus__last_name_en' => 'required|string|max:100',
            'cus__first_name_en' => 'required|string|max:100',

            'cus__gender' => 'required',
            // 'cus__dob' => 'required',
            // 'cus__mstatus' => 'required|exists:params_marital_statuses,id',
            'cus__id_type' => 'required|exists:params_identifies,id',
            'cus__id_number' => 'required|string|max:100',
            // 'cus__id_register' => 'required',
            'cus__occupation' => 'required|string|max:160',
            'cus__phone' => 'required|string|max:100',
            'cus__group' => 'max:30',
            'cus__home' => 'max:30',
            // 'cus__street' => 'max:50',
            'cus__village' => 'required|exists:ln_village,vill_id',
        ]);

        $loan = Loan::findOrFail($id); //CustJoin
                
        $join = CustJoin::updateOrCreate(
            ['id' => $request->cus__id],
            [
                'last_name' => $request->cus__last_name,
                'first_name' => $request->cus__first_name,
        
                'first_name_en' => $request->cus__first_name_en,
                'last_name_en' => $request->cus__last_name_en,
        
                'gender' => $request->cus__gender,
                'dob' => $request->cus__dob,
                // $cus->status = $request->cus__mstatus;
                'it' => $request->cus__id_type,
                'it_no' => $request->cus__id_number,
                'it_date' => $request->cus__id_register,
                'occupation' => $request->cus__occupation,
        
                'phone' => \Hel::phoneVerify($request->cus__phone),
                'phone2' => \Hel::phoneVerify($request->cus__phone2),
        
                'group' => $request->cus__group,
                'home' => $request->cus__home,
                'occ_address' => $request->cus__occupation_add,
                'village' => $request->cus__village,
                'meta_tag' => $request->cus__type,       
            ]
        );

        //Save Loan
        $loan->join_with = $join->id;
        $loan->jx_type = $join->meta_tag;
        $loan->save();

        return back()->with(['message' => "($join->first_name_en), Create Completed."]);
    }


    public function updateGuaran(Request $request, $id){
        $request->validate([
            'cus__last_name' => 'required|string|max:160',
            'cus__first_name' => 'required|string|max:160',

            'cus__last_name_en' => 'required|string|max:100',
            'cus__first_name_en' => 'required|string|max:100',

            'cus__gender' => 'required',
            // 'cus__dob' => 'required',
            // 'cus__mstatus' => 'required|exists:params_marital_statuses,id',
            'cus__id_type' => 'required|exists:params_identifies,id',
            'cus__id_number' => 'required|string|max:100',
            // 'cus__id_register' => 'required',
            'cus__occupation' => 'required|string|max:160',
            'cus__phone' => 'required|string|max:100',
            'cus__group' => 'max:30',
            'cus__home' => 'max:30',
            // 'cus__street' => 'max:50',
            'cus__village' => 'required|exists:ln_village,vill_id',
        ]);

        $ln = Loan::findOrFail($id);
        // $cus = $ln->getGuaranteed;


        $cus = CustGuaran::updateOrCreate(
            ['id' => $request->cus__id],
            [
                'last_name' => $request->cus__last_name,
                'first_name' => $request->cus__first_name,
        
                'first_name_en' => $request->cus__first_name_en,
                'last_name_en' => $request->cus__last_name_en,
        
                'gender' => $request->cus__gender,
                'dob' => $request->cus__dob,
                'meta_tag' => $request->cus__type,
                'it' => $request->cus__id_type,
                'it_no' => $request->cus__id_number,
                'it_date' => $request->cus__id_register,
                'occupation' => $request->cus__occupation,
        
                'phone' => \Hel::phoneVerify($request->cus__phone),
                'phone2' => \Hel::phoneVerify($request->cus__phone2),
        
                'group' => $request->cus__group,
                'home' => $request->cus__home,
                'occ_address' => $request->cus__occupation_add,
                'village' => $request->cus__village,
                'meta_tag' => $request->cus__type,
            ]
        );

        $ln->guaranteed = $cus->id;
        $ln->gx_type = $cus->meta_tag;
        $ln->save();

        return back()->with(['message' => "($cus->first_name_en), Create Completed."]);
    }


    public function updateGuaranJoined(Request $request,$id){
        $request->validate([
            'cus__last_name' => 'required|string|max:160',
            'cus__first_name' => 'required|string|max:160',
            'cus__first_name_en' => 'required|string|max:100',
            'cus__last_name_en' => 'required|string|max:100',
            'cus__gender' => 'required',
            // 'cus__dob' => 'required',
            // 'cus__mstatus' => 'required|exists:params_marital_statuses,id',
            'cus__id_type' => 'required|exists:params_identifies,id',
            'cus__id_number' => 'required|string|max:100',
            // 'cus__id_register' => 'required',
            'cus__occupation' => 'required|string|max:160',
            'cus__phone' => 'required|string|max:100',
            'cus__group' => 'max:30',
            'cus__home' => 'max:30',
            // 'cus__street' => 'max:50',
            'cus__village' => 'required|exists:ln_village,vill_id',
        ]);

        $ln = Loan::findOrFail($id);
        // $cus = $ln->getGuaranteedJoin;
        // updateOrCreate
        $cus = Gclient::updateOrCreate(
            [ 'id' => $request->cus__id ],
            [
                "last_name" => $request->cus__last_name,
                "first_name" => $request->cus__first_name,

                "first_name_en" => $request->cus__first_name_en,
                "last_name_en" => $request->cus__last_name_en,

                "gender" => $request->cus__gender,
                "dob" => $request->cus__dob,
                "extra" => $request->cus__type,
                "it" => $request->cus__id_type,
                "it_number" => $request->cus__id_number,
                "it_date" => $request->cus__id_register,
                "occupation" => $request->cus__occupation,

                "phone" => \Hel::phoneVerify($request->cus__phone),
                "phone2" => \Hel::phoneVerify($request->cus__phone2),

                "group" => $request->cus__group,
                "home" => $request->cus__home,
                "company_name" => $request->cus__occupation_add,
                "village" => $request->cus__village,
                "extra" => $request->cus__type
            ]
        );
        $ln->guaranteed_join = $cus->id;
        $ln->gxj_type = $cus->extra;
        $ln->save();

        return back()->with(['message' => "($cus->first_name_en), Create Completed."]);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        abort(404);
    }

    public function destroy_collateral($id,$loan){
        LoanCollateral::destroy($id);
        return redirect()->route('loans.show', $loan);
    }

    public function new_collateral($id){
        return view('trans.loans.edits.forms.new_collateral', [ 'data' => $id ]);
    }

    public function addCollateral(Request $request, $id){
        $request->validate([
            'col__model' => 'required|string|max:255',
            'col__color' => 'required|string|max:255',
            'col__body' => 'required|string|max:255',
            'col__machine' => 'required|string|max:255',
            'col__year' => 'required|string|max:255',
            //'col__plate' => 'required|string|max:255',
            'col__extra' => 'required|string|max:255',
        ]);

        $d = new LoanCollateral();
        $d->model = $request->col__model;
        $d->color = $request->col__color;
        $d->body = $request->col__body;
        $d->marchine = $request->col__machine;
        $d->year = $request->col__year;
        $d->iden = $request->col__plate;
        $d->extra = $request->col__extra;
        $d->loan = $id;
        $d->type = $request->col__type;
        $d->save();

        return back()->with(['message' => "($d->model), Create Completed."]);
    }

    public function __tmpdata()
    {
        return DataTables::of(CusTmp::orderBy('numbers')->get())
            ->addIndexColumn()
            ->addColumn('__nam__', function($e){
                if($e->numbers == 1)
                    return " <label class='text-dark mb-0'>
                        <i class=\"fas fa-user mr-2\"></i>" . $e->getClient->fullName() . "
                    </label>";

                else if($e->numbers == 2)
                    return " <label class='text-dark mb-0'>
                            <i class=\"fas fa-user mr-2\"></i>" . $e->getJoin->fullName()  . "
                        </label>";
                else if($e->numbers == 3)
                    return " <label class='text-dark mb-0'>
                            <i class=\"fas fa-user mr-2\"></i>" . $e->getGuarantee->fullName()  . "
                        </label>";
                else
                    return " <label class='text-dark mb-0'>
                            <i class=\"fas fa-user mr-2\"></i>" . $e->getGuaranteeJoin->fullName() . "
                        </label>";
            })
            ->addColumn('__act__', function ($event){
                if($event->numbers == 1)
                    return "<input type=\"hidden\" name=\"loan__client\" value=\"$event->client\">
                            <label class=\"text-primary mb-0\">អ្នកខ្ចី</label>";
                else if($event->numbers == 2)
                    return "<input type=\"hidden\" name=\"loan__client_join\" value=\"$event->join\">
                            <label class=\"text-success mb-0\">អ្នករួមខ្ចី</label>";
                else if($event->numbers == 3)
                    return "<input type=\"hidden\" name=\"loan__client_guarantee\" value=\"$event->guarantee\">
                            <label class=\"text-dark mb-0\">អ្នកធានា</label>";
                else
                    return "<input type=\"hidden\" name=\"loan__client_guarantee_join\" value=\"$event->guarantee_join\">
                            <label class=\"text-info mb-0\">អ្នករួមធានា</label>";
            })
            ->addColumn('__action__', function($e){
                return "
                    <button type=\"button\" class=\"btn btn-outline-danger btn-xs\" onclick=\"de__data($e->id)\">
                        <i class=\"fas fa-trash mr-1\"></i> លុបចេញ
                    </button>
                ";
            })
            ->addColumn('cus_key', function($e){
                if($e->numbers ==1 )
                    // return $e->getClient->cus_key;
                    return 
                            "<div class=\"input-group input-group-sm\">
                                <div class=\"input-group-prepend\">
                                    <span class=\"input-group-text\">លេខកូដ</span>
                                </div>
                                <input type=\"text\"
                                    name=\"jx_type_cus_key\"
                                    value=\"". $e->getClient->cus_key . "\"
                                    class=\"form-control\" placeholder=\"លេខកូដ\" readonly>
                            </div>"; 

                else if($e->numbers ==2)
                    return   "<div class=\"input-group input-group-sm\">
                                <div class=\"input-group-prepend\">
                                    <span class=\"input-group-text\">ត្រូវជា</span>
                                </div>
                                <input type=\"text\"
                                    name=\"jx_type\"
                                    value=\"". $e->extra . "\"
                                    class=\"form-control\" placeholder=\"ត្រូវជា\">
                            </div>";
                else if($e->numbers ==3)
                    return "<div class=\"input-group input-group-sm\">
                                <div class=\"input-group-prepend\">
                                    <span class=\"input-group-text\">ត្រូវជា</span>
                                </div>
                                <input type=\"text\"
                                    name=\"gx_type\"
                                    value=\"". $e->extra . "\"
                                    class=\"form-control\" placeholder=\"ត្រូវជា\">
                            </div>";
                else
                    return "<div class=\"input-group input-group-sm\">
                                <div class=\"input-group-prepend\">
                                    <span class=\"input-group-text\">ត្រូវជា</span>
                                </div>
                                <input type=\"text\"
                                    name=\"gxj_type\"
                                    value=\"". $e->extra . "\"
                                    class=\"form-control\" placeholder=\"ត្រូវជា\">
                            </div>";            
            })
            ->rawColumns([
                '__nam__',
                '__act__', 
                '__action__', 
                'cus_key'
            ])
            ->make(true);
    }

    public function __all(Request $request)
    {
        return DataTables::of(Loan::query()->orderBy("created_at", "DESC"))
            ->addIndexColumn()
            ->addColumn('button1', function($v){
                return "
                    <a href='".route('loans.show', $v->id)."' class='btn bg-gradient-olive btn-xs'>
                        <i class='fas fa-edit'></i> Edit
                    </a>

                    <a href='".route('loans.schedule', $v->id)."' class='btn bg-gradient-primary btn-xs'>
                        <i class='fas fa-print'></i> Print
                    </a>

                    <a href='".route('collection.return.search.ref', $v->id)."' class='btn bg-gradient-warning btn-xs'>
                        <i class='fas fa-calculator'></i> បង់ប្រាក់
                    </a>";
            })
            ->editColumn('balance', function($v){
                $result = "
                    <b>$ "
                        .number_format($v->balance, 2).
                    "<div class='btn-group ml-3'>
                        <span class='badge br-dark brr text-dark'>
                            រយៈពេល
                        </span> 
                        <span class='badge bg-gradient-dark brl text-sm'>
                            $v->term <small>ខែ</small>
                        </span>
                    </div>
                    
                    </b>  <div class =\"float-right\">";
                if($v->getCollection()->isOverdue()->count() > 0)
                    $result .= "
                    <div class=\"btn-group mr-1\">
                        <span class=\"badge br-danger brr text-danger\">
                            យឺត
                        </span>
                        <span class=\"badge bg-gradient-danger text-sm brl\">" .
                             \Carbon\Carbon::parse($v->getCollection()->isOverdue()->min('date_pay'))->diffInDays() 
                        . "    <small>ថ្ងៃ</small>
                        </span>
                    </div>";
                
                $result .= $v->getStatus('text-sm pt-2px') .
                "   <span class=\"badge bg-gradient-olive text-sm pt-2px\">"
                . $v->getPerOfFinish() ." %
                    </span>
                </div>";    
                return $result;  
            })
            ->addColumn('clients', function($v){
                $row = '<b>' . $v->getClient->fullName() . '</b>';

                $row .= '<small class="mr-1 ml-3"><i class="fas fa-phone"></i></small>' 
                        .\Hel::phoneDisplay($v->getClient->phone);
                if($v->getClient->phone2 != null)
                    $row .= ' , '. \Hel::phoneDisplay($v->getClient->phone2);     

                $row .= "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>".$v->getClient->occupation." </span>";    

                // $gender = $v->getClient->gender ? "ប្រុស" : "ស្រី";
                // $row .= " &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                //     <span class='badge bg-gradient-dark text-sm'>". $gender ."</span>
                //     ";
                return $row;
            })
            ->filter(function ($query) use ($request){
                if ($request->has('search'))
                    $query->where('acc_number', 'LIKE', "%$request->q%")
                    ->orWhereHas('getClient', function($query) use ($request){
                        $query->where('cus_key', 'like', "%$request->q%")
                            ->orWhere('key_ref', 'like', "%$request->q%")
    
                            ->orWhere('first_name', 'like', "%$request->q%")
                            ->orWhere('last_name', 'like', "%$request->q%")
    
                            ->orWhere('last_name_en', 'like', "%$request->q%")
                            ->orWhere('first_name_en', 'like', "%$request->q%")
    
                            ->orWhere('phone2', 'like', "%$request->q%")
                            ->orWhere('phone', 'like', "%$request->q%");
                    })
                    ->orWhereHas('getJoin', function($query) use ($request){
                        $query->where('first_name', 'like', "%$request->q%")
                            ->orWhere('last_name', 'like', "%$request->q%")
    
                            ->orWhere('first_name_en', 'like', "%$request->q%")
                            ->orWhere('last_name_en', 'like', "%$request->q%")
    
                            ->orWhere('phone2', 'like', "%$request->q%")
                            ->orWhere('phone', 'like', "%$request->q%");
                    })
                    ->orWhereHas('getGuaranteed', function($query) use ($request){
                        $query->where('first_name', 'like', "%$request->q%")
                            ->orWhere('last_name', 'like', "%$request->q%")
    
                            ->orWhere('first_name_en', 'like', "%$request->q%")
                            ->orWhere('last_name_en', 'like', "%$request->q%")
    
                            ->orWhere('phone2', 'like', "%$request->q%")
                            ->orWhere('phone', 'like', "%$request->q%");
                    })
                    ->orWhereHas('getGuaranteedJoin', function($query) use ($request){
                        $query->where('first_name', 'like', "%$request->q%")
                            ->orWhere('last_name', 'like', "%$request->q%")
    
                            ->orWhere('first_name_en', 'like', "%$request->q%")
                            ->orWhere('last_name_en', 'like', "%$request->q%")
    
                            ->orWhere('phone2', 'like', "%$request->q%")
                            ->orWhere('phone', 'like', "%$request->q%");
                    })->orWhereHas('getCollaterals', function($qu) use ($request){
                        $qu->where('iden', 'like', "%$request->q%")
                        ->orWhere('extra', 'like', "%$request->q%")
                        ->orWhere('year', 'like', "%$request->q%")
                        ->orWhere('model', 'like', "%$request->q%");
                    });
            })
            ->rawColumns([
                'button1',
                'balance',
                'clients'
            ])
            ->make(true);
    }

    public function __all1()
    {
        $client = Loan::query();
        return DataTables::of($client)
            ->addIndexColumn()
            ->editColumn('acc_number', function ($row){
                return "
                    <b>$row->acc_number</b>
                    <b class='text-lg ml-4'>$ " .  number_format($row->balance,2) . "</b>
                    <br>
                    <div class='btn-group'>
                        <span class='badge br-dark brr text-dark'>
                            រយៈពេល
                         </span> 
                         <span class='badge bg-gradient-dark brl text-sm'>$row->term ខែ</span>
                    </div>
                    <div class='btn-group'>
                        <span class='badge br-dark brr text-dark'>
                            ការប្រាក់ 
                         </span> 
                         <span class='badge bg-gradient-dark brl text-sm'>". number_format($row->interest_rate, 2) ." %</span>
                    </div>";
            })
            ->addColumn('name', function($val){
                $data = "<b class='text-primary'>";
                $data .= $val->getClient->last_name ." ". $val->getClient->first_name ." <span class='ml-3'>". $val->getClient->name_en ."</span></b> <span class='ml-2'>".$val->getClient->phone."</span><br/>";

                if($val->join_with != null)
                    $data .="<div class='btn-group mr-1'>
                                <span class='badge br-dark brr text-dark'>អ្នករួមខ្ចី</span>
                                <span class='badge bg-gradient-dark brl text-sm'>" . $val->getJoin->last_name . " " . $val->getJoin->first_name . "</span>
                            </div>";

                if($val->guaranteed != null)
                    $data .="<div class='btn-group mr-1'>
                                <span class='badge br-dark brr text-dark'>អ្នកធានា</span>
                                <span class='badge bg-gradient-dark brl text-sm'>" . $val->getGuaranteed->last_name . " " . $val->getGuaranteed->first_name . "</span>
                            </div>";

                if($val->guaranteed_join != null)
                    $data .="<div class='btn-group'>
                                <span class='badge br-dark brr text-dark'>អ្នករួមធានា</span>
                                <span class='badge bg-gradient-dark brl text-sm'>" . $val->getGuaranteedJoin->last_name . " " . $val->getGuaranteedJoin->first_name . "</span>
                            </div>";

                $data .="<br/>
                        <small>"
                           . $val->getClient->getVillage->village_namekh . ", &nbsp;"
                           . $val->getClient->getVillage->commune->commune_namekh . ", &nbsp;"
                           . $val->getClient->getVillage->commune->district->district_namekh . ", &nbsp;"
                           . $val->getClient->getVillage->commune->district->province->province_kh_name .
                        "</small>";

                return $data;
            })
            ->addColumn('sub_action', function ($row){
                $data = "<div class='btn-group'>
                    <span class='badge br-dark text-dark brr'>Finished</span>
                    <span class='badge bg-gradient-dark mr-2 brl'> 
                        ". number_format(100 - ($row->getCollection->sum('print_due_return')/$row->balance) * 100).
                    " %</span>";
                $data .= "</div><div class='btn-group'>";
                $data .= "<span class='badge br-dark text-dark brr'>Outstanding</span>
                          <span class='badge bg-gradient-dark brl mr-2'>$ "
                            .number_format($row->getCollection->sum('print_due_return')).
                          "</span></div>";
                if($row->status == 1) {
                    $data .= "<div class='btn-group'> <span class='badge br-indigo text-indigo brr'>Status</span>";
                    $data .= "<span class=\"badge bg-gradient-indigo brl\"><i class=\"far fa-chart-bar mr-1\"></i>Active</span>";
                }else if ($row->status ==2) {
                    $data .= "<div class='btn-group'> <span class='badge br-dark text-dark brr'>Status</span>";
                    $data .= "<span class=\"badge bg-gradient-dark brl\"><i class=\"fas fa-times mr-1\"></i>Reject</span>";
                }else {
                    $data .= "<div class='btn-group'> <span class='badge br-success text-success brr'>Status</span>";
                    $data .= "<span class=\"badge bg-gradient-success brl\"><i class=\"fas fa-check mr-1\"></i>Finish</span>";
                }
                $data .= "</div>";
                return $data;
            })
            ->addColumn('action', function ($row){
                $data = "
                    <a href=". route('loans.show', $row->id ) ." class=\"btn bg-gradient-navy btn-sm\" title=\"View\">
                        <i class=\"fas fa-external-link-square-alt\"></i>
                    </a>                      
                    <a href=". route('loans.schedule', $row->id ) ." class=\"btn bg-gradient-olive btn-sm\" title=\"Print\">
                        <i class=\"fas fa-print\"></i>
                    </a> 
                ";
                return $data;
            })
            ->rawColumns([
                'acc_number',
                'name',
                'sub_action',
                'action'
            ])
            ->make(true);
    }

    public function __village($id)
    {
        $comm = Vill::byCommune($id)->select('vill_id as id', 'village_namekh as text', 'village_name as text_en')->get();
        return response()->json($comm);
    }

    public function __createTmp_cus(Request $request){
        $request->validate([
            'cu_customers_radio' => 'required'
        ]);

        $u = Customer::findOrFail($request->cu_customers_radio);

        $ct=CusTmp::updateOrCreate(
            ['numbers' => 1],
            [
                'client' => $u->id,
                //'extra' => $u->extra
            ]
        );

        return response()->json($ct);
    }

    public function __schedule($val){
        return view('trans.inv.init', [ 'data' => Loan::where('id',$val)->first() ]);
    }//end

    public function __add_join_form(Request $request, $loan)
    {
        $ln = Loan::findOrFail($loan);
        
        if($request->join == null){
            $data = $ln->join_with == null ? new CustJoin() : $ln->getJoin;

            $cusj = CustJoin::where('id', $request->q)
                ->orWhere('first_name', 'like', "%$request->q%")
                ->orWhere('last_name', 'like', "%$request->q%")
                ->orWhere('first_name_en', 'like', "%$request->q%")
                ->orWhere('last_name_en', 'like', "%$request->q%")
                ->orWhere('occupation', 'like', "%$request->q%")
                ->orWhere('phone', 'like', "%$request->q%")
                ->orWhere('phone2', 'like', "%$request->q%")
                ->orWhere('meta_tag', 'like', "%$request->q%")
                ->paginate(20);
        }else{
            $data = CustJoin::findOrFail($request->join);
            $cusj = CustJoin::where('id', $request->join)->paginate(20);
        }    
          
        
        $pro = Prov::orderBy('branch_id')->first();
        $dis = Dist::byProvince($pro->province_id)->first();      
        $com = Comm::byDistrict($dis->dis_id)->first();
       
        

        $re = [        
            'data' => $data,
            'prov' => Prov::orderBy('branch_id')->get(),
            'dist' => Dist::byProvince($pro->province_id)->get(),
            'comm' => Comm::byDistrict($dis->dis_id)->get(),
            'vill' => Vill::byCommune($com->com_id)->get(),
            'iden' => Iden::all(),
            'msta' => Ms::all(),
            'loan' => $loan,
            'cusj' => $cusj,
        ];

        return view('news.join', $re);
    }



    public function __add_guara_form(Request $request, $loan)
    {
        $ln = Loan::findOrFail($loan);
        
        if($request->join == null){
            $data = $ln->guaranteed == null ? new CustGuaran() : $ln->getGuaranteed;

            $cusj = CustGuaran::where('id', $request->q)
                ->orWhere('first_name', 'like', "%$request->q%")
                ->orWhere('last_name', 'like', "%$request->q%")
                ->orWhere('first_name_en', 'like', "%$request->q%")
                ->orWhere('last_name_en', 'like', "%$request->q%")
                ->orWhere('occupation', 'like', "%$request->q%")
                ->orWhere('phone', 'like', "%$request->q%")
                ->orWhere('phone2', 'like', "%$request->q%")
                ->orWhere('meta_tag', 'like', "%$request->q%")
                ->paginate(20);
        }else{
            $data = CustGuaran::findOrFail($request->join);
            $cusj = CustGuaran::where('id', $request->join)->paginate(20);
        }    
             
        $pro = Prov::orderBy('branch_id')->first();
        $dis = Dist::byProvince($pro->province_id)->first();      
        $com = Comm::byDistrict($dis->dis_id)->first();
       
        $re = [        
            'data' => $data,
            'prov' => Prov::orderBy('branch_id')->get(),
            'dist' => Dist::byProvince($pro->province_id)->get(),
            'comm' => Comm::byDistrict($dis->dis_id)->get(),
            'vill' => Vill::byCommune($com->com_id)->get(),
            'iden' => Iden::all(),
            'msta' => Ms::all(),
            'loan' => $loan,
            'cusj' => $cusj,
        ];

        return view('news.guaranteed', $re);
    }


    public function __add_another_form(Request $request, $loan)
    {
        $ln = Loan::findOrFail($loan);
        
        if($request->join == null){
            $data = $ln->guaranteed_join == null ? new Gclient() : $ln->getGuaranteedJoin;

            $cusj = Gclient::where('id', $request->q)
                ->orWhere('first_name', 'like', "%$request->q%")
                ->orWhere('last_name', 'like', "%$request->q%")
                ->orWhere('first_name_en', 'like', "%$request->q%")
                ->orWhere('last_name_en', 'like', "%$request->q%")
                ->orWhere('occupation', 'like', "%$request->q%")
                ->orWhere('phone', 'like', "%$request->q%")
                ->orWhere('phone2', 'like', "%$request->q%")
                ->orWhere('extra', 'like', "%$request->q%")
                ->paginate(20);
        }else{
            $data = Gclient::findOrFail($request->join);
            $cusj = Gclient::where('id', $request->join)->paginate(20);
        }    
             
        $pro = Prov::orderBy('branch_id')->first();
        $dis = Dist::byProvince($pro->province_id)->first();      
        $com = Comm::byDistrict($dis->dis_id)->first();
       
        $re = [        
            'data' => $data,
            'prov' => Prov::orderBy('branch_id')->get(),
            'dist' => Dist::byProvince($pro->province_id)->get(),
            'comm' => Comm::byDistrict($dis->dis_id)->get(),
            'vill' => Vill::byCommune($com->com_id)->get(),
            'iden' => Iden::all(),
            'msta' => Ms::all(),
            'loan' => $loan,
            'cusj' => $cusj,
        ];

        return view('news.another', $re);
    }

}//endclass
