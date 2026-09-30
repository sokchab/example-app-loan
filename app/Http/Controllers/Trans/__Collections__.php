<?php

namespace App\Http\Controllers\Trans;

use App\Http\Controllers\Controller;
use App\Raturnable\Payments;
use App\Trans\WithClient;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Trans\Cols\CollectionSheet as Cs;
use App\Trans\Loan as Ln;
use App\Helpers\Helper as He;
use App\Helpers\Amortization;
use App\Nests;
use App\PayCol;
use App\Trans\Cols\Schedule;
use App\FinishLoanHistory;

class __Collections__ extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }


    public function index(){
        $css = Ln::isActive()
            ->whereHas('getCollection', function($query){
                $query->where('date_pay', '<=', Carbon::now()->subDays(5))
                    ->where('state', false);
            })
            ->orderBy('created_at', 'desc')->get();

        //return dd($css);

        return view("trans.collections.index", [
            'css' => $css
        ]);

    }

    public function overdue()
    {
        $css = Ln::isActive()
            ->whereHas('getCollection', function($query){
                $query->where('date_pay', '<=', Carbon::now()->subMonths(1))
                    ->where('state', false);
            })
            // ->whereRaw("id in (select loan from collection_sheets where date_pay <= '".Carbon::now()->subMonths(1)."' and state = 0)")
            ->orderBy('created_at', 'desc')->get();

        return view("trans.collections.overdue", [
            'css' => $css
        ]);
    }

    public function __return(Request $request)
    {
        $request->op = 'loan';
        return view('trans.collections.returns', [
            'data' => Ln::isActive()->orderBy('created_at', 'desc')->paginate(1),
            'nest' => $request
        ]);
    }

    public function __search(Request $request)
    {
        $page = 15;

        $rQS = trim($request->q);

        $data = Ln::where('status', 1)
                    ->where('acc_number', 'LIKE', "%$rQS%")
                    ->orWhereHas('getClient', function($query) use ($request){
                        $dds = trim($request->q);
                        $query->where('cus_key', 'like', "%$dds%")
    
                            ->orWhere('first_name', 'like', "%$request->q%")
                            ->orWhere('last_name', 'like', "%$request->q%")
    
                            ->orWhere('last_name_en', 'like', "%$request->q%")
                            ->orWhere('first_name_en', 'like', "%$request->q%")
    
                            ->orWhere('phone2', 'like', "%$request->q%")
                            ->orWhere('phone', 'like', "%$request->q%");
                    })
                    ->orWhereHas('getJoin', function($query) use ($request){
                        $query->where('first_name', 'like', "%$request->q%")
                            ->orWhere('last_name', 'like', "%$request->q%")
    
                            ->orWhere('first_name_en', 'like', "%$request->q%")
                            ->orWhere('last_name_en', 'like', "%$request->q%")
    
                            ->orWhere('phone2', 'like', "%$request->q%")
                            ->orWhere('phone', 'like', "%$request->q%");
                    })
                    ->orWhereHas('getGuaranteed', function($query) use ($request){
                        $query->where('first_name', 'like', "%$request->q%")
                            ->orWhere('last_name', 'like', "%$request->q%")
    
                            ->orWhere('first_name_en', 'like', "%$request->q%")
                            ->orWhere('last_name_en', 'like', "%$request->q%")
    
                            ->orWhere('phone2', 'like', "%$request->q%")
                            ->orWhere('phone', 'like', "%$request->q%");
                    })
                    ->orWhereHas('getGuaranteedJoin', function($query) use ($request){
                        $query->where('first_name', 'like', "%$request->q%")
                            ->orWhere('last_name', 'like', "%$request->q%")
    
                            ->orWhere('first_name_en', 'like', "%$request->q%")
                            ->orWhere('last_name_en', 'like', "%$request->q%")
    
                            ->orWhere('phone2', 'like', "%$request->q%")
                            ->orWhere('phone', 'like', "%$request->q%");
                    })->orWhereHas('getCollaterals', function($qu) use ($request){
                        $qu->where('iden', 'like', "%$request->q%")
                        ->orWhere('extra', 'like', "%$request->q%")
                        ->orWhere('year', 'like', "%$request->q%")
                        ->orWhere('model', 'like', "%$request->q%");
                    })
                    ->orderBy('created_at', 'desc')
                    ->paginate($page);

        //            
        return view('trans.collections.returns', [
            'data' => $data,
            'nest' => $request
        ]);
    }


    public function __search_ref($val)
    {
        $data  = Ln::where('id',$val);
        return view("trans.collections.return_form", ['data' => $data->first()]);
    }

    public function __payment($val)
    {
        return view('trans.collections.payment', [ 'data' => Cs::findOrFail($val) ]);
    }

    //Create payment
    public function __submit_payment(Request $request, $id)
    {

        $cs = Cs::findOrFail($id);

        if($cs->state != 0)
            return redirect()->route("collection.return.search.ref",$cs->getLoan->id);

        $lte = $request->principal + $request->interest + $request->penalty;

        $request->validate([
            // 'principal' => 'required|numeric|min:0',
            // 'interest' => 'required|numeric|min:0',
            'penalty' => 'required|numeric|min:0',
            'paid' => "required|numeric|gte:1|lte:$lte",
            'paid_date' => "required|date",
        ]);

        $paid = $request->paid;

        $print_due = 0;
        $inter_due = 0;
        $penalty  = 0;
        $flag_save = false;

        $balance = $cs->balance;
        
        $max_byPaid = $cs->getLoan->getCollection->max('by_paid');

        

        if($paid < $request->penalty){
            $penalty = $paid;
            $flag_save = true;
        }else{
            $penalty = $request->penalty;
            $paid = $paid - $penalty;// - $request->principal;

            if($paid < $request->interest){
                $inter_due = $paid;
                $flag_save = true;
            }else{
                $inter_due = $request->interest;

                $paid = $paid - $request->interest;

                if($paid < $request->principal) {
                    $print_due = $paid;
                    $flag_save = true;
                    // $balance = $balance + ($request->principal - $print_due);
                }else{

                    //$balance = $balance + ($request->principal - $print_due);
                    $print_due = $request->principal;
                }
            }
        }


        $pay = Payments::create([
            'Principal' => $print_due,
            'Interest' => $inter_due,
            'Penalty' => $penalty,
            'LoanCollection' => $id,
            'user_id' => auth()->user()->id,
            'paid_date' => $request->paid_date,
            'other' => $request->others,
            'paid_by' => $request->paid_by,
        ]);

        //Create Payment

        $nest = Nests::max('votes');
        $pay->getNest()->create([
            'votes' => $nest + 1
        ]);

        //flag call
        $by_id = $cs->by_id != null ? $cs->by_id : $cs->id;
        $by_paid = $cs->by_paid != null ? $cs->by_paid : $max_byPaid + 1;
        //end flag call

        if($flag_save){
            $pr = $cs->print_due_return - $print_due;
            $in = $cs->inter_due_return - $inter_due;
            $pp = $cs->fee - $penalty;

            if(Carbon::parse($cs->date_pay) > now()){
                $newDate = Carbon::parse($cs->date_pay)->addMonths(1);
            }else{
                $newDate = Carbon::parse(now())->addMonths(1);
            }

            $csNew = Cs::create([
                'date_pay' => $newDate,
                'amount' => $pr + $in,
                'print_due' => 0,
                'inter_due' => $in,
                'balance' => $balance - $pr,
                'fee' => $pp,
                'late' => 0,
                'loan' => $cs->getLoan->id,
                'print_due_return'  => $pr,
                'inter_due_return' => $in,
                'fee_return' => $cs->fee_return,
                'state' => 0,
                'is_active' => true,
                'prefix' => $cs->prefix,
                'by_paid' => $by_paid,
                'by_id' => $by_id,
                'same_value' => $pr,
                'pay_col_id' => $cs->pay_col_id,
            ]);
            $cs->state = 2; //Not yet completae
            $cs->by_paid = $by_paid;

            // if($cs->PayCols()->count() > 0){
            //     $csNew->PayCols()->create([
            //         'second' => $cs->PayCols()->first()->second
            //     ]);
            // }else{
            //     $csNew->PayCols()->create([
            //         'second' => $csNew->id
            //     ]);
            // }
        } else {
            $cs->state = 1;
            
            // $cs->PayCols()->Collections()->update([
            //     'state' => 1
            // ]);
            // if($cs->PayCols()->count() > 0){
            //     $cs->PayCols()->get()->each(function($row){
                    Cs::where('pay_col_id', $cs->pay_col_id)->update([
                        'state' => 1
                    ]);
            //     });
            // }
        }
        $cs->print_due_return = 0;
        $cs->inter_due_return = 0;
        //$cs->late = 0;
        $cs->fee = 0;
        $cs->kok = $request->penalty;

        $cs->save();
        //}
       

        //Submit CashFlow
        if($print_due > 0)
            WithClient::bankInFlow($print_due, 4, 'Collection');
        if($penalty > 0)
            WithClient::bankInFlow($penalty, 7, 'Retained Earning from Penalty');
        if($inter_due > 0)
            WithClient::bankInterest($inter_due);

        //Check Loan Status
        $loan = $cs->getLoan;
        if($loan->getCollection->max('id') == $cs->id){
            $loan->status = 3; //Loan finish
            $loan->save();
            //
            FinishLoanHistory::updateOrCreate(
                [ 'sheet' => $cs->id ],
                [ 'client' => $loan->getClient->id ]
            );
        }

        // return redirect()->route("collection.return.search.ref",$cs->getLoan->id);
        return redirect()->route('loans.invoice', $pay->id);
    }

    public function __finishLoan($id)
    {
        $data = Ln::findOrFail($id);
        $penalty = 0;
        $count = $data->getCollection->where('state', true)->count();
        if($count < 3){
            $penalty = ceil($data->getCollection->sum('print_due_return') * 0.05);
        }
        return view('trans.submit.finish', compact(['data', 'penalty']));
    }

    public function __finishLoanPay(Request $request, $id)
    {
        $paid = $request->principal + $request->interest;
        $max_pad = $paid + $request->late + $request->penalty;

        $request->validate([
            // 'principal' => 'required|numeric|min:0',
            // 'interest' => 'required|numeric|min:0',
            'late' => 'required|numeric|min:0',
            'penalty' => 'required|numeric|min:0',
            'totals' => "required|numeric|min:$paid|max:$max_pad",
            'paid_date' => 'required|date',           
        ]);

        $loan = Ln::findOrFail($id);

        if($loan->status == 3)
            return redirect()->route("collection.return.search.ref",$loan->id);
        

        $loan->status = 3;

        $paid_id = $loan->getCollection->where('state', false)->max('id');
        
        $loan->getCollection->where('state', false)->each(function($row){
            $row->print_due_return = 0;
            $row->inter_due_return = 0;
            $row->fee = 0;
            $row->is_finish = 1;
            $row->state = 1;
            $row->save();
        });
        
        $loan->save();

        $pay = Payments::create([
            'Principal' => $request->principal,
            'Interest' => $request->interest,
            'Penalty' => $request->penalty + $request->late,
            'LoanCollection' => $paid_id,
            'user_id' => auth()->user()->id,
            'paid_date' => $request->paid_date,
            'other' => $request->others,
            'paid_by' => $request->paid_by,
        ]);

        $nest = Nests::max('votes');
        $pay->getNest()->create([
            'votes' => $nest + 1
        ]);

        //Submit CashFlow
        if($request->principal > 0)
            WithClient::bankInFlow($request->principal, 4, 'Collection');
        if($request->penalty > 0 || $request->late > 0)
            WithClient::bankInFlow($request->penalty + $request->late, 7, 'Retained Earning from Penalty');
        if($request->interest > 0)
            WithClient::bankInterest($request->interest);

        //return redirect()->route("collection.return.search.ref",$loan->id);
        $cs = Cs::findOrFail($paid_id);

        FinishLoanHistory::updateOrCreate(
            [ 'sheet' => $paid_id ],
            [ 'client' => $loan->getClient->id ]
        );
        
        return redirect()->route('loans.invoice', $pay->id);  //$cs->getPayments->id
        //*/
    }

    public function __reCreate($id)
    {
        $d = Ln::findOrFail($id);
        $dd = \Carbon\Carbon::now()->addMonths(1)->toDateString();
        $n = $d->getCollection()->max('fee_return');
        //ដើម្បីបញ្ចាក់ថាតារាងសងប្រាក់លើកទីប៉ុន្មាន
        $term = $d->getCollection()->where('fee_return', $n)->where('state', false)->count();
        return view('recreate', compact(['d', 'dd', 'term', 'n']));
    }

    public function __reStore(Request $rq, $id)
    {
        $loan = Ln::findOrFail($id);
        $lte = $loan->getCollection->sum('print_due_return');
        $lti = $loan->getCollection->max('amount') - $loan->getCollection->max('inter_due_return');
        $int = $loan->getCollection->max('inter_due_return');
        $lt = $lte - $lti;//$request->Depreciation + 

        $rq->validate([
            // 'principal' => "required|numeric|min:$lti|max:$lti",
            // 'interest' => "required|numeric|min:$int|max:$int",
            'penalty' => 'required|numeric|min:0',
            'pay_day' => 'required|date',
            'term' => 'required|numeric|min:1',
            'Depreciation' => "required|numeric|min:300|lt:$lt",
            'paid_date' => "required|date",
        ]);

        $xnm = $loan->getCollection()->max('fee_return');
        
        if($rq->_flag_recreate < $xnm)
            return redirect()->route("collection.return.search.ref",$loan->id);


        $rq->principal = $rq->principal + $rq->Depreciation;
        $lcs_id = $loan->getCollection()->notReturn()->orderBy('date_pay')->first()->id;

        $pay = Payments::create([
            'Principal' => $rq->principal,
            'Interest' => $rq->interest,
            'Penalty' => $rq->penalty,
            'LoanCollection' => $lcs_id,
            'user_id' => auth()->user()->id,
            'paid_date' => $rq->paid_date,
            'other' => $rq->others,
            'paid_by' => $rq->paid_by,
        ]);

        $nest = Nests::max('votes');
        $pay->getNest()->create([
            'votes' => $nest + 1
        ]);
        
        $pay_day = $rq->pay_day;

        $balance = $loan->getCollection()->sum('print_due_return');
        $term = $rq->term;
        $day = $loan->getCollection()->notReturn()->orderBy('date_pay')->first()->date_pay;



        $queue = $rq->_flag_recreate + 1;// $loan->getCollection()->max('fee_return') + 1;
        
        //update old loan collection sheet
        $loan->getCollection()->notReturn()->each(function($row){
            $row->print_due_return = 0;
            $row->inter_due_return = 0;
            $row->fee = 0;
            //$row->late = 0;
            $row->state = 1;
            //if($row->id != $lcs_id)
            $row->is_active = 0;
            
            $row->save();
        });

        $csd = Cs::findOrFail($lcs_id);
        $csd->is_active = 1;
        $csd->save();

        //Recreate
        $val = new Amortization();
        $val->Amount($balance - $rq->principal);
        $val->StartDate($pay_day);
        $val->Term($term);
        $val->Rate($loan->interest_rate);

        foreach($val->schedules() as $d){
            $paycol = PayCol::create();
            Cs::create([
                'date_pay' => $d['date'],
                'amount'  => $d['total'],
                'print_due' => $d['principal'], 
                'inter_due' => $d['interest'],
                'balance' => $d['balance'], 
                'fee' => 0,
                'late' => 0, 
                'loan' => $loan->id,
                'print_due_return' => $d['principal'], 
                'inter_due_return' => $d['interest'], 
                'fee_return' => $queue,
                'prefix' => now(),
                'same_value' => $d['principal'],
                'pay_col_id' => $paycol->id,
            ]);

            Schedule::create([
                'date_pay' => $d['date'],
                'amount'  => $d['total'],
                'prin_due' => $d['principal'], 
                'inter_due' => $d['interest'],
                'balance' => $d['balance'], 
                'loan_id' => $loan->id,
                'date_disburs' => now(),
                'tag' => $queue
            ]);
        }

        //Reportings
        if($rq->principal > 0)
            WithClient::bankInFlow($rq->principal, 4, 'Collection');
        if($rq->penalty > 0)
            WithClient::bankInFlow($rq->penalty, 7, 'Retained Earning from Penalty');
        if($rq->interest > 0)
            WithClient::bankInterest($rq->interest);
        
        // return redirect()->route('collection.return', ['op' => 'loan']);
        return redirect()->route('loans.invoice', $pay->id);
    }


    public function __Invoice($id)
    {
        $data = Payments::findOrFail($id);
        return view('invoice', compact('data'));
    }
}
