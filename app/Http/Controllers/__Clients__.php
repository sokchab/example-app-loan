<?php

namespace App\Http\Controllers;

use App\Opts\CusTmp;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Opts\Customer as Data;
use App\Params\Occupation as Occ;
use App\Params\MaritalStatus as Mast;
use App\Params\Identify as Iden;
use App\Params\Addresses as Addr;
use App\Local\Province as Prov;
use App\Local\Village as Vill;
use App\Local\District as Dist;
use App\Local\Commune as Com;
// use App\ViewDB\CustomerView as Cv;

class __Clients__ extends Controller
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
        return view('client.__init__');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pro = Prov::select('province_id as id', 'province_kh_name as name', 'province_en_name as name_en')->orderBy('branch_id');
        $params = [
            'occ' => Occ::all(),
            'mast' => Mast::all(),
            'iden' => Iden::all(),
            'addr' => [
                'prov' => $pro->get(),
                'dist' => Dist::select('dis_id as id', 'district_namekh as name', 'district_name as name_en')->where('pro_id', $pro->first()->id)->get()
            ]
        ];

        return view('client.__create__', compact('params'));
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
            'last__name' => 'required|string|max:160',
            'first__name' => 'required|string|max:160',
            'last__name_en__' => 'required|string|max:100',
            '__gender__' => 'required',
            'first__name_en__' => 'required|string|max:100',
            // '__mstatus__' => 'required|exists:params_marital_statuses,id',
            '__id_type__' => 'required|exists:params_identifies,id',
            '__id_number__' => 'required|string|max:100',
            // '__id_register__' => 'required',
            '__occupation__' => 'required|string|max:160',
            '__phone__' => 'required|string|max:100',
            '__group__' => 'max:30',
            '__home__' => 'max:30',
            // '__street__' => 'max:50',

            '__village__' => 'required|exists:ln_village,vill_id',
        ]);
        

        $obj = Data::create([
            'first_name' => $request->first__name,
            'last_name' => $request->last__name,

            'last_name_en' => $request->last__name_en__,
            'first_name_en' => $request->first__name_en__,

            'gender' => $request->__gender__,
            'dob' => $request->__dob__,
            'identify_type' => $request->__id_type__,
            'identify_no' => $request->__id_number__,
            'identify_register' => $request->__id_register__,
            'occupation' => $request->__occupation__,

            'phone' => \Hel::phoneVerify($request->__phone__),
            'phone2' => \Hel::phoneVerify($request->__phone__2),

            'group' => $request->__group__,
            'home' => $request->__home__,
            'add_occupation' => $request->address_occupation,
            'village' => $request->__village__,
            'created_by' => auth()->user()->id,
            'key_ref' => $this->customerKey(),
            'cus_key' => substr($request->last__name_en__, 0, 1) . $this->customerKey(),
        ]);


        if($request->has('on__loan') && $request->on__loan == 1)
        {
            CusTmp::updateOrCreate(
                ['numbers' => 1],
                [
                    'client' => $obj->id,
                ]
            );
            return redirect()->route("loans.create");
        }

        if($request->__new__) return back()->with(['message' => "($obj->first_name_en), Create Completed."]);
        return redirect()->route('clients.index');
    }



    public function ajaxSave(Request $request){
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

        $u = Data::create([
            'first_name' => $request->cus__first_name,
            'last_name' => $request->cus__last_name,

            'last_name_en' => $request->cus__last_name_en,
            'first_name_en' => $request->cus__first_name_en,

            'gender' => $request->cus__gender,
            'dob' => $request->cus__dob,
            'identify_type' => $request->cus__id_type,
            'identify_no' => $request->cus__id_number,
            'identify_register' => $request->cus__id_register,
            'occupation' => $request->cus__occupation,

            'phone' => \Hel::phoneVerify($request->cus__phone),
            'phone2' => \Hel::phoneVerify($request->cus__phone2),

            'add_occupation' => $request->cus__occupation_address,
            'group' => $request->cus__group,
            'home' => $request->cus__home,

            // 'street' => $request->cus__street,
            'village' => $request->cus__village,
            'created_by' => auth()->user()->id,
            'key_ref' => $this->customerKey(),
            'cus_key' => substr($request->cus__last_name_en, 0, 1) . $this->customerKey(),
        ]);

        $ct = CusTmp::updateOrCreate(
            ['numbers' => 1],
            [
                'client' => $u->id,
            ]
        );

        return response()->json($ct);
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $cvs = Data::findOrFail($id);
        return view('client.__view__', compact('cvs'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $cus = Data::findOrFail($id);

        $dis = Dist::byProvince($cus->getVillage->commune->district->pro_id)->get();
        $com = Com::byDistrict($cus->getVillage->commune->district_id)->get();
        $vil = Vill::byCommune($cus->getVillage->commune_id)->get();

        $data = [
            'cus' => $cus,
            'pro' => Prov::orderBy('branch_id')->get(),
            'mas' => Mast::all(),
            'ide' => Iden::all(),
            'dis' => $dis,
            'com' => $com,
            'vil' => $vil,
        ];

        return view('client.__edit__', compact('data'));
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
            'last__name' => 'required|string|max:160',
            'first__name' => 'required|string|max:160',
            // '__name_en__' => 'required|string|max:100',
            '__gender__' => 'required',
            'last__name_en__' => 'required|string|max:100',
            // '__gender__' => 'required',
            'first__name_en__' => 'required|string|max:100',
            // '__dob__' => 'required',
            // '__mstatus__' => 'required|exists:params_marital_statuses,id',
            '__id_type__' => 'required|exists:params_identifies,id',
            '__id_number__' => 'required|string|max:100',
            // '__id_register__' => 'required',
            '__occupation__' => 'required|string|max:160',
            '__phone__' => 'required|string|max:100',
            '__group__' => 'max:30',
            '__home__' => 'max:30',
            // '__street__' => 'max:50',

            '__village__' => 'required|exists:ln_village,vill_id',
        ]);

        $obj = Data::findOrFail($id);
        $obj->first_name = $request->first__name;
        $obj->last_name = $request->last__name;


        $obj->last_name_en = $request->last__name_en__;
        $obj->first_name_en = $request->first__name_en__;


        $obj->gender = $request->__gender__;
        $obj->dob = $request->__dob__;
        $obj->identify_type = $request->__id_type__;
        $obj->identify_no = $request->__id_number__;
        $obj->identify_register = $request->__id_register__;
        $obj->occupation = $request->__occupation__;


        $obj->phone = \Hel::phoneVerify($request->__phone__);
        $obj->phone2 = \Hel::phoneVerify($request->__phone__2);


        $obj->add_occupation = $request->occupation_address;
        $obj->group = $request->__group__;
        $obj->home = $request->__home__;
        // $obj->street = $request->__street__;
        $obj->village = $request->__village__;
        $obj->is_active = boolval($request->__is_active__); 

        $obj->save();
        return back()->with(['message' => "($obj->first_name_en), Create Completed."]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return redirect()->back();
    }

    public function fetchAll()
    {
        $cv = Data::query()->orderBy('id', 'desc');
        return \DataTables::of($cv)
            ->addIndexColumn()
            ->editColumn('gender','{{ $gender ? "ប្រុស" : "ស្រី" }}')
            ->addColumn('full_name', function($val){
                return $val->fullName();
            })
            ->addColumn('action', '
                <a href="{{ route(\'clients.show\', $id ) }}" class="btn-group">
                    <span class="badge br-olive text-olive brr"><i class="fas fa-user"></i></span>
                    <span class="badge bg-gradient-olive brl text-sm">{{ $cus_key }}</span>
                </a>
            ')
            ->addColumn('name_full_en', function($val){
                return $val->fullNameEn();
            })
            ->addColumn('activation' ,function ($cv){
                $data = '
                    <div class="btn-group ml-2">
                        <span class="badge br-navy text-navy brr">លេខទូរស័ព្ទ</span>
                        <span class="badge bg-navy brl text-sm">'. \Hel::phoneDisplay($cv->phone);
                if($cv->phone2 != null)
                    $data .= ', ' . \Hel::phoneDisplay($cv->phone2);        
                $data .= '</span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$cv->occupation.'
                    </div>';

                $data .= $cv->is_active ?
                '<div class="btn-group float-right">
                    <span class="badge br-success text-success brr">ស្ថានភាព</span>
                    <span class="badge badge-success brl text-sm">ដំណើរការ</span>
                </div>' :
                '<div class="btn-group float-right">
                    <span class="badge br-dark text-dark brr">ស្ថានភាព</span>
                    <span class="badge badge-dark brl text-sm">ផ្អាកដំណើរការ</span>
                </div>';

                return $data;
            })
            ->filter(function ($query){
                if (request()->has('search'))
                    $query->where('id', 'like', "%" . request('search') . "%")
                          ->orWhere('first_name', 'like', "%" . request('search') . "%")
                          ->orWhere('last_name', 'like', "%" . request('search') . "%")
                          ->orWhere('key_ref', 'like', "%" . request('search') . "%")
                          ->orWhere('cus_key', 'like', "%" . request('search') . "%")
                          ->orWhere('identify_no', 'like', "%" . request('search') . "%")
                          ->orWhere('first_name_en', 'like', "%" . request('search') . "%")
                          ->orWhere('last_name_en', 'like', "%" . request('search') . "%")
                          ->orWhere('occupation', 'like', "%" . request('search') . "%")
                          ->orWhere('phone2', 'like', "%" . request('search') . "%")
                          ->orWhere('phone', 'like', "%" . request('search') . "%");
            })
            ->rawColumns([
                'full_name',
                'name_full_en',
                'action', 
                'activation'
            ])->make(true);
    }


    public function fetchRows(){
        $data = Data::query()->isActive();
        return \DataTables::of($data)
            ->addIndexColumn()
            ->editColumn('gender', '{{ $gender ? "ប្រុស" : "ស្រី" }}')
            ->editColumn('cus_key', function ($row){
                if($row->loans()->IsActive()->get()->isEmpty())
                    return "<input type=\"radio\" id=\"cus__$row->id\" name=\"cu_customers\" value=\"$row->id\">
                        <label for=\"cus__$row->id\">$row->cus_key</label>";
                return "<input type=\"radio\" id=\"cus__$row->id\" name=\"cu_customers\" value=\"$row->id\" disabled>
                        <label for=\"cus__$row->id\">$row->cus_key</label>";
            })
            ->editColumn('phone', function($dx){
                return \Hel::phoneDisplay($dx->phone) . " , ". \Hel::phoneDisplay($dx->phone2);
            })
            ->addColumn('name_full', function ($val){
                return $val->fullName();
            })
            ->addColumn('name_full_en', function($val){
                return $val->fullNameEn();
            })
            ->addColumn('address', function ($val){
                return  $val->getVillage->village_namekh .
                "  , " . $val->getVillage->commune->commune_namekh;
            })
            ->addColumn('identify', function($val){
                if($val->loans()->IsActive()->get()->isEmpty())
                    return "";
                return "<span class='badge bg-indigo'><i class=\"far fa-chart-bar mr-1\"></i>Active</span>";
            })
            ->rawColumns([
                'cus_key',
                'name_full',
                'name_full_en',
                'address',
                'identify'
            ])
            ->make(true);
    }

    public function fetchVillage($id)
    {
        $comm = Vill::byCommune($id)->select('vill_id as id', 'village_namekh as text', 'village_name as text_en')->get();
        return response()->json($comm);
    }

    private function customerKey()
    {
        $data = Data::latest()->value('key_ref');
        $len = strlen($data) <= 5 ? 5 : strlen($data) + 1;
        return str_pad( $data + 1, $len, '0', STR_PAD_LEFT);
    }
}
