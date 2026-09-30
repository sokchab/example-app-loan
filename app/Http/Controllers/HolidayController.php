<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Holiday;

class HolidayController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $rq)
    {
        $data = Holiday::orderBy('year', 'desc')->get()->groupBy(function($row){
            return $row->year;
        });

        $rows = Holiday::where('year', $rq->quest)->orderBy('holiday', 'desc')->paginate(15);

        return view('holiday.index', compact(['data', 'rows']));
    }

    public function create()
    {
        return view('holiday.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'dateHoliday' => 'required|date',
            'description' => 'required|string|max:255'
        ]);
        Holiday::create([
            'holiday' => $request->dateHoliday,
            'year' => \Carbon\Carbon::parse($request->dateHoliday)->format('Y'),
            'dsc' => $request->description,
        ]);
        
        return redirect()->back();
    }

    public function show($id)
    {
        $holi = Holiday::findOrFail($id);
        return view('holiday.edit', compact('holi'));
    }

    public function edit(Request $request, $id)
    {
        $request->validate([
            'dateHoliday' => 'required|date',
            'description' => 'required|string|max:255'
        ]);

        $ho = Holiday::findOrFail($id);
        $ho->holiday = $request->dateHoliday;
        $ho->year = \Carbon\Carbon::parse($request->dateHoliday)->format('Y');
        $ho->dsc = $request->description;
        $ho->save();
        return redirect()->back();
    }

    public function delete($id)
    {
        Holiday::destroy($id);

        // return response()->json(['message' => 'Successfull'], 200);
        return redirect()->route('holiday.index', ['quest' => now()->format('Y')]);
    }
}
