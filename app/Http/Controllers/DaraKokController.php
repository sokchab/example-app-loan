<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Client as KOK;
use DataTables as DT;
use App\Opts\CusTmp as TMP;
use App\Raturnable\Payments;

class DaraKokController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function getRow()
    {
        return DT::of(KOK::all())
            ->addIndexColumn()
            ->addColumn('fullname', function ($row){
                return "<input type=\"radio\" id=\"g_kok__d_$row->id\" 
                               name=\"g_kok__loan\" 
                               value=\"$row->id\">
                        <label for=\"g_kok__d_$row->id\">
                            &nbsp; ". $row->fullName() ."
                        </label>";
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
                    $val->it_number
                ;
            })
            ->rawColumns([
                'fullname'
            ])
            ->make(true);
    }//end getRows

    public function saveRow(Request $request)
    {
        $request->validate([
            'kok__last_name' => 'required|string|max:160',
            'kok__first_name' => 'required|string|max:160',

            'kok__last_name_en' => 'required|string|max:100',
            'kok__first_name_en' => 'required|string|max:100',

            'kok__gender' => 'required',
            // 'kok__dob' => 'required',
            // 'kok__occupation_address' => 'required|exists:params_marital_statuses,id',
            'kok__id_type' => 'required|exists:params_identifies,id',
            'kok__id_number' => 'required|string|max:100',
            // 'kok__id_register' => 'required',
            'kok__occupation' => 'required|string|max:160',
            'kok__phone' => 'required|string|max:100',
            'kok__group' => 'max:30',
            'kok__home' => 'max:30',
            // 'kok__type' => 'max:50',
            'kok__village' => 'required|exists:ln_village,vill_id',
        ]);

        $u = KOK::create([
            'last_name' => $request->kok__last_name,
            'first_name' => $request->kok__first_name,

            'first_name_en' => $request->kok__first_name_en,
            'last_name_en' => $request->kok__last_name_en,

            'gender' => $request->kok__gender,
            'dob' => $request->kok__dob,
            'it' => $request->kok__id_type,
            'it_number' => $request->kok__id_number,
            'it_date' => $request->kok__id_register,
            'occupation' => $request->kok__occupation,
            
            'phone' => \Hel::phoneVerify($request->kok__phone),
            'phone2' => \Hel::phoneVerify($request->kok__phone2),

            'company_name' => $request->kok__occupation_address,
            'group' => $request->kok__group,
            'home' => $request->kok__home,
            'extra' => $request->kok__type,
            'village' => $request->kok__village
        ]);

        $ct = TMP::updateOrCreate(
            ['numbers' => 4],
            [
                'guarantee_join' => $u->id,
                'extra' => $u->extra
            ]
        );

        return response()->json($ct);
    }//end saveRow

    public function FunctionSaveBy(Request $request)
    {
        $request->validate([
            'g_kok__loan' => 'required'
        ]);

        $u = KOK::findOrFail($request->g_kok__loan);

        $ct=TMP::updateOrCreate(
            ['numbers' => 4],
            [
                'guarantee_join' => $u->id,
                'extra' => $u->extra
            ]
        );

        return response()->json($ct);
    }

    public function test_v2(Request $request){
        return dd($request);
    }

    ///

    public function receive(Request $request)
    {
        $payments = Payments::orderBy('id', 'desc')->whereBetween('paid_date', [$request->from, $request->to])->get();

        $collections = $payments->groupBy(function($item) {
            return $item->getUser->name;
        });

        return view('rbaykar', compact('collections'));
    }

}//end class
