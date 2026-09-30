<?php

namespace App\Http\Controllers;

use App\Opts\Customer;
use App\Plans;
use App\Trans\Bases\BankCashSheet;
use App\Trans\Cols\CollectionSheet;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\FinishLoanHistory as Finish;
use App\LateLoanHistory as Late;
use App\Trans\Loan;
use Illuminate\Support\Facades\Hash;

class CoDashboard extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function __index()
    {
        $colls = CollectionSheet::where('date_pay', '<=' , now()->subDays(5));
        $coll = $colls->sum('print_due_return') + $colls->sum('inter_due_return'); // + $colls->sum('fee');
        
        $all = Customer::count('id');

        $late = Late::all()->groupBy('client')->count();

        $finish = Loan::where('status', 3)->get()->groupBy('client')->count();

        $client = Loan::where('status', 1)->get()->groupBy('client')->count();

        return view('dashboard', [
            'Disbursement' => BankCashSheet::where('status', 3)->sum('out_flow'),
            'Outstanding' => CollectionSheet::sum('print_due_return'),
            'Clients' => $all,
            'Collection' => $coll,
            'Late'  => $late,
            'Finish' => $finish,
            'AllMisFi' => $client,
        ]);
    }


    public function __profile(){
        return view("auth.profiles");
    }

    public function __profile_update(Request $request){

        $validator = \Validator::make($request->all(), [
            'old_password' => [
                'required', function ($attribute, $value, $fail) {
                    if (!Hash::check($value, auth()->user()->password)) {
                        $fail('Old Password didn\'t match');
                    }
                },
            ],
            'name' => [
                'required',
                'string',
                'max:255'
            ],  
            'new_password' => [
                "required",
                "string",
                "min:8",
                "confirmed",
                function($attribute, $value, $fail){
                    if(Hash::check($value, auth()->user()->password)){
                        $fail('The password and new password must be different.');
                    }
                }
            ],
        ]);
        
        if($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }

        // $request->validate([  The name and name must be different.
            
        //     "old_password" => "required|string|exists:users,email"
        // ]);

        auth()->user()->name = $request->name;
        //auth()->user()->email = $request->email;
        auth()->user()->password = bcrypt($request->new_password);
        auth()->user()->save();
        auth()->logout();
        return back();
    }

    public function __savePlan(Request $request){
        $request->validate([
            'description' => 'required|string|max:255'
        ]);


        Plans::create([
            'dsc' => $request->description
        ]);

        return response()->json(['message' => "Successful"],200);
    }

    public function __finishPlan($val){
        $jp = Plans::findOrFail($val);
        $jp->status = $jp->status ? false : true;
        $jp->save();
        return response()->json(['message' => "Successful"],200);
    }

    public function __editPlan(Request $request, $val){
        $request->validate([
            'description' => 'required|string|max:255'
        ]);
        $jp = Plans::findOrFail($val);
        $jp->dsc = $request->description;
        $jp->save();
        return response()->json(['message' => "Successful"],200);
    }

    public function __deletePlan($val){
        Plans::destroy($val);
        return response()->json(['message' => "Successful"],200);
    }

    public function __getPlan(){
        return \DataTables::of(Plans::query()->orderBy('created_at', 'desc'))
            ->addIndexColumn()
            ->addColumn('plan', function ($d){
                $m = "
                    <ul class=\"todo-list\" data-widget=\"todo-list\">";
                    if($d->status)
                        $m .= "<li class='done'>
                            <!-- drag handle -->
                            <i class=\"fas fa-at\"></i>
                            <!-- checkbox -->
                            <div class=\"icheck-primary d-inline ml-2\">
                                <input type=\"checkbox\" onclick=\"__finish($d->plans_id)\" name=\"todo\" id=\"todoCheck-$d->plans_id\" checked>
                                <label for=\"todoCheck-$d->plans_id\"></label>
                            </div>";
                    else
                        $m .= "<li>
                                <!-- drag handle -->
                                <i class=\"fas fa-at\"></i>
                                <!-- checkbox -->
                                <div class=\"icheck-primary d-inline ml-2\">
                                    <input type=\"checkbox\" onclick=\"__finish($d->plans_id)\" name=\"todo\" id=\"todoCheck-$d->plans_id\">
                                    <label for=\"todoCheck-$d->plans_id\"></label>
                                </div>";
                $m .= "
                            <!-- todo text -->
                            <span class=\"text\"> $d->dsc </span>
                            <!-- Emphasis label -->
                            <small class=\"badge bg-gradient-primary\"><i class=\"far fa-clock\"></i> ". Carbon::parse($d->created_at)->diffForHumans() ."</small>
                            <!-- General tools such as edit or delete-->
                            <div class=\"tools\">
                                <i class=\"fas fa-edit\" title=\"Edit\" onclick=\"__edit($d->plans_id, `$d->dsc`)\"></i>
                                <i class=\"fas fa-trash\" title=\"Remove\" onclick=\"__delete($d->plans_id)\"></i>
                            </div>
                        </li>
                               
                     </ul>";
                return $m;
            })
            ->rawColumns(['plan'])
            ->make(true);
    }
}

