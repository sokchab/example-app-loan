<?php

namespace App\Http\Controllers\Trans;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
use App\Opts\CustJoin as Cj;
use App\Opts\CustGuaran as Cg;
use App\Opts\CusTmp;
use App\Trans\ColTmp;
use Illuminate\Support\Facades\Validator;

class __TempRow__ extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function __rows()
    {
        return DataTables::of(Cj::query())
            ->addIndexColumn()
            ->addColumn('name_full', function ($row){
                return "<input type=\"radio\" id=\"join__d_$row->id\" name=\"join__loan\" value=\"$row->id\"><label for=\"join__d_$row->id\">&nbsp; ".$row->fullName()." </label>";
            })
            ->editColumn('gender', '{{ $gender ? "ប្រុស" : "ស្រី" }}')
            ->editColumn('phone', function($r){
                return $r->phone . ' , ' . $r->phone2;
            })
            ->addColumn('address', function ($val){
                return   $val->getVillage->village_namekh .
                "  , " . $val->getVillage->commune->commune_namekh;
            })
            ->addColumn('identify', function($val){
                return
                    $val->getIdentify->name_kh . "-" .
                    $val->it_no
                ;
            })
            ->rawColumns([
                'name_full'
            ])
            ->make(true);
    }

    public function __rows_gg()
    {
        return DataTables::of(Cg::query())
            ->addIndexColumn()
            ->editColumn('name', function ($row){
                return "<input type=\"radio\" id=\"gg__d_$row->id\" name=\"gg__loan\" value=\"$row->id\"><label for=\"gg__d_$row->id\">&nbsp;". $row->fullName() ."</label>";
            })
            ->editColumn('gender', '{{ $gender ? "ប្រុស" : "ស្រី" }}')
            ->editColumn('phone', '{{ $phone }} , {{ $phone2 }}')
            ->addColumn('address', function ($val){
                return   $val->getVillage->village_namekh .
                "  , " . $val->getVillage->commune->commune_namekh;
            })
            ->addColumn('identify', function($val){
                return
                    $val->getIdentify->name_kh . "-" .
                    $val->it_no
                ;
            })
            ->rawColumns([
                'name'
            ])
            ->make(true);
    }

    public function __ajaxSave(Request $request){
        $request->validate([
            'join__last_name' => 'required|string|max:160',
            'join__first_name' => 'required|string|max:160',
        
            'join__gender' => 'required',
            // 'join__dob' => 'required',
            'join__last_name_en' => 'required|string|max:100',
            'join__first_name_en' => 'required|string|max:100',
            // 'join__mstatus' => 'required|exists:params_marital_statuses,id',
            'join__id_type' => 'required|exists:params_identifies,id',
            'join__id_number' => 'required|string|max:100',
            // 'join__id_register' => 'required',
            'join__occupation' => 'required|string|max:160',
            'join__phone' => 'required|string|max:100',
            'join__group' => 'max:30',
            'join__home' => 'max:30',
            // 'join__street' => 'max:50',
            'join__village' => 'required|exists:ln_village,vill_id',
        ]);

        $u = Cj::create([
            'last_name' => $request->join__last_name,
            'first_name' => $request->join__first_name,

            'first_name_en' => $request->join__first_name_en,
            'last_name_en' => $request->join__last_name_en,

            'gender' => $request->join__gender,
            'dob' => $request->join__dob,
            'it' => $request->join__id_type,
            'it_no' => $request->join__id_number,
            'it_date' => $request->join__id_register,
            'occupation' => $request->join__occupation,

            'phone' => \Hel::phoneVerify($request->join__phone),
            'phone2' => \Hel::phoneVerify($request->join__phone2),

            'occ_address' => $request->join__occupation_address,
            'group' => $request->join__group,
            'home' => $request->join__home,
            'meta_tag' => $request->join__type,
            'village' => $request->join__village
        ]);

        $ct = CusTmp::updateOrCreate(
            ['numbers' => 2],
            [
                'join' => $u->id,
                'extra' => $u->meta_tag
            ]
        );

        return response()->json($ct);
    }


    public function __deleteCusLoan($val)
    {
        CusTmp::destroy($val);
        return response()->json(['message'=> 'Success'], 200);
    }

    //Collecterall----------------------------------------------------------------------
    public function __deleteCollecteralTmp($val)
    {
        ColTmp::destroy($val);
        return response()->json(['message'=> 'Success'], 200);
    }

    public function FunctionNameCol()
    {
        return DataTables::of(ColTmp::query())
            ->addIndexColumn()
            ->editColumn('iden', function ($val){
                return " $val->iden
                    <div class='float-right'>
                        <button type='button' class='btn btn-outline-primary btn-xs' onclick='Episode92($val->id)'>
                            <i class='fas fa-pen mr-1'></i> កែប្រែ
                        </button>
                        <button type='button' class='btn btn-outline-danger btn-xs' onclick='TheThreeKingdom($val->id)'>
                            <i class='fas fa-trash mr-1'></i> លុប
                        </button>
                    </div>
                ";
            })
            ->rawColumns([ 'iden' ])
            ->make(true);
    }

    public function formSaveOrNewCollec(Request $request)
    {
        $cols = ColTmp::findOrNew($request->__colecteral_value);
        //
        return view("new_fix.collecteral" , compact('cols'));
    }

    public function deleteCollsFix($valid)
    {
        ColTmp::destroy($valid);
        return redirect()->route("loans.create");
    }

    public function saveOrNewCollec(Request $request)
    {
        $valid = Validator::make($request->all(), [
            'collateral__model' => 'required|string|max:255',
            'collateral__color' => 'required|string|max:255',
            'collateral__body' => 'required|string|max:255',
            'collateral__machine' => 'required|string|max:255',
            'collateral__year' => 'required|string|max:255',
            // 'collateral__number' => 'required|string|max:255',
            'collateral__extra' => 'required|string|max:255',
        ]);

        if ($valid->fails())
            return redirect()->back()->withInput()->withErrors($valid->getMessageBag());

        $cols = ColTmp::findOrNew($request->__colecteral_value);

        $cols->model = $request->collateral__model;
        $cols->color = $request->collateral__color;
        $cols->body = $request->collateral__body;
        $cols->marchine = $request->collateral__machine;
        $cols->year = $request->collateral__year;
        $cols->iden = $request->collateral__number;
        $cols->extra = $request->collateral__extra;
        $cols->type = $request->collateral__type;

        $cols->save();

        return redirect()->route("loans.create");

    }


    public function FunctionNameSave(Request $request)
    {
        $request->validate([
            'collateral__model' => 'required|string|max:255',
            'collateral__color' => 'required|string|max:255',
            'collateral__body' => 'required|string|max:255',
            'collateral__machine' => 'required|string|max:255',
            'collateral__year' => 'required|string|max:255',
            // 'collateral__number' => 'required|string|max:255',
            'collateral__extra' => 'required|string|max:255',
        ]);

        $ct = ColTmp::create([
            'model' => $request->collateral__model,
            'color' => $request->collateral__color,
            'body' => $request->collateral__body,
            'marchine' => $request->collateral__machine,
            'year' => $request->collateral__year,
            'iden' => $request->collateral__number,
            'extra' => $request->collateral__extra,
            'type' => $request->collateral__type,
        ]);

        return response()->json($ct, 200);
    }

    public function FunctionNameEdit(Request $request, $val)
    {
        $request->validate([
            'collateral__model' => 'required|string|max:255',
            'collateral__color' => 'required|string|max:255',
            'collateral__body' => 'required|string|max:255',
            'collateral__machine' => 'required|string|max:255',
            'collateral__year' => 'required|string|max:255',
            // 'collateral__number' => 'required|string|max:255',
            'collateral__extra' => 'required|string|max:255',
        ]);

        $ct = ColTmp::findOrFail($val);
        $ct->model = $request->collateral__model;
        $ct->color = $request->collateral__color;
        $ct->body = $request->collateral__body;
        $ct->marchine = $request->collateral__machine;
        $ct->year = $request->collateral__year;
        $ct->iden = $request->collateral__number;
        $ct->extra = $request->collateral__extra;
        $ct->type = $request->collateral__type;
        
        $ct->save();

        return response()->json($ct, 200);
    }

    public function getCollae($val){
        return response()->json(ColTmp::where('id',$val)->first());
    }
    

    //end Collecterall------------------------------------------------------


    public function __createTmp_cus(Request $request){
        $request->validate([
            'cu_customers_radio' => 'required'
        ]);

        $u = Cj::findOrFail($request->cu_customers_radio);

        $ct=CusTmp::updateOrCreate(
            ['numbers' => 2],
            [
                'join' => $u->id,
                'extra' => $u->meta_tag
            ]
        );

        return response()->json($ct);
    }


    public function __ajaxSaveGuaran(Request $request){
        $request->validate([
            'g__last_name' => 'required|string|max:160',
            'g__first_name' => 'required|string|max:160',
            
            'g__gender' => 'required',
            // 'g__dob' => 'required',
            'g__last_name_en' => 'required|string|max:100',
            'g__first_name_en' => 'required|string|max:100',
            // 'g__mstatus' => 'required|exists:params_marital_statuses,id',
            'g__id_type' => 'required|exists:params_identifies,id',
            'g__id_number' => 'required|string|max:100',
            // 'g__id_register' => 'required',
            'g__occupation' => 'required|string|max:160',
            'g__phone' => 'required|string|max:100',
            'g__group' => 'max:30',
            'g__home' => 'max:30',
            // 'g__street' => 'max:50',
            'g__village' => 'required|exists:ln_village,vill_id',
        ]);

        $u = Cg::create([
            'last_name' => $request->g__last_name,
            'first_name' => $request->g__first_name,

            'first_name_en' => $request->g__first_name_en,
            'last_name_en' => $request->g__last_name_en,

            'gender' => $request->g__gender,
            'dob' => $request->g__dob,
            'it' => $request->g__id_type,
            'it_no' => $request->g__id_number,
            'it_date' => $request->g__id_register,
            'occupation' => $request->g__occupation,

            'phone' => \Hel::phoneVerify($request->g__phone),
            'phone2' => \Hel::phoneVerify($request->g__phone2),

            'occ_address' => $request->g__occupation_address,
            'group' => $request->g__group,
            'home' => $request->g__home,
            'meta_tag' => $request->g__type,
            'village' => $request->g__village
        ]);

        $ct = CusTmp::updateOrCreate(
            ['numbers' => 3],
            [
                'guarantee' => $u->id,
                'extra' => $u->meta_tag
            ]
        );

        return response()->json($ct);
    }


    public function __createTmp_Jon(Request $request){
        $request->validate([
            'cu_customers_radio' => 'required'
        ]);

        $u = Cg::findOrFail($request->cu_customers_radio);
        $ct=CusTmp::updateOrCreate(
            ['numbers' => 3],
            [
                'guarantee' => $u->id,
                'extra' => $u->meta_tag
            ]
        );

        return response()->json($ct);
    }

}
