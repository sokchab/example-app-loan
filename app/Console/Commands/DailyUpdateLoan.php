<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Trans\Loan;
use Carbon\Carbon;
// use Illuminate\Console\Command;
use App\Holiday;
use App\LateLoanHistory;

class DailyUpdateLoan extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:name';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        Loan::isActive()->get()->each(function ($rw){
            if($rw->penalty == 1){
                $rw->getCollection->where('date_pay', '<', Carbon::now())
                    ->where('state', false)
                    ->each(function ($row){
                        $late = Carbon::parse(Carbon::now())->diffInDays($row->date_pay);
                        $dd = Carbon::parse($row->date_pay);
                        $lte = $late;// - \Hel::holiday($dd) - \Hel::baseHoliday($row->date_pay);
                        $row->late = $lte;
                        $ti = 0;
                        if($lte >= 3) {
                            $ti = $lte;// - 3 - \Hel::getWeekendDays($dd, Carbon::now()) - \Hel::baseHoliday($row->date_pay);
                            $dsm = $ti > 0 ? $ti : 0;
                            $row->fee = $dsm;
                            $row->kok = $dsm;
                        

                            LateLoanHistory::updateOrCreate(
                                [ 'sheet' => $row->id ],
                                [ 
                                    'client' => $row->getLoan->getClient->id,
                                    'loan' => $row->getLoan->id,
                                ]
                            );
                        }

                        $row->save();
                });
            }else{
                $rw->getCollection->where('date_pay', '<', Carbon::now())
                    ->where('state', false)
                    ->each(function ($row){
                        $late = Carbon::parse(Carbon::now())->diffInDays($row->date_pay);
                        $dd = Carbon::parse($row->date_pay);
                        $lte = $late;// - \Hel::holiday($dd) - \Hel::baseHoliday($row->date_pay);
                        $row->late = $lte;
                        $ti = 0;
                        if($lte >= 3){
                            $ti = ceil(0.01 * $row->amount) * ($lte);// - 3 - \Hel::getWeekendDays($dd, Carbon::now()) - \Hel::baseHoliday($row->date_pay));
                            $dmc = $ti > 0 ? $ti : 0;
                            $row->fee = $dmc;
                            $row->kok = $dmc;
                            
                            LateLoanHistory::updateOrCreate(
                                [ 'sheet' => $row->id ],
                                [ 
                                    'client' => $row->getLoan->getClient->id,
                                    'loan' => $row->getLoan->id, 
                                ]
                            );
                        }
                        $row->save();
                        
                });
            }
        });
        //
        Loan::where('status', 3)->get()->each(function($rs){
            if($rs->getCollection->sum('print_due_return') > 0 || $rs->getCollection->sum('inter_due_return')){
                $rs->status =1;
                $rs->save();
            }
        });

        return Command::SUCCESS;
    }
}
