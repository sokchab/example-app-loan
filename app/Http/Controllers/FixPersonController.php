<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Opts\Customer;
use App\Opts\CusTmp;
use App\Opts\CustJoin;
use App\Params\MaritalStatus as Ms;
use App\Params\Identify as Iden;
use App\Local\Province as Prov;
use App\Local\Village as Vill;
use App\Local\District as Dist;
use App\Local\Commune as Comm;
use App\Opts\CustGuaran;
use App\Client as KOK;

class FixPersonController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth");
    }

    public function removeTmpIst($val)
    {
        CusTmp::destroy($val);
        return redirect()->route("loans.create");
    }

    //client
    public function clientList()
    {
        return view("trans.loans.new_person.clients.lists");
    }

    public function chooseClientFix($id)
    {
        CusTmp::updateOrCreate(
            ['numbers' => 1],
            [
                'client' => $id,
            ]
        );

        return redirect()->route("loans.create");
    }

    public function fetchWithRequestClient()
    {
        $cv = Customer::query()->orderBy('id', 'desc');
        return \DataTables::of($cv)
            ->addIndexColumn()
            ->editColumn('gender','{{ $gender ? "ប្រុស" : "ស្រី" }}')
            ->addColumn('full_name', function($val){
                return $val->fullName();
            })
            ->addColumn('action', function($val){
                if($val->is_active)
                    if($val->loans()->isActive()->count() > 0)
                        return "<span class='text-danger'>កំពុងជាប់កម្ចី</span>";
                    else return "
                        <a href=\" ". route('fix.loan.choose.client', $val->id ) ." \" class=\"btn-group\">
                            ជ្រើសរើស
                        </a>
                    ";
                else
                    return "ផ្អាកដំណើរការ";
            }) 
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
    //end client


    //join
    public function chooseJoinFix($id)
    {
        $u = CustJoin::find($id);

        CusTmp::updateOrCreate(
            ['numbers' => 2],
            [
                'join' => $u->id,
                'extra' => $u->meta_tag
            ]
        );
        return redirect()->route("loans.create");
    }

    public function joinLists()
    {
        return view("trans.loans.new_person.joins.list__join");
    }

    public function joinNewStore(Request $request)
    {
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

        $cus = new CustJoin();
       
        $cus->last_name = $request->cus__last_name;
        $cus->first_name = $request->cus__first_name;

        $cus->last_name_en = $request->cus__last_name_en;
        $cus->first_name_en = $request->cus__first_name_en;

        $cus->gender = $request->cus__gender;
        $cus->dob = $request->cus__dob;
        // $cus->status = $request->cus__mstatus;
        $cus->it = $request->cus__id_type;
        $cus->it_no = $request->cus__id_number;
        $cus->it_date = $request->cus__id_register;
        $cus->occupation = $request->cus__occupation;


        $cus->phone = \Hel::phoneVerify($request->cus__phone);
        $cus->phone2 = \Hel::phoneVerify($request->cus__phone2);

        $cus->group = $request->cus__group;
        $cus->home = $request->cus__home;
        $cus->occ_address = $request->cus__occupation_add;
        $cus->village = $request->cus__village;

        //បានកែនៅថ្ងៃ8/2/2022លើចំនុចត្រូវជាអ្វី
        $cus->meta_tag = $request->cus__type;

        $cus->save();

        CusTmp::updateOrCreate(
            ['numbers' => 2],
            [
                'join' => $cus->id,
                'extra' => $cus->meta_tag
            ]
        );

        return redirect()->route("loans.create");
    }

    public function joinNewAdd()
    {
        $pro = Prov::orderBy('branch_id')->first();
        $dis = Dist::byProvince($pro->province_id)->first();      
        $com = Comm::byDistrict($dis->dis_id)->first();

        $re = [        
            'data' => new CustJoin(),
            'prov' => Prov::orderBy('branch_id')->get(),
            'dist' => Dist::byProvince($pro->province_id)->get(),
            'comm' => Comm::byDistrict($dis->dis_id)->get(),
            'vill' => Vill::byCommune($com->com_id)->get(),
            'iden' => Iden::all(),
            'msta' => Ms::all(),
        ];

        return view("trans.loans.new_person.joins.new__join", $re);
    }
    public function fetchWithRequestJoin()
    {
        $cv = CustJoin::query()->orderBy('id', 'desc');
        return \DataTables::of($cv)
            ->addIndexColumn()
            ->editColumn('gender','{{ $gender ? "ប្រុស" : "ស្រី" }}')
            ->addColumn('full_name', function($val){
                return $val->fullName();
            })
            ->addColumn('action', function($val){
                return "
                        <a href=\" ". route('fix.loan.join.chooseJoinFix', $val->id ) ." \" class=\"btn-group\">
                            ជ្រើសរើស
                        </a>
                    ";
            }) 
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

                return $data;
            })
            ->filter(function ($query){
                if (request()->has('search'))
                    $query->where('id', 'like', "%" . request('search') . "%")
                          ->orWhere('first_name', 'like', "%" . request('search') . "%")
                          ->orWhere('last_name', 'like', "%" . request('search') . "%")
                          //->orWhere('key_ref', 'like', "%" . request('search') . "%")
                          //->orWhere('cus_key', 'like', "%" . request('search') . "%")
                          ->orWhere('it_no', 'like', "%" . request('search') . "%")
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
    //end join  




    //
    public function CustGuaranNewReque()
    {
        return view("trans.loans.new_person.guarantee.list_guara");
    }
    //
    public function fetchWithRequestCustGuaran()
    {
        $cv = CustGuaran::query()->orderBy('id', 'desc');
        return \DataTables::of($cv)
            ->addIndexColumn()
            ->editColumn('gender','{{ $gender ? "ប្រុស" : "ស្រី" }}')
            ->addColumn('full_name', function($val){
                return $val->fullName();
            })
            ->addColumn('action', function($val){
                return "
                        <a href=\" ". route('fix.loan.chooseCustGuaranFix', $val->id ) ." \" class=\"btn-group\">
                            ជ្រើសរើស
                        </a>
                    ";
            }) 
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

                return $data;
            })
            ->filter(function ($query){
                if (request()->has('search'))
                    $query->where('id', 'like', "%" . request('search') . "%")
                          ->orWhere('first_name', 'like', "%" . request('search') . "%")
                          ->orWhere('last_name', 'like', "%" . request('search') . "%")
                          //->orWhere('key_ref', 'like', "%" . request('search') . "%")
                          //->orWhere('cus_key', 'like', "%" . request('search') . "%")
                          ->orWhere('it_no', 'like', "%" . request('search') . "%")
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

    public function chooseCustGuaranFix($id)
    {
        $u = CustGuaran::find($id);

        CusTmp::updateOrCreate(
            ['numbers' => 3],
            [
                'guarantee' => $u->id,
                'extra' => $u->meta_tag
            ]
        );

        return redirect()->route("loans.create");
    }

    public function CustGuaranNewAdd()
    {
        $pro = Prov::orderBy('branch_id')->first();
        $dis = Dist::byProvince($pro->province_id)->first();      
        $com = Comm::byDistrict($dis->dis_id)->first();

        $re = [        
            'data' => new CustJoin(),
            'prov' => Prov::orderBy('branch_id')->get(),
            'dist' => Dist::byProvince($pro->province_id)->get(),
            'comm' => Comm::byDistrict($dis->dis_id)->get(),
            'vill' => Vill::byCommune($com->com_id)->get(),
            'iden' => Iden::all(),
            'msta' => Ms::all(),
        ];

        return view("trans.loans.new_person.guarantee.new_guaran", $re);
    }

    
    public function CustGuaranNewStore(Request $request)
    {
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

        $cus = new CustGuaran();
       
        $cus->last_name = $request->cus__last_name;
        $cus->first_name = $request->cus__first_name;

        $cus->last_name_en = $request->cus__last_name_en;
        $cus->first_name_en = $request->cus__first_name_en;

        $cus->gender = $request->cus__gender;
        $cus->dob = $request->cus__dob;
        // $cus->status = $request->cus__mstatus;
        $cus->it = $request->cus__id_type;
        $cus->it_no = $request->cus__id_number;
        $cus->it_date = $request->cus__id_register;
        $cus->occupation = $request->cus__occupation;


        $cus->phone = \Hel::phoneVerify($request->cus__phone);
        $cus->phone2 = \Hel::phoneVerify($request->cus__phone2);

        $cus->group = $request->cus__group;
        $cus->home = $request->cus__home;
        $cus->occ_address = $request->cus__occupation_add;
        $cus->village = $request->cus__village;

        //fix at 8/2/2022
        $cus->meta_tag = $request->cus__type;

        $cus->save();

        CusTmp::updateOrCreate(
            ['numbers' => 3],
            [
                'guarantee' => $cus->id,
                'extra' => $cus->meta_tag
            ]
        );

        return redirect()->route("loans.create");
    }
    //end join  CustGuaran


    public function KOKList()
    {
        return view("trans.loans.new_person.guarantee_join.list_gu_join");
    }

    public function KOKChoose($id)
    {
        $u = KOK::find($id);
        CusTmp::updateOrCreate(
            ['numbers' => 4],
            [
                'guarantee_join' => $u->id,
                'extra' => $u->extra
            ]
        );
        return redirect()->route("loans.create");
    }

    public function KOKFormNew()
    {
        $pro = Prov::orderBy('branch_id')->first();
        $dis = Dist::byProvince($pro->province_id)->first();      
        $com = Comm::byDistrict($dis->dis_id)->first();

        $re = [        
            'data' => new KOK(),
            'prov' => Prov::orderBy('branch_id')->get(),
            'dist' => Dist::byProvince($pro->province_id)->get(),
            'comm' => Comm::byDistrict($dis->dis_id)->get(),
            'vill' => Vill::byCommune($com->com_id)->get(),
            'iden' => Iden::all(),
            'msta' => Ms::all(),
        ];

        return view("trans.loans.new_person.guarantee_join.new_gu_join", $re);
    }

    public function KOKSubmitDataFix(Request $request)
    {
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

        $u = KOK::create([
            'last_name' => $request->cus__last_name,
            'first_name' => $request->cus__first_name,

            'first_name_en' => $request->cus__last_name_en,
            'last_name_en' => $request->cus__first_name_en,

            'gender' => $request->cus__gender,
            'dob' => $request->cus__dob,
            'it' => $request->cus__id_type,
            'it_number' => $request->cus__id_number,
            'it_date' => $request->cus__id_register,
            'occupation' => $request->cus__occupation,
            
            'phone' => \Hel::phoneVerify($request->cus__phone),
            'phone2' => \Hel::phoneVerify($request->cus__phone2),

            'company_name' => $request->cus__occupation_add,
            'group' => $request->cus__group,
            'home' => $request->cus__home,
            'extra' => $request->cus__type,
            'village' => $request->cus__village
        ]);

        $ct = CusTmp::updateOrCreate(
            ['numbers' => 4],
            [
                'guarantee_join' => $u->id,
                'extra' => $u->extra
            ]
        );

        return redirect()->route("loans.create");
    }

    public function fetchGuaranteeJoinFix()
    {
        $cv = KOK::query()->orderBy('id', 'desc');
        return \DataTables::of($cv)
            ->addIndexColumn()
            ->editColumn('gender','{{ $gender ? "ប្រុស" : "ស្រី" }}')
            ->addColumn('full_name', function($val){
                return $val->fullName();
            })
            ->addColumn('action', function($val){
                return "
                        <a href=\" ". route('fix.loan.KOKChoose', $val->id ) ." \" class=\"btn-group\">
                            ជ្រើសរើស
                        </a>
                    ";
            }) 
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

                return $data;
            })
            ->filter(function ($query){
                if (request()->has('search'))
                    $query->where('id', 'like', "%" . request('search') . "%")
                          ->orWhere('first_name', 'like', "%" . request('search') . "%")
                          ->orWhere('last_name', 'like', "%" . request('search') . "%")
                          //->orWhere('key_ref', 'like', "%" . request('search') . "%")
                          //->orWhere('cus_key', 'like', "%" . request('search') . "%")
                          ->orWhere('it_number', 'like', "%" . request('search') . "%")
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
}//end class
