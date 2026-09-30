<?php

namespace App\Http\Controllers\Local;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Local\District;
use App\Local\Province;
use App\Local\Commune;
use DataTables;

class LnCommune extends Controller
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
        $province = Province::select('province_id', 'province_kh_name')->get();
        //$district = District::byProvince($province->province_id)->select('dis_id', 'district_namekh')->get();

        return view('local.commune.ind', compact('province')); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $province = Province::select('province_id', 'province_kh_name')->get();
        return view('local.commune.crea', compact('province')); 
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
            'commune_name' => 'required|string|max:60',
            'commune_namekh' => 'required|string|max:60',
        ]);

        $pro = Commune::create([
            'district_id' => $request->district_id,
            'code' => date_format(now(), 'Y-m-d'),
            'commune_name' => $request->commune_namekh,
            'commune_namekh' => $request->commune_namekh,
            'modify_date' => date_format(now(), 'Y-m-d'),
            'status' => true,
            'user_id' => auth()->user()->id,
            'displayby' => true,
            'branch_id' => 1,
        ]);

        if($request->save__new__opt) return back()->with(['message' => "($pro->commune_name), Create Completed."]);

        return redirect()->route('communes.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $commune = Commune::findOrFail($id);
        return view('local.commune.show', compact('commune')); 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $commune = Commune::findOrFail($id);
        $district = District::byProvince($commune->district->pro_id)->select('dis_id', 'district_namekh')->get();
        $province = Province::select('province_id', 'province_kh_name')->get();
        return view('local.commune.edit', compact('district', 'province', 'commune'));
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
            'commune_name' => 'required|string|max:60',
            'commune_namekh' => 'required|string|max:60',
        ]);

        $com = Commune::findOrFail($id);
        $com->district_id = $request->district_id;
        $com->commune_name = $request->commune_name;
        $com->commune_namekh = $request->commune_namekh;
        $com->modify_date = date_format(now(), 'Y-m-d');
        $com->status = true;
        $com->user_id = auth()->user()->id;

        $com->save();

        return Redirect()->back()->with(['message' => "$com->commune_name, Update Completed."]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Commune::destroy($id);
        return redirect()->route('communes.index')->with(['message' => "Delete, Completed."]);
    }


    public function fetch($id)
    {
        $district = Commune::byDistrict($id)->select('com_id','district_id' , 'commune_name', 'commune_namekh', 'modify_date');
        
        return DataTables::of($district)
            ->addIndexColumn()
            ->addColumn('action', '<a href="{{ route(\'communes.show\', $com_id ) }}" class="btn btn-outline-success btn-xs mr-1 __kh__"><i class="fas fa-eye"></i> មើល</a>
                <a href="{{ route(\'communes.edit\', $com_id) }}" class="btn btn-outline-primary btn-xs __kh__"><i class="fas fa-edit"></i> កែប្រែ</a>'
            )
            ->rawColumns(['action'])
            ->make(true);
    }

    public function fetchDistrict($id)
    {
        $district = District::byProvince($id)->select('dis_id as id', 'district_namekh as text' , 'district_name as text_en')->get();

        return response()->json($district);
    }
}
