<?php

namespace App\Http\Controllers\Local;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Local\District;
use App\Local\Province;
use DataTables;

class CoDistrict extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $province = Province::select('province_id', 'province_kh_name')->get();

        return view('local.districts.list', compact('province'));  
    }

    public function create()
    {
        $province = Province::select('province_id', 'province_kh_name')->get();

        return view('local.districts.create', compact('province')); 
    }

    public function store(Request $request)
    {
        $request->validate([
            'pro_id' => 'required|exists:ln_province,province_id',
            'district_name' => 'required|string|max:60',
            'district_namekh' => 'required|string|max:60',
        ]);

        $pro = District::create([
            'pro_id' => $request->pro_id,
            'code' => date_format(now(), 'Y-m-d'),
            'district_name' => $request->district_name,
            'district_namekh' => $request->district_namekh,
            'modify_date' => date_format(now(), 'Y-m-d'),
            'status' => true,
            'user_id' => auth()->user()->id,
            'displayby' => true,
            'branch_id' => 1,
        ]);

        if($request->save__new__opt) return back()->with(['message' => "($pro->district_name), Create Completed."]);

        return redirect()->route('districts.index');
    }

    public function show($id)
    {
        $district = District::findOrFail($id);
        return view('local.districts.view', compact('district')); 
    }

    public function edit($id)
    {
        $district = District::findOrFail($id);
        $province = Province::select('province_id', 'province_kh_name')->get();
        return view('local.districts.edit', compact('district', 'province'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'pro_id' => 'required|exists:ln_province,province_id',
            'district_name' => 'required|string|max:60',
            'district_namekh' => 'required|string|max:60',
        ]);

        $province = District::findOrFail($id);
        $province->pro_id = $request->pro_id;
        $province->district_name = $request->district_name;
        $province->district_namekh = $request->district_namekh;
        $province->modify_date = date_format(now(), 'Y-m-d');
        $province->status = true;
        $province->user_id = auth()->user()->id;

        $province->save();

        return Redirect()->back()->with(['message' => "$province->district_name, Update Completed."]);
    }


    public function destroy($id)
    {
        District::destroy($id);
        return redirect()->route('districts.index')->with(['message' => "Delete, Completed."]);
    }

    public function fetch($id)
    {
        $district = $id == '__all__' ? District::select('dis_id','pro_id' , 'district_name', 'district_namekh', 'modify_date')
                : District::byProvince($id)->select('dis_id','pro_id' , 'district_name', 'district_namekh', 'modify_date');
        
        return DataTables::of($district)
            ->addIndexColumn()
            ->addColumn('action', '<a href="{{ route(\'districts.show\', $dis_id ) }}" class="btn btn-outline-success btn-xs mr-1 __kh__"><i class="fas fa-eye"></i> មើល</a>
                <a href="{{ route(\'districts.edit\', $dis_id) }}" class="btn btn-outline-primary btn-xs __kh__"><i class="fas fa-edit"></i> កែប្រែ</a>'
            )
            ->rawColumns(['action'])
            ->make(true);
    }

}
