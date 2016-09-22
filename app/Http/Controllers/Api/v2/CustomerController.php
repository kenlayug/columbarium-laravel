<?php

namespace App\Http\Controllers\Api\v2;

use App\ApiModel\v2\BusinessDependency;
use App\ApiModel\v2\Collection;
use App\ApiModel\v2\CollectionPayment;
use App\ApiModel\v2\Deceased;
use App\ApiModel\v2\Downpayment;
use App\ApiModel\v2\DownpaymentPayment;
use App\ApiModel\v2\TransactionPurchase;

use App\ApiModel\v3\TransactionUnitDetail;
use App\ApiModel\v3\AssignDiscount;
use App\ApiModel\v3\DiscountRate;
use App\ApiModel\v3\DownpaymentDiscount;

use App\Customer;
use App\Reservation;
use App\UnitCategoryPrice;
use App\Unit;

use DB;

use App\Business\v1\CollectionBusiness;
use App\Business\v1\PenaltyBusiness;

use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class CustomerController extends Controller
{
    public function getAllCustomersWithReservations(){

        $customerList   =   Customer::join('tblReservation', 'tblReservation.intCustomerIdFK', '=', 'tblCustomer.intCustomerId')
                                ->join('tblReservationDetail', 'tblReservationDetail.intReservationIdFK', '=', 'tblReservation.intReservationId')
                                ->where('tblReservationDetail.boolDownpayment', '=', false)
                                ->whereNull('tblReservationDetail.deleted_at')
                                ->groupBy('tblCustomer.intCustomerId')
                                ->get([
                                    'tblCustomer.intCustomerId',
                                    'tblCustomer.strFirstName',
                                    'tblCustomer.strMiddleName',
                                    'tblCustomer.strLastName'
                                ]);
        foreach ($customerList as $customer){

            $customer->full_name = $customer->strLastName.', '.$customer->strFirstName.' '.$customer->strMiddleName;

        }

        return response()
            ->json(
                [
                    'customerList'          =>  $customerList
                ],
                200
            );

    }

    public function getAllReservationsWithPayable($customerId){

        $reservationList = Reservation::join('tblCustomer', 'tblCustomer.intCustomerId', '=', 'tblReservation.intCustomerIdFK')
                            ->join('tblReservationDetail', 'tblReservation.intReservationId', '=', 'tblReservationDetail.intReservationIdFK')
                            ->join('tblUnitCategoryPrice', 'tblUnitCategoryPrice.intUnitCategoryPriceId', '=', 'tblReservationDetail.intUnitCategoryPriceIdFK')
                            ->where('tblReservationDetail.boolDownpayment', '=', false)
                            ->where('tblCustomer.intCustomerId', '=', $customerId)
                            ->get([
                                'tblReservation.intReservationId',
                                'tblReservationDetail.intReservationDetailId',
                                'tblReservationDetail.intUnitIdFK',
                                'tblUnitCategoryPrice.deciPrice',
                                'tblReservationDetail.created_at'
                            ]);

        $downpaymentPercentage  =   BusinessDependency::where('strBusinessDependencyName', 'LIKE', 'downpayment')
                                        ->first(['deciBusinessDependencyValue']);

        $discountSpotdown       =   BusinessDependency::where('strBusinessDependencyName', 'LIKE', 'discountSpotdown')
                                        ->first(['deciBusinessDependencyValue']);

        foreach ($reservationList as $reservation){

            $reservation->downpayment = $reservation->deciPrice*$downpaymentPercentage->deciBusinessDependencyValue;

            $dateNow                =   Carbon::today();
            $dateWithDiscount       =   Carbon::parse($reservation->created_at)->addDays(7);

            if ($dateNow <= $dateWithDiscount){
                $reservation->downpayment   =   $reservation->downpayment-($reservation->downpayment*$discountSpotdown->deciBusinessDependencyValue);
            }

            $downpaymentPaid = Downpayment::where('intReservationDetailIdFK', '=', $reservation->intReservationDetailId)
                                ->sum('deciAmount');
            $reservation->balance = $reservation->downpayment-$downpaymentPaid;

        }

        return response()
            ->json(
                [
                    'reservationList'           =>  $reservationList
                ],
                200
            );

    }

    public function getCustomersWithCollections(){

        $customerList   =   Customer::join('tblCollection', 'tblCollection.intCustomerIdFK', '=', 'tblCustomer.intCustomerId')
                                ->where('tblCollection.boolFinish', '=', false)
                                ->whereNull('tblCollection.deleted_at')
                                ->groupBy('tblCustomer.intCustomerId')
                                ->get([
                                    'tblCustomer.strFirstName',
                                    'tblCustomer.strMiddleName',
                                    'tblCustomer.strLastName',
                                    'tblCustomer.intCustomerId'
                                ]);

        foreach ($customerList as $customer){

            $customer->full_name = $customer->strLastName.', '.$customer->strFirstName.' '.$customer->strMiddleName;

        }

        return response()
            ->json(
                [
                    'customerList'  =>  $customerList
                ],
                200
            );

    }

    public function getAllCollections($id){

        $collectionList = Collection::join('tblUnitCategoryPrice', 'tblUnitCategoryPrice.intUnitCategoryPriceId', '=', 'tblCollection.intUnitCategoryPriceIdFK')
            ->join('tblInterestRate', 'tblInterestRate.intInterestRateId', '=', 'tblCollection.intInterestRateIdFK')
            ->join('tblInterest', 'tblInterest.intInterestId', '=', 'tblInterestRate.intInterestIdFK')
            ->where('intCustomerIdFK', '=', $id)
            ->where('tblCollection.boolFinish', '=', false)
            ->get([
                'tblCollection.intCollectionId',
                'tblCollection.intUnitIdFK',
                'tblCollection.dateCollectionStart',
                'tblInterest.intNoOfYear',
                'tblInterestRate.deciInterestRate',
                'tblUnitCategoryPrice.deciPrice'
            ]);

        $collectionDetailList           =   array();
        foreach($collectionList as $collection){

            $deciMonthlyAmortization            =   (new CollectionBusiness())
                ->getMonthlyAmortization($collection->deciPrice, $collection->deciInterestRate, $collection->intNoOfYear);

            $lastCollectionPayment              =   CollectionPayment::select(
                'tblCollectionPaymentDetail.dateDue'
                )
                ->join('tblCollectionPaymentDetail', 'tblCollectionPayment.intCollectionPaymentId', '=', 'tblCollectionPaymentDetail.intCollectionPaymentIdFK')
                ->where('intCollectionIdFK', '=', $collection->intCollectionId)
                ->orderBy('tblCollectionPayment.created_at', 'desc')
                ->orderBy('tblCollectionPaymentDetail.dateDue', 'desc')
                ->first();

            $intMonthsPaid                      =   CollectionPayment::join('tblCollectionPaymentDetail', 'tblCollectionPayment.intCollectionPaymentId', '=', 'tblCollectionPaymentDetail.intCollectionPaymentIdFK')
                ->where('tblCollectionPayment.intCollectionIdFK', '=', $collection->intCollectionId)
                ->count();

            $collectionDetail                   =   array(
                'intCollectionId'               =>  $collection->intCollectionId,
                'intUnitIdFK'                   =>  $collection->intUnitIdFK,
                'deciMonthlyAmortization'       =>  $deciMonthlyAmortization,
                'dateNextDue'                   =>  $lastCollectionPayment ? Carbon::parse($lastCollectionPayment->dateDue)
                    ->addMonth()
                    ->toFormattedDateString() : Carbon::parse($collection->dateCollectionStart)->toFormattedDateString(),
                'intMonthsPaid'                 =>  $intMonthsPaid,
                'deciCollectible'               =>  $this->getPerCollectionCollectible($collection)
            );
            array_push($collectionDetailList, $collectionDetail);

        }//end foreach

        return $collectionDetailList;              

    }

    public function getCustomer(Request $request){

        $customer = Customer::whereRaw("CONCAT(strLastName, ', ',strFirstName, ' ', strMiddleName) = '".$request->strCustomerName."'")
            ->first();

        if ($customer == null){
            return response()
                ->json(
                    [
                        'message'       =>  'Oops.',
                        'error'         =>  'Customer does not exist.'
                    ],
                    404
                );
        }

        return response()
            ->json(
                [
                    'customer'  =>  $customer
                ],
                200
            );
    }

    public function getCustomersWithDownpayment(){

        $customerList           =   Customer::join('tblDownpayment', 'tblCustomer.intCustomerId', '=', 'tblDownpayment.intCustomerIdFK')
            ->whereNull('tblDownpayment.deleted_at')
            ->where('tblDownpayment.boolPaid', '=', false)
            ->groupBy('tblCustomer.intCustomerId')
            ->get([
                'tblCustomer.strFirstName',
                'tblCustomer.strMiddleName',
                'tblCustomer.strLastName',
                'tblCustomer.intCustomerId'
            ]);

        foreach ($customerList as $customer){

            $customer->full_name    =   $customer->strLastName.', '.$customer->strFirstName.' '.$customer->strMiddleName;

        }

        return response()
            ->json(
                [
                    'customerList'      =>  $customerList
                ],
                200
            );

    }

    public function getCustomerDownpayment($id){

        $reservationFee             =   BusinessDependency::where('strBusinessDependencyName', 'LIKE', 'reservationFee')
            ->first(['deciBusinessDependencyValue']);

        $downpaymentList            =   Downpayment::where('boolPaid', '=', false)
            ->join('tblUnitCategoryPrice', 'tblUnitCategoryPrice.intUnitCategoryPriceId', '=', 'tblDownpayment.intUnitCategoryPriceIdFK')
            ->where('tblDownpayment.intCustomerIdFK', '=', $id)
            ->get();

        $downpaymentPercentage      =   BusinessDependency::where('strBusinessDependencyName', 'LIKE', 'downpayment')
                                            ->first();

        foreach ($downpaymentList   as $downpayment){

            $discountList               =   $this->getDownpaymentDiscount($downpayment->intDownpaymentId);

            $dateNow                =   Carbon::today();
            $dateWithDiscount       =   Carbon::parse($downpayment->created_at)->addDays(7);

            $totalDownpaymentAmount =   $this->computeDiscountedDownpayment($downpayment);

            $deciTotalDownpaymentPaid   =   DownpaymentPayment::where('intDownpaymentIdFK', '=', $downpayment->intDownpaymentId)
                                                ->sum('deciAmountPaid');
            
            $downpayment->balance       =   $totalDownpaymentAmount - $deciTotalDownpaymentPaid;

        }//end foreach

        return $downpaymentList;

    }

    public function getCustomerDeceased($id){

        $deceasedList           =   Deceased::leftJoin('tblUnitDeceased', 'tblDeceased.intDeceasedId', '=', 'tblUnitDeceased.intDeceasedIdFK')
            ->where('tblDeceased.intCustomerIdFK', '=', $id)
            ->whereNull('tblUnitDeceased.intUnitDeceasedId')
            ->get();

        foreach($deceasedList as $deceased){

            $deceased->full_name    =   $deceased->strLastName.', '.$deceased->strFirstName.' '.$deceased->strMiddleName;

        }

        return response()
            ->json(
                    [
                        'deceasedList'      =>  $deceasedList
                    ],
                    200
                );

    }

    public function getAllCustomersWithUnitTransaction(){

        $customerList       =   Customer::select(
            'tblCustomer.intCustomerId',
            'tblCustomer.strFirstName',
            'tblCustomer.strMiddleName',
            'tblCustomer.strLastName'
            )
            ->join('tblUnit', 'tblCustomer.intCustomerId', '=', 'tblUnit.intCustomerIdFK')
            ->groupBy('tblCustomer.intCustomerId')
            ->get();

        return response()
            ->json(
                [
                    'customerList'      =>  $customerList
                ],
                200
            );

    }//end function

    public function getCustomerUnits($id){

        $unitList           =   Unit::select(
            'tblBuilding.strBuildingName',
            'tblFloor.intFloorNo',
            'tblRoom.strRoomName',
            'tblBlock.intBlockNo',
            'tblUnitCategory.intLevelNo',
            'tblUnit.intColumnNo',
            'tblUnit.intUnitId'
            )
            ->join('tblUnitCategory', 'tblUnitCategory.intUnitCategoryId', '=', 'tblUnit.intUnitCategoryIdFK')
            ->join('tblBlock', 'tblBlock.intBlockId', '=', 'tblUnit.intBlockIdFK')
            ->join('tblRoom', 'tblRoom.intRoomId', '=', 'tblBlock.intRoomIdFK')
            ->join('tblFloor', 'tblFloor.intFloorId', '=', 'tblRoom.intFloorIdFK')
            ->join('tblBuilding', 'tblBuilding.intBuildingId', '=', 'tblFloor.intBuildingIdFK')
            ->where('tblUnit.intCustomerIdFK', '=', $id)
            ->get();

        foreach($unitList as $unit){

            $transaction        =   TransactionUnitDetail::select(
                'intTransactionType'
                )
                ->where('intUnitIdFK', '=', $unit->intUnitId)
                ->orderBy('created_at', 'desc')
                ->first();
            $unit->intTransactionType           =   $transaction->intTransactionType;

        }//end foreach

        return response()
            ->json(
                [
                    'unitList'      =>  $unitList
                ],
                200
            );

    }//end function

    public function getCustomerWithCollectibles(){

        $customerList           =   array();

        $downpaymentList        =   Downpayment::select(
            'tblCustomer.intCustomerId',
            'tblCustomer.strFirstName',
            'tblCustomer.strMiddleName',
            'tblCustomer.strLastName'
            )
            ->join('tblCustomer', 'tblCustomer.intCustomerId', '=', 'tblDownpayment.intCustomerIdFK')
            ->where('tblDownpayment.boolPaid', '=', false)
            ->groupBy('tblCustomer.intCustomerId')
            ->get();

        $customerList       =   $this->addToList($downpaymentList, $customerList);

        $collectionList     =   Collection::select(
            'tblCustomer.intCustomerId',
            'tblCustomer.strFirstName',
            'tblCustomer.strMiddleName',
            'tblCustomer.strLastName'
            )
            ->join('tblCustomer', 'tblCustomer.intCustomerId', '=', 'tblCollection.intCustomerIdFK')
            ->where('tblCollection.boolFinish', '=', false)
            ->groupBy('tblCustomer.intCustomerId')
            ->get();

        $customerList       =   $this->addToList($collectionList, $customerList);

        foreach($customerList as $customer){

            $customer->deciDownpaymentCollectible       =   $this->getDownpaymentCollectibles($customer->intCustomerId);
            $customer->deciCollectionCollectible        =   $this->getCollectionCollectibles($customer->intCustomerId);
            $customer->deciPreNeedCollectible           =   $this->getPreNeedCollectibles($customer->intCustomerId);

        }//end foreach

        return response()
            ->json(
                [
                    'customerList'      =>  $customerList
                ],
                200
            );

    }//end function

    public function addToList($customerListToAdd, $customerList){

        foreach($customerListToAdd as $customer){

            $boolExist          =   false;

            foreach($customerList as $customerIncluded){

                if ($customer->intCustomerId == $customerIncluded->intCustomerId){

                    $boolExist      =   true;

                }//end if

            }//end foreach   

            if (!$boolExist){

                array_push($customerList, $customer);

            }//end if

        }//end foreach

        return $customerList;

    }//end function

    public function getDownpaymentCollectibles($id){

        $downpaymentList        =   Downpayment::select(
            'tblUnitCategoryPrice.deciPrice',
            DB::raw('SUM(tblDownpaymentPayment.deciAmountPaid) as deciTotalPayment'),
            'tblDownpayment.created_at',
            'tblDownpayment.intDownpaymentId'
            )
            ->join('tblUnitCategoryPrice', 'tblUnitCategoryPrice.intUnitCategoryPriceId', '=', 'tblDownpayment.intUnitCategoryPriceIdFK')
            ->leftJoin('tblDownpaymentPayment', 'tblDownpayment.intDownpaymentId', '=', 'tblDownpaymentPayment.intDownpaymentIdFK')
            ->where('tblDownpayment.intCustomerIdFK', '=', $id)
            ->where('tblDownpayment.boolPaid', '=', false)
            ->groupBy('tblDownpayment.intDownpaymentId')
            ->get();

        $deciTotalDownpaymentCollectibles       =   0;

        foreach($downpaymentList as $downpayment){

            $deciTotalDownpaymentCollectibles       +=  $this->computeDiscountedDownpayment($downpayment);

        }//end foreach

        return $deciTotalDownpaymentCollectibles;

    }//end function

    public function getCollectionCollectibles($id){

        $collectionList             =   Collection::select(
            'tblCollection.intCollectionId',
            'tblCollection.dateCollectionStart',
            'tblUnitCategoryPrice.deciPrice',
            'tblInterest.intNoOfYear',
            'tblInterestRate.deciInterestRate'
            )
            ->join('tblInterestRate', 'tblInterestRate.intInterestRateId', '=', 'tblCollection.intInterestRateIdFK')
            ->join('tblInterest', 'tblInterest.intInterestId', '=', 'tblInterestRate.intInterestIdFK')
            ->join('tblUnitCategoryPrice', 'tblUnitCategoryPrice.intUnitCategoryPriceId', '=', 'tblCollection.intUnitCategoryPriceIdFK')
            ->where('tblCollection.intCustomerIdFK', '=', $id)
            ->get();

        $deciTotalCollectionCollectibles        =   0;

        foreach($collectionList as $collection){

            $deciTotalCollectionCollectibles        +=      $this->getPerCollectionCollectible($collection);

        }//end foreach

        return $deciTotalCollectionCollectibles;

    }//end function

    public function getPreNeedCollectibles($id){

        $collectionList             =   Collection::select(
            'tblCollection.intCollectionId',
            'tblCollection.dateCollectionStart',
            'tblServicePrice.deciPrice as deciServicePrice',
            'tblPackagePrice.deciPrice as deciPackagePrice'
            )
            ->leftJoin('tblServicePrice', 'tblServicePrice.intServicePriceId', '=', 'tblCollection.intServicePriceIdFK')
            ->leftJoin('tblPackagePrice', 'tblPackagePrice.intPackagePriceId', '=', 'tblCollection.intPackagePriceIdFK')
            ->where('tblCollection.intCustomerIdFK', '=', $id)
            ->get();

        $deciTotalPreNeedCollectibles       =   0;

        foreach($collectionList as $collection){

            $deciTotalPreNeedCollectibles        +=      $this->getPerPreNeedCollectibles($collection);

        }//end foreach

        return $deciTotalPreNeedCollectibles;

    }//end function

    public function getPerCollectionCollectible($collection){

        $lastCollectionPayment          =   CollectionPayment::select(
                'tblCollectionPaymentDetail.dateDue'
                )
                ->join('tblCollectionPaymentDetail', 'tblCollectionPayment.intCollectionPaymentId', '=', 'tblCollectionPaymentDetail.intCollectionPaymentIdFK')
                ->where('tblCollectionPayment.intCollectionIdFK', '=', $collection->intCollectionId)
                ->orderBy('tblCollectionPayment.created_at', 'desc')
                ->orderBy('tblCollectionPaymentDetail.dateDue', 'desc')
                ->first();

        $dateNow                =   Carbon::now()
            ->startOfDay();

        if ($lastCollectionPayment != null){

            $dateLastPayment        =   Carbon::parse($lastCollectionPayment->dateDue)
                ->addMonth();

            $dateCollection         =   Carbon::parse($lastCollectionPayment->dateDue);

        }//end if
        else{

            $dateLastPayment        =   Carbon::parse($collection->dateCollectionStart);
            $dateCollection         =   Carbon::parse($collection->dateCollectionStart);

        }//end else

        $deciAmountToReceive    =   0;
        $deciMonthlyAmortization    =   (new CollectionBusiness())
            ->getMonthlyAmortization($collection->deciPrice, $collection->deciInterestRate, $collection->intNoOfYear);

        $intCtr                 =   0;
        while($dateNow->month >= $dateLastPayment->month && $dateNow->year >= $dateLastPayment->year){

            $gracePeriod                =   BusinessDependency::where('strBusinessDependencyName', 'LIKE', 'gracePeriod')
                ->first(['deciBusinessDependencyValue']);
            $intMonthDue            =   0;

            $datePenalty                =   Carbon::parse($dateLastPayment)
                ->addDays($gracePeriod->deciBusinessDependencyValue);

            if ($dateNow >= $dateLastPayment){

                $deciAmountToReceive        +=  $deciMonthlyAmortization;

            }//end if

            if ($datePenalty <= $dateNow){

                $intMonthDue                =   $dateNow->diffInMonths($dateLastPayment);

            }//end if

            if ($intMonthDue > 0){

                $deciAmountToReceive        +=  (new PenaltyBusiness())
                    ->getPenalty($deciMonthlyAmortization, $intMonthDue);

            }//end if

            $dateLastPayment->addMonth();
            $intCtr++;

        }//end for

        return $deciAmountToReceive;

    }//end function

    public function getPerPreNeedCollectibles($collection){

        $lastCollectionPayment          =   CollectionPayment::select(
                'tblCollectionPaymentDetail.dateDue'
                )
                ->join('tblCollectionPaymentDetail', 'tblCollectionPayment.intCollectionPaymentId', '=', 'tblCollectionPaymentDetail.intCollectionPaymentIdFK')
                ->where('tblCollectionPayment.intCollectionIdFK', '=', $collection->intCollectionId)
                ->orderBy('tblCollectionPayment.created_at', 'desc')
                ->orderBy('tblCollectionPaymentDetail.dateDue', 'desc')
                ->first();

        $dateNow                =   Carbon::now()
            ->startOfDay();

        if ($lastCollectionPayment != null){

            $dateLastPayment        =   Carbon::parse($lastCollectionPayment->dateDue)
                ->addMonth();

            $dateCollection         =   Carbon::parse($lastCollectionPayment->dateDue);

        }//end if
        else{

            $dateLastPayment        =   Carbon::parse($collection->dateCollectionStart);
            $dateCollection         =   Carbon::parse($collection->dateCollectionStart);

        }//end else

        $deciAmountToReceive    =   0;
        $deciMonthlyAmortization    =   $collection->deciServicePrice ? $collection->deciServicePrice/12 : $collection->deciPackagePrice/12;

        $intCtr                 =   0;
        while($dateNow->month >= $dateLastPayment->month && $dateNow->year >= $dateLastPayment->year){

            $gracePeriod                =   BusinessDependency::where('strBusinessDependencyName', 'LIKE', 'gracePeriod')
                ->first(['deciBusinessDependencyValue']);
            $intMonthDue            =   0;

            $datePenalty                =   Carbon::parse($dateLastPayment)
                ->addDays($gracePeriod->deciBusinessDependencyValue);

            if ($dateNow >= $dateLastPayment){

                $deciAmountToReceive        +=  $deciMonthlyAmortization;

            }//end if

            if ($datePenalty <= $dateNow){

                $intMonthDue                =   $dateNow->diffInMonths($dateLastPayment);

            }//end if

            if ($intMonthDue > 0){

                $deciAmountToReceive        +=  (new PenaltyBusiness())
                    ->getPenalty($deciMonthlyAmortization, $intMonthDue);

            }//end if

            $dateLastPayment->addMonth();
            $intCtr++;

        }//end for

        return $deciAmountToReceive;

    }//end function

    public function getCustomerCollectibles($id){

        return response()
            ->json(
                [
                    'downpaymentList'           =>  $this->getCustomerDownpayment($id),
                    'collectionList'            =>  $this->getAllCollections($id),
                    'preNeedCollectionList'     =>  $this->getAllPreNeedCollections($id)
                ],
                200
            );

    }//end function

    public function getAllPreNeedCollections($id){

        $collectionList             =   Collection::select(
            'tblCollection.intCollectionId',
            'tblCollection.dateCollectionStart',
            'tblService.strServiceName',
            'tblServicePrice.deciPrice as deciServicePrice',
            'tblPackage.strPackageName',
            'tblPackagePrice.deciPrice as deciPackagePrice'
            )
            ->leftJoin('tblServicePrice', 'tblServicePrice.intServicePriceId', '=', 'tblCollection.intServicePriceIdFK')
            ->leftJoin('tblPackagePrice', 'tblPackagePrice.intPackagePriceId', '=', 'tblCollection.intPackagePriceIdFK')
            ->leftJoin('tblService', 'tblService.intServiceId', '=', 'tblServicePrice.intServiceIdFK')
            ->leftJoin('tblPackage', 'tblPackage.intPackageId', '=', 'tblPackagePrice.intPackageIdFK')
            ->where('tblCollection.intCustomerIdFK', '=', $id)
            ->get();

        $preNeedCollectionList      =   array();

        foreach($collectionList as $collection){

            $collectionPayment      =   Collection::join('tblCollectionPayment', 'tblCollection.intCollectionId', '=', 'tblCollectionPayment.intCollectionIdFK')
                ->join('tblCollectionPaymentDetail', 'tblCollectionPayment.intCollectionPaymentId', '=', 'tblCollectionPaymentDetail.intCollectionPaymentIdFK')
                ->where('tblCollectionPayment.intCollectionIdFK', '=', $collection->intCollectionId)
                ->count();

            $preNeedCollection      =   array(
                'strName'           =>  $collection->strServiceName? $collection->strServiceName : $collection->strPackageName,
                'intCollectionId'   =>  $collection->intCollectionId,
                'deciMonthlyAmortization'   =>  $collection->deciServicePrice? $collection->deciServicePrice/12 : $collection->deciPackagePrice/12,
                'intMonthsPaid'     =>  $collectionPayment,
                'dateNextDue'       =>  Carbon::parse($collection->dateCollectionStart)->addMonths($collectionPayment)->toDateString(),
                'deciCollectible'   =>  $this->getPerPreNeedCollectibles($collection)
                );

            array_push($preNeedCollectionList, $preNeedCollection);

        }//end foreach

        return $preNeedCollectionList;

    }//end function

    public function getDownpaymentDiscount($intDownpaymentId){

        $discountList       =   DownpaymentDiscount::select(
            'intDiscountRateIdFK'
            )
            ->where('intDownpaymentIdFK', '=', $intDownpaymentId)
            ->get();

        foreach($discountList as $discount){

            $discountRate       =   DiscountRate::select(
                'deciDiscountRate',
                'intDiscountType'
                )
                ->where('intDiscountRateId', '=', $discount->intDiscountRateIdFK)
                ->orderBy('created_at', 'desc')
                ->first();

            $discount->deciDiscountRate         =   $discountRate->deciDiscountRate;
            $discount->intDiscountType          =   $discountRate->intDiscountType;

        }//end foreach

        return $discountList;

    }//end function

    public function computeDiscountedDownpayment($downpayment){

        $downpaymentBD        =   BusinessDependency::where('strBusinessDependencyName', 'LIKE', 'downpayment')
            ->first(['deciBusinessDependencyValue']);

        $deciDownpayment        =   $downpayment->deciPrice * $downpaymentBD->deciBusinessDependencyValue;

        $discountList           =   $this->getDownpaymentDiscount($downpayment->intDownpaymentId);

        if (Carbon::today() <= Carbon::parse($downpayment->created_at)->addDays(7)){

            $deciDiscount       =   0;
            foreach($discountList as $discount){

                if ($discount->intDiscountType == 1){

                    $deciDiscount       +=  ($deciDownpayment * $discount->deciDiscountRate);

                }//end if
                else{

                    $deciDiscount       +=  $discount->deciDiscountRate;

                }//end else

            }//end foreach
            $deciDownpayment        -=  $deciDiscount;

        }//end if

        return $deciDownpayment - $downpayment->deciTotalPayment;

    }//end function

    public function getCustomersWithSentNotif(){

        $allCustomerList        =   array();

        $customerList           =   Customer::select(
            'tblCustomer.intCustomerId',
            'tblCustomer.strFirstName',
            'tblCustomer.strMiddleName',
            'tblCustomer.strLastName'
            )
            ->join('tblDownpayment', 'tblCustomer.intCustomerId', '=', 'tblDownpayment.intCustomerIdFK')
            ->where('tblDownpayment.boolPaid', '=', false)
            ->where('tblDownpayment.boolNotFullWarning', '=', true)
            ->get();

        $allCustomerList        =   $this->addToList($allCustomerList, $customerList);

        return response()
            ->json(
                [
                    'customerList'      =>  $allCustomerList
                ],
                200
            );

    }//end function

    public function getCustomersWithUnscheduledService(){

        $preNeedCustomerList         =   TransactionPurchase::select(
            'tblCustomer.intCustomerId',
            'tblCustomer.strFirstName',
            'tblCustomer.strMiddleName',
            'tblCustomer.strLastName'
            )
            ->join('tblCustomer', 'tblCustomer.intCustomerId', '=', 'tblTransactionPurchase.intCustomerIdFK')
            ->join('tblTPurchaseDetail', 'tblTransactionPurchase.intTransactionPurchaseId', '=', 'tblTPurchaseDetail.intTPurchaseIdFK')
            ->leftJoin('tblScheduleDetail', 'tblTPurchaseDetail.intTPurchaseDetailId', '=', 'tblScheduleDetail.intTPDetailIdFK')
            ->where('tblTransactionPurchase.intPaymentType', '!=', 0)
            ->whereNull('tblScheduleDetail.intScheduleDetailId')
            ->groupBy('tblCustomer.intCustomerId')
            ->get();

        $collectionCustomerList         =   Collection::select(
            'tblCustomer.intCustomerId',
            'tblCustomer.strFirstName',
            'tblCustomer.strMiddleName',
            'tblCustomer.strLastName'
            )
            ->join('tblCustomer', 'tblCustomer.intCustomerId', '=', 'tblCollection.intCustomerIdFK')
            ->where('tblCollection.boolFinish', '=', true)
            ->whereNotNull('tblCollection.intServicePriceIdFK')
            ->orWhereNotNull('tblCollection.intPackagePriceIdFK')
            ->groupBy('tblCustomer.intCustomerId')
            ->get();

        $customerList       =   array();
        if ($preNeedCustomerList->count() != 0){

            $customerList       =   $this->addToList($customerList, $preNeedCustomerList);

        }//end if
        if ($collectionCustomerList->count() != 0){

            $customerList       =   $this->addToList($customerList, $collectionCustomerList);

        }//end if

        return response()
            ->json(
                [
                    'customerList'      =>  $customerList
                ],
                200
            );

    }//end function

}
