<?php

namespace App\Http\Controllers\Api\v2;

use App\ApiModel\v2\BusinessDependency;
use App\ApiModel\v2\Collection;
use App\ApiModel\v2\CollectionPayment;
use App\ApiModel\v2\Downpayment;
use App\ApiModel\v2\DownpaymentPayment;
use App\Customer;
use App\Reservation;
use App\ApiModel\v2\Deceased;
use App\UnitCategoryPrice;

use App\Business\v1\CollectionBusiness;

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
                'dateNextDue'                   =>  Carbon::parse($lastCollectionPayment->dateDue)
                    ->toFormattedDateString(),
                'intMonthsPaid'                 =>  $intMonthsPaid
            );
            array_push($collectionDetailList, $collectionDetail);

        }//end foreach

        return response()
            ->json(
                [
                    'collectionList'        =>  $collectionDetailList
                ],
                200
            );

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
                                            ->where('intCustomerIdFK', '=', $id)
                                            ->get();

        $downpaymentPercentage      =   BusinessDependency::where('strBusinessDependencyName', 'LIKE', 'downpayment')
                                            ->first();

        $discountSpotdown           =   BusinessDependency::where('strBusinessDependencyName', 'LIKE', 'discountSpotdown')
                                            ->first();

        foreach ($downpaymentList   as $downpayment){

            $dateNow                =   Carbon::today();
            $dateWithDiscount       =   Carbon::parse($downpayment->created_at)->addDays(7);

            $unitCategoryPrice      =   UnitCategoryPrice::find($downpayment->intUnitCategoryPriceIdFK);
            $totalDownpaymentAmount =   $unitCategoryPrice->deciPrice * $downpaymentPercentage->deciBusinessDependencyValue;

            if ($dateNow <= $dateWithDiscount){
                $totalDownpaymentAmount   =   $totalDownpaymentAmount-($totalDownpaymentAmount*$discountSpotdown->deciBusinessDependencyValue);
            }

            $deciTotalDownpaymentPaid   =   DownpaymentPayment::where('intDownpaymentIdFK', '=', $downpayment->intDownpaymentId)
                                                ->sum('deciAmountPaid');
            
            $downpayment->balance       =   $totalDownpaymentAmount - $deciTotalDownpaymentPaid;

        }//end foreach

        return response()
            ->json(
                [
                    'downpaymentList'       =>  $downpaymentList
                ],
                200
            );

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

}
