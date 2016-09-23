<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use Carbon\Carbon;

use App\Unit;

use App\ApiModel\v2\Downpayment;
use App\ApiModel\v2\BusinessDependency;

use App\ApiModel\v3\InterestRate;

class DueDownpayment extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'due:downpayment';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Forfeits overdue downpayments.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
         try {

             \DB::beginTransaction();

             $downpaymentList = Downpayment::leftJoin('tblDownpaymentPayment', 'tblDownpayment.intDownpaymentId', '=', 'tblDownpaymentPayment.intDownpaymentIdFK')
                 ->where('tblDownpayment.boolPaid', '=', false)
                 ->whereNull('tblDownpaymentPayment.intDownpaymentPaymentId')
                 ->groupBy('tblDownpayment.intDownpaymentId')
                 ->get([
                     'tblDownpayment.intDownpaymentId',
                     'tblDownpayment.intCustomerIdFK',
                     'tblDownpayment.intUnitIdFK',
                     'tblDownpayment.created_at'
                 ]);

             $voidDownpaymentNoPayment = BusinessDependency::where('strBusinessDependencyName', 'LIKE', 'voidReservationNoPayment')
                 ->first();

             $voidDownpaymentNotFullPayment = BusinessDependency::where('strBusinessDependencyName', 'LIKE', 'voidReservationNotFullPayment')
                 ->first();

             foreach ($downpaymentList as $downpayment) {

                 $date = Carbon::parse($downpayment->created_at)->addDays($voidDownpaymentNoPayment->deciBusinessDependencyValue);
                 $current = Carbon::now();

                 if ($current >= $date) {

                     $downpayment->delete();

                     $unit = Unit::find($downpayment->intUnitIdFK);
                     $unit->intUnitStatus = 1;
                     $unit->save();

                 }

             }

             $downpaymentList = Downpayment::where('tblDownpayment.boolPaid', '=', false)
                                 ->get([
                                     'tblDownpayment.intDownpaymentId',
                                     'tblDownpayment.created_at',
                                     'tblDownpayment.intUnitIdFK'
                                 ]);

             foreach ($downpaymentList as $downpayment) {

                 $date = Carbon::parse($downpayment->created_at)->addDays($voidDownpaymentNotFullPayment->deciBusinessDependencyValue);
                 $current = Carbon::now();

                 if ($current >= $date) {
                     $downpayment->delete();

                     $unit = Unit::find($downpayment->intUnitIdFK);
                     $unit->intUnitStatus        =   1;
                     $unit->intCustomerIdFK      =   null;
                     $unit->save();
                 }

             }

             $downpaymentList       =   Downpayment::onlyTrashed()
                ->where('tblDownpayment.boolPaid', '=', false)
                ->where('tblDownpayment.boolSwitch', '=', false)
                ->where('dateDueDate', '>', Carbon::today())
                ->get();

            $this->info($downpaymentList->count().' are found.');

            foreach($downpaymentList as $downpayment){

                $downpayment->restore();

                $interestRate       =   InterestRate::find($downpayment->intInterestRateIdFK);

                $unit       =   Unit::find($downpayment->intUnitIdFK);
                $unit->intCustomerIdFK      =   $downpayment->intCustomerIdFK;
                $unit->intUnitStatus        =   $interestRate->intAtNeed == 1? 4 : 2;
                $unit->save();

            }//end foreach

             \DB::commit();
             $this->info('Overdue downpayment are deleted.');

         }catch (\Exception $e){

             \DB::rollBack();

         }

    }
}
