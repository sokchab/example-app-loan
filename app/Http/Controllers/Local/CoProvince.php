<?php

namespace App\Http\Controllers\Local;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Local\Province;
use DataTables;

class CoProvince extends Controller
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
        return view('local.provinces.index'); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('local.provinces.create'); 
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
            'province_en_name' => 'required|string|max:50',
            'province_kh_name' => 'required|string|max:60',
        ]);

        $pro = Province::create([
            'code' => date_format(now(), 'Y-m-d'),
            'province_en_name' => $request->province_en_name,
            'province_kh_name' => $request->province_kh_name,
            'modify_date' => date_format(now(), 'Y-m-d'),
            'status' => true,
            'user_id' => auth()->user()->id,
            'displayby' => true,
            'branch_id' => null,
        ]);

        if($request->save__new__opt) return back()->with(['message' => "($pro->province_en_name), Create Completed."]);

        return redirect()->route('provinces.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $province = Province::findOrFail($id);
        return view('local.provinces.view', compact('province')); 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $province = Province::findOrFail($id);
        return view('local.provinces.edit', compact('province'));
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
            'province_en_name' => 'required|string|max:50',
            'province_kh_name' => 'required|string|max:60',
        ]);

        $province = Province::findOrFail($id);
        
        $province->province_en_name = $request->province_en_name;
        $province->province_kh_name = $request->province_kh_name;
        $province->modify_date = date_format(now(), 'Y-m-d');
        $province->status = true;
        $province->user_id = auth()->user()->id;

        $province->save();

        return Redirect()->back()->with(['message' => "$province->province_en_name, Update Completed."]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Province::destroy($id);
        return redirect()->route('provinces.index')->with(['message' => "Delete, Completed."]);
    }


    /**
     * Fetch json Provinces
     * @return \Illuminate\Http\Response
     */
    public function fetch()
    {
        return DataTables::of(Province::select('province_id', 'province_en_name', 'province_kh_name', 'modify_date'))
            ->addIndexColumn()
            ->addColumn('action', '<a href="{{ URL::route(\'provinces.show\', $province_id ) }}" class="btn btn-outline-success btn-xs mr-1 __kh__"><i class="fas fa-eye"></i> មើល</a>
                 <a href="{{ route(\'provinces.edit\', $province_id) }}" class="btn btn-outline-primary btn-xs __kh__"><i class="fas fa-edit"></i> កែប្រែ</a>'
            )
            ->rawColumns(['action'])
            ->make(true);
    }
}
