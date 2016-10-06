<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use Carbon\Carbon;

use App\Unit;

use App\ApiModel\v2\UnitDeceased;
use App\ApiModel\v2\BusinessDependency;
use App\ApiModel\v2\Collection;

use App\ApiModel\v3\InterestRate;

use App\Business\v1\NotificationBusiness;

class DueCollection extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'due:collection';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Removes over due collection.';

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
        try{

            \DB::beginTransaction();

            $collectionList             =   Collection::where('boolFinish', '=', false)
                ->get();

            $voidOwnershipOverDue   =   BusinessDependency::where('strBusinessDependencyName', 'LIKE', 'voidOwnershipOverDue')
                ->first(['deciBusinessDependencyValue']);

            $gracePeriod            =   BusinessDependency::where('strBusinessDependencyName', 'LIKE', 'gracePeriod')
                ->first(['deciBusinessDependencyValue']);

            $intCtr             =   0;
            foreach($collectionList as $collection){

                $collectionLastPayment      =   Collection::select(
                    'tblCollectionPaymentDetail.dateDue'
                    )
                    ->join('tblCollectionPayment', 'tblCollection.intCollectionId', '=', 'tblCollectionPayment.intCollectionIdFK')
                    ->join('tblCollectionPaymentDetail', 'tblCollectionPayment.intCollectionPaymentId', '=', 'tblCollectionPaymentDetail.intCollectionPaymentIdFK')
                    ->where('tblCollection.intCollectionId', '=', $collection->intCollectionId)
                    ->orderBy('tblCollectionPayment.created_at', 'desc')
                    ->orderBy('tblCollectionPaymentDetail.dateDue', 'desc')
                    ->first();

                if ($collectionLastPayment){
                    $dateNextDue            =   Carbon::parse($collectionLastPayment->dateDue)
                        ->addDays($gracePeriod->deciBusinessDependencyValue)
                        ->addMonth();
                }else{
                    $dateNextDue            =   Carbon::parse($collection->dateCollectionStart)
                        ->addDays($gracePeriod->deciBusinessDependencyValue);
                }//end else

                if (Carbon::today() >= Carbon::parse($dateNextDue)->addMonths($voidOwnershipOverDue->deciBusinessDependencyValue-1)){

                    $intCtr++;
                    (new NotificationBusiness())
                        ->sendForfeitedOwnership($collection);
                    if ($collection->intUnitIdFK){

                        $unit           =   Unit::find($collection->intUnitIdFK);
                        $unit->intUnitStatus        =   1;
                        $unit->intCustomerIdFK      =   null;
                        $unit->save();

                        $deceasedList           =   UnitDeceased::where('intUnitIdFK', '=', $unit->intUnitId)
                            ->get();

                        foreach($deceasedList as $deceased){

                            $deceased->intUnitIdFK = null;
                            $deceased->save();

                        }//end foreach

                    }//end function
                    $collection->delete();
                    $this->info($collection->intCollectionId.' is forfeited.');

                }//end if

            }//end foreach

            $this->info($intCtr.' was found.');

            $collectionList             =   Collection::onlyTrashed()
                ->get();

            $this->info($collectionList->count());

            foreach($collectionList as $collection){

                $collectionLastPayment      =   Collection::withTrashed()
                    ->join('tblCollectionPayment', 'tblCollection.intCollectionId', '=', 'tblCollectionPayment.intCollectionIdFK')
                    ->join('tblCollectionPaymentDetail', 'tblCollectionPayment.intCollectionPaymentId', '=', 'tblCollectionPaymentDetail.intCollectionPaymentIdFK')
                    ->where('tblCollection.intCollectionId', '=', $collection->intCollectionId)
                    ->orderBy('tblCollectionPayment.created_at', 'desc')
                    ->orderBy('tblCollectionPaymentDetail.dateDue', 'desc')
                    ->first();

                $intMonthsPaid      =       0;

                if ($collectionLastPayment){

                    $dateNextDue            =   Carbon::parse($collectionLastPayment->dateDue)
                        ->addDays($gracePeriod->deciBusinessDependencyValue)
                        ->addMonth();

                    $intMonthsPaid      =   Collection::onlyTrashed()
                        ->join('tblCollectionPayment', 'tblCollection.intCollectionId', '=', 'tblCollectionPayment.intCollectionIdFK')
                        ->join('tblCollectionPaymentDetail', 'tblCollectionPayment.intCollectionPaymentId', '=', 'tblCollectionPaymentDetail.intCollectionPaymentIdFK')
                        ->where('tblCollection.intCollectionId', '=', $collection->intCollectionId)
                        ->count();

                }else{
                    $dateNextDue            =   Carbon::parse($collection->dateCollectionStart)
                        ->addDays($gracePeriod->deciBusinessDependencyValue);
                }//end else

                if (Carbon::today() < Carbon::parse($dateNextDue)->addMonths($voidOwnershipOverDue->deciBusinessDependencyValue-1)){

                    if ($collection->intUnitIdFK){

                        $unit               =   Unit::find($collection->intUnitIdFK);
                        $interestRate       =   InterestRate::find($collection->intInterestRateIdFK);

                        $partiallyOwned     =   BusinessDependency::where('strBusinessDependencyName', 'LIKE', 'partiallyOwned')
                            ->first(['deciBusinessDependencyValue']);

                        if ($interestRate->intAtNeed == 1){

                            $unit->intUnitStatus            =   4;

                        }//end if
                        else{

                            if ($intMonthsPaid >= $partiallyOwned->deciBusinessDependencyValue){

                                $unit->intUnitStatus        =   6;

                            }//end if
                            else{

                                $unit->intUnitStatus        =   5;

                            }//end else

                        }//end else

                        $unit->intCustomerIdFK  =   $collection->intCustomerIdFK;
                        $unit->save();

                    }//end if

                    $collection->restore();

                }//end if

            }//end foreach

            \DB::commit();

            $this->info('Successfully deleted overdue collections.');

        }catch(\Exception $e){

            $this->info($e->getMessage());

        }//end catch

    }
}
