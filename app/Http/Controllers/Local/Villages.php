<?php

namespace App\Http\Controllers\Local;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Local\Village;
use App\Local\District;
use App\Local\Commune;
use App\Local\Province;

class Villages extends Controller
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
        $province = Province::select('province_id as id', 'province_kh_name as text')->get();

        return view('local.village.__list__', compact('province'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $province = Province::select('province_id as id', 'province_kh_name as text')->get();
        return view('local.village.__init__', compact('province')); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'pro_id' => 'required|exists:ln_province,province_id',
            'district_id' => 'required|exists:ln_district,dis_id',
            'commune_id' => 'required|exists:ln_commune,com_id',
            'village_name' => 'required|string|max:100',
            'village_namekh' => 'required|string|max:100',
        ]);

        $obj = Village::create([
            'commune_id' => $request->commune_id,
            'code' => date_format(now(), 'Y-m-d'),
            'village_name' => $request->village_name,
            'village_namekh' => $request->village_namekh,
            'modify_date' => date_format(now(), 'Y-m-d'),
            'status' => true,
            'user_id' => auth()->user()->id,
            'displayby' => true,
            'branch_id' => 1,
        ]);

        if($request->__new__) return back()->with(['message' => "($obj->village_name), Create Completed."]);

        return redirect()->route('villages.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $objs = Village::findOrFail($id);
        return view('local.village.__disp__', compact('objs')); 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $village = Village::findOrFail($id);
        $commune = Commune::byDistrict($village->commune->district->dis_id)->select('com_id', 'commune_namekh')->get();
        $district = District::byProvince($village->commune->district->pro_id)->select('dis_id', 'district_namekh')->get();
        $province = Province::select('province_id', 'province_kh_name')->get();
        return view('local.village.__edit__', compact('district', 'province', 'commune', 'village'));
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
        $request->validate([
            'pro_id' => 'required|exists:ln_province,province_id',
            'district_id' => 'required|exists:ln_district,dis_id',
            'commune_id' => 'required|exists:ln_commune,com_id',
            'village_name' => 'required|string|max:100',
            'village_namekh' => 'required|string|max:100',
        ]);

        $com = Village::findOrFail($id);
        $com->commune_id = $request->commune_id;
        $com->village_name = $request->village_name;
        $com->village_namekh = $request->village_namekh;
        $com->modify_date = date_format(now(), 'Y-m-d');
        $com->status = true;
        $com->user_id = auth()->user()->id;

        $com->save();

        return Redirect()->back()->with(['message' => "$com->village_name, Update Completed."]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Village::destroy($id);
        return redirect()->route('villages.index')->with(['message' => "Delete, Completed."]);
    }


    public function fetch($id)
    {
        $village = Village::byCommune($id)->select(
            'vill_id as id',
            'commune_id as commune', 
            'village_name as name', 
            'village_namekh as name_kh', 
            'modify_date as modify'
        );
        
        return \DataTables::of($village)
            ->addIndexColumn()
            ->addColumn('action', '
                <a href="{{ route(\'villages.show\', $id ) }}" class="btn btn-outline-success btn-xs mr-1 __kh__">
                    <i class="fas fa-eye"></i> មើល
                </a>
                <a href="{{ route(\'villages.edit\', $id) }}" class="btn btn-outline-primary btn-xs __kh__">
                <i class="fas fa-edit"></i> កែប្រែ
                </a>
            ')
            ->rawColumns(['action'])
            ->make(true);
    }

    public function fetchCommune($id)
    {
        $comm = Commune::byDistrict($id)->select('com_id as id', 'commune_namekh as text', 'commune_name as text_en')->get();
        return response()->json($comm);
    }
}
