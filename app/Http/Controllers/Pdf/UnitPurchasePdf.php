<?php

namespace App\Http\Controllers\Pdf;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\ApiModel\v3\TransactionUnit;
use App\ApiModel\v3\AssignDiscount;
use App\ApiModel\v3\DiscountRate;

use App\ApiModel\v2\BusinessDependency;
use App\ApiModel\v2\Downpayment;

use App\Business\v1\CollectionBusiness;

use Carbon\Carbon;
use App;

class UnitPurchasePdf extends Controller
{
    public function generatePdf($id){

        $transactionUnitDetailList      =   array();
        $transactionUnitList            =   $this->queryTransactionUnit()
            ->where('tblTransactionUnit.intTransactionUnitId', '=', $id)
            ->get();

        if ($transactionUnitList[0]->intTransactionType == 2){

            $reservationFee             =   BusinessDependency::where('strBusinessDependencyName', 'LIKE', 'reservationFee')
                ->first(['deciBusinessDependencyValue']);
            $downpayment                =   BusinessDependency::where('strBusinessDependencyName', 'LIKE',
                'downpayment')
                ->first(['deciBusinessDependencyValue']);

            foreach($transactionUnitList as $transactionUnit){

                $interest                       =   $this->queryDownpayment($transactionUnit->intUnitId);
                $dateDue                        =   $interest->dateDueDate;
                $monthlyAmortization            =   (new CollectionBusiness())->getMonthlyAmortization($transactionUnit->deciPrice, $interest->deciInterestRate, $interest->intNoOfYear);
                $transactionUnitDetail          =   array(
                    'strBuildingName'           =>  $transactionUnit->strBuildingName,
                    'intFloorNo'                =>  $transactionUnit->intFloorNo,
                    'strRoomName'               =>  $transactionUnit->strRoomName,
                    'intBlockNo'                =>  $transactionUnit->intBlockNo,
                    'intUnitId'                 =>  chr(64+$transactionUnit->intLevelNo).$transactionUnit->intColumnNo,
                    'deciPrice'             =>  $transactionUnit->deciPrice,
                    'intNoOfYear'           =>  $interest->intNoOfYear,
                    'deciDownpayment'       =>  $transactionUnit->deciPrice * $downpayment->deciBusinessDependencyValue,
                    'deciMonthlyAmortization'   =>  $monthlyAmortization
                );
                array_push($transactionUnitDetailList, $transactionUnitDetail);

            }//end foreach

            $transactionUnit            =   array(
                'intTransactionUnitId'          =>  $transactionUnitList[0]->intTransactionUnitId,
                'intTransactionType'            =>  $transactionUnitList[0]->intTransactionType,
                'dateTransactionUnit'           =>  Carbon::parse($transactionUnitList[0]->created_at)
                    ->toDayDateTimeString(),
                'strCustomerName'               =>  $transactionUnitList[0]->strLastName.", ".
                    $transactionUnitList[0]->strFirstName." ".$transactionUnitList[0]->strMiddleName,
                'deciAmountPaid'                =>  $transactionUnitList[0]->deciAmountPaid,
                'dateDue'                       =>  Carbon::parse($dateDue)->toFormattedDateString(),
                'deciReservationFee'            =>  $reservationFee->deciBusinessDependencyValue,
                'deciAmountPaid'                =>  $transactionUnitList[0]->deciAmountPaid
            );

        }//end if
        else if ($transactionUnitList[0]->intTransactionType == 3){

            $discountList               =   AssignDiscount::select(
                'intDiscountIdFK'
                )
                ->where('intTransactionId', '=', 1)
                ->get();

            foreach($discountList as $discount){

                $discount->discountRate         =   DiscountRate::select(
                    'intDiscountType',
                    'deciDiscountRate'
                    )
                    ->where('intDiscountIdFK', '=', $discount->intDiscountIdFK)
                    ->orderBy('created_at', 'desc')
                    ->first();

            }//end foreach

            $pcf                        =   BusinessDependency::where('strBusinessDependencyName', 'LIKE', 'pcf')
                ->first(['deciBusinessDependencyValue']);

            $deciTotalPcf               =   0;
            $deciTotalUnitPrice         =   0;
            $deciTotalDiscount          =   0;

            foreach($transactionUnitList as $transactionUnit){

                $deciDiscount               =   0;

                foreach($discountList as $discount){

                    if ($discount->discountRate->intDiscountType == 1){

                        $deciDiscount       +=  ($transactionUnit->deciPrice * $discount->discountRate->deciDiscountRate);

                    }else{

                        $deciDiscount       +=  $discount->discountRate->deciDiscountRate;

                    }//end else

                }//end foreach

                $deciDiscount           =   round($deciDiscount, 2);

                $deciTotalDiscount          +=  $deciDiscount;

                $transactionUnitDetail          =   array(
                    'strBuildingName'           =>  $transactionUnit->strBuildingName,
                    'intFloorNo'                =>  $transactionUnit->intFloorNo,
                    'strRoomName'               =>  $transactionUnit->strRoomName,
                    'intBlockNo'                =>  $transactionUnit->intBlockNo,
                    'intUnitId'                 =>  chr(64+$transactionUnit->intLevelNo).$transactionUnit->intColumnNo,
                    'deciPrice'                 =>  $transactionUnit->deciPrice,
                    'deciDiscountedPrice'       =>  $transactionUnit->deciPrice - $deciDiscount,
                    'deciPcf'                   =>  round($transactionUnit->deciPrice * $pcf->deciBusinessDependencyValue, 2)
                );
                array_push($transactionUnitDetailList, $transactionUnitDetail);
                $deciTotalPcf               +=  round($transactionUnit->deciPrice * $pcf->deciBusinessDependencyValue, 2);

                $deciTotalUnitPrice         +=  round($transactionUnit->deciPrice - $deciDiscount, 2);

            }//end foreach

            $transactionUnit            =   array(
                'intTransactionUnitId'          =>  $transactionUnitList[0]->intTransactionUnitId,
                'intTransactionType'            =>  $transactionUnitList[0]->intTransactionType,
                'dateTransactionUnit'           =>  Carbon::parse($transactionUnitList[0]->created_at)
                    ->toDayDateTimeString(),
                'strCustomerName'               =>  $transactionUnitList[0]->strLastName.", ".
                    $transactionUnitList[0]->strFirstName." ".$transactionUnitList[0]->strMiddleName,
                'deciAmountPaid'                =>  $transactionUnitList[0]->deciAmountPaid,
                'deciTotalUnitPrice'            =>  $deciTotalUnitPrice,
                'deciTotalPcf'                  =>  $deciTotalPcf
            );

        }//end else if
        else if ($transactionUnitList[0]->intTransactionType == 4){

            $pcf                        =   BusinessDependency::where('strBusinessDependencyName', 'LIKE', 'pcf')
                ->first(['deciBusinessDependencyValue']);
            $downpayment                =   BusinessDependency::where('strBusinessDependencyName', 'LIKE', 'downpayment')
                ->first(['deciBusinessDependencyValue']);
            $deciTotalPcf               =   0;

            foreach($transactionUnitList as $transactionUnit){

                $interest                       =   $this->queryDownpayment($transactionUnit->intUnitId);
                $dateDue                        =   $interest->dateDueDate;
                $monthlyAmortization            =   (new CollectionBusiness())->getMonthlyAmortization($transactionUnit->deciPrice, $interest->deciInterestRate, $interest->intNoOfYear);
                $transactionUnitDetail          =   array(
                    'strBuildingName'           =>  $transactionUnit->strBuildingName,
                    'intFloorNo'                =>  $transactionUnit->intFloorNo,
                    'strRoomName'               =>  $transactionUnit->strRoomName,
                    'intBlockNo'                =>  $transactionUnit->intBlockNo,
                    'intUnitId'                 =>  chr(64+$transactionUnit->intLevelNo).$transactionUnit->intColumnNo,
                    'deciPrice'                 =>  $transactionUnit->deciPrice,
                    'intNoOfYear'               =>  $interest->intNoOfYear,
                    'deciMonthlyAmortization'   =>  $monthlyAmortization,
                    'deciPcf'                   =>  $transactionUnit->deciPrice * $pcf->deciBusinessDependencyValue,
                    'deciDownpayment'           =>  $transactionUnit->deciPrice * $downpayment->deciBusinessDependencyValue
                );
                array_push($transactionUnitDetailList, $transactionUnitDetail);
                $deciTotalPcf               +=  $transactionUnit->deciPrice * $pcf->deciBusinessDependencyValue;

            }//end foreach
            $transactionUnit            =   array(
                'intTransactionUnitId'          =>  $transactionUnitList[0]->intTransactionUnitId,
                'intTransactionType'            =>  $transactionUnitList[0]->intTransactionType,
                'dateTransactionUnit'           =>  Carbon::parse($transactionUnitList[0]->created_at)
                    ->toDayDateTimeString(),
                'dateDue'                       =>  Carbon::parse($dateDue)->toFormattedDateString(),
                'strCustomerName'               =>  $transactionUnitList[0]->strLastName.", ".
                    $transactionUnitList[0]->strFirstName." ".$transactionUnitList[0]->strMiddleName,
                'deciAmountPaid'                =>  $transactionUnitList[0]->deciAmountPaid,
                'deciTotalPcf'                  =>  $deciTotalPcf
            );

        }//end else if

        $pdf = App::make('dompdf.wrapper');
        $pdf->setPaper('legal', 'landscape');
        $pdf->loadView('pdf.unit-purchase-success', [
            'transactionUnit'           =>  $transactionUnit,
            'transactionUnitList'       =>  $transactionUnitDetailList
            ]);
        return $pdf->stream('unit-purchase-success.pdf');

    }

    public function queryTransactionUnit(){

        $transactionUnitListQuery            =       TransactionUnit::join('tblTransactionUnitDetail', 'tblTransactionUnit.intTransactionUnitId', '=', 'tblTransactionUnitDetail.intTransactionUnitIdFK')
            ->join('tblCustomer', 'tblCustomer.intCustomerId', '=', 'tblTransactionUnit.intCustomerIdFK')
            ->join('tblUnit', 'tblUnit.intUnitId', '=', 'tblTransactionUnitDetail.intUnitIdFK')
            ->join('tblUnitCategory', 'tblUnitCategory.intUnitCategoryId', '=', 'tblUnit.intUnitCategoryIdFK')
            ->join('tblBlock', 'tblBlock.intBlockId', '=', 'tblUnit.intBlockIdFK')
            ->join('tblRoom', 'tblRoom.intRoomId', '=', 'tblBlock.intRoomIdFK')
            ->join('tblFloor', 'tblFloor.intFloorId', '=', 'tblRoom.intFloorIdFK')
            ->join('tblBuilding', 'tblBuilding.intBuildingId', '=', 'tblFloor.intBuildingIdFK')
            ->join('tblUnitCategoryPrice', 'tblUnitCategoryPrice.intUnitCategoryPriceId', '=', 'tblTransactionUnitDetail.intUnitCategoryPriceIdFK')
            ->select(
                'tblTransactionUnit.intTransactionUnitId',
                'tblTransactionUnit.created_at',
                'tblTransactionUnit.deciAmountPaid',
                'tblTransactionUnitDetail.intTransactionType',
                'tblUnit.intUnitId',
                'tblUnit.intColumnNo',
                'tblUnitCategory.intLevelNo',
                'tblBlock.intBlockNo',
                'tblRoom.strRoomName',
                'tblFloor.intFloorNo',
                'tblBuilding.strBuildingName',
                'tblUnitCategoryPrice.deciPrice',
                'tblCustomer.strFirstName',
                'tblCustomer.strMiddleName',
                'tblCustomer.strLastName'
            );

        return $transactionUnitListQuery;

    }//end function

    public function queryDownpayment($id){

        $downpayment            =   Downpayment::select(
            'tblInterest.intNoOfYear',
            'tblInterestRate.deciInterestRate',
            'tblDownpayment.dateDueDate'
            )
            ->join('tblInterestRate', 'tblInterestRate.intInterestRateId', '=', 'tblDownpayment.intInterestRateIdFK')
            ->join('tblInterest', 'tblInterest.intInterestId', '=', 'tblInterestRate.intInterestIdFK')
            ->orderBy('tblInterestRate.created_at', 'desc')
            ->orderBy('tblDownpayment.created_at', 'desc');

        if ($id){

            return $downpayment->where('tblDownpayment.intUnitIdFK', '=', $id)
                ->first();

        }//end if

        return $downpayment;

    }//end function
}
