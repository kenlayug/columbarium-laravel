<?php

namespace App\Http\Controllers\Api\v2;

use App\ApiModel\v2\BusinessDependency;
use App\ApiModel\v2\Collection;
use App\ApiModel\v2\Downpayment;
use App\Customer;
use App\Reservation;
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

    public function getAllCustomersWithVoidReservations(){

        $customerList   =   Customer::join('tblReservation', 'tblReservation.intCustomerIdFK', '=', 'tblCustomer.intCustomerId')
                                ->join('tblReservationDetail', 'tblReservationDetail.intReservationIdFK', '=', 'tblReservation.intReservationId')
                                ->where('tblReservationDetail.boolDownpayment', '=', false)
                                ->whereNotNull('tblReservationDetail.deleted_at')
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

        $collectionList = Collection::where('intCustomerIdFK', '=', $id)
                            ->where('boolFinish', '=', false)
                            ->get([
                                'intCollectionId',
                                'intUnitIdFK'
                            ]);

        return response()
            ->json(
                [
                    'collectionList'        =>  $collectionList
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
}
